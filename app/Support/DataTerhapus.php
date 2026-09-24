<?php

namespace App\Support;

use App\Enums\ModulDiplomasi;
use App\Enums\TipeMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Penyedia data untuk modul Pengaturan Sistem > Restore Data.
 *
 * Tombol "hapus" di seluruh modul menonaktifkan baris (`is_active = false`)
 * SEKALIGUS men-soft-delete-nya (`deleted_at` terisi) — lihat CLAUDE.md Bagian
 * 9.3. Kelas ini membaca kembali baris-baris ter-soft-delete itu dari ke-16
 * modul pemilik data (10 subtype mitra + 6 modul Riwayat Diplomasi) dan
 * menyeragamkannya menjadi satu daftar yang bisa ditampilkan dalam satu tabel.
 *
 * Daftar modulnya TIDAK ditulis di sini — diturunkan dari App\Enums\TipeMitra
 * dan App\Enums\ModulDiplomasi, sehingga modul/jenis mitra baru otomatis ikut
 * terpantau tanpa menyentuh kelas ini (lihat CLAUDE.md Bagian 3).
 */
class DataTerhapus
{
    public const GRUP_MITRA = 'mitra';

    public const GRUP_DIPLOMASI = 'diplomasi';

    /**
     * Seluruh baris terhapus dari semua modul, terurut dari yang paling baru
     * dihapus. Bila $slugModul diisi, hanya modul itu yang dibaca — penyaringan
     * dilakukan sebelum query dijalankan, bukan setelah semua baris dimuat.
     *
     * @return Collection<int, object>
     */
    public static function baris(?string $slugModul = null): Collection
    {
        $baris = collect();

        foreach (TipeMitra::cases() as $tipe) {
            if ($slugModul !== null && $tipe->slug() !== $slugModul) {
                continue;
            }

            $baris = $baris->concat(self::barisModul(self::GRUP_MITRA, $tipe));
        }

        foreach (ModulDiplomasi::cases() as $modul) {
            if ($slugModul !== null && $modul->slug() !== $slugModul) {
                continue;
            }

            $baris = $baris->concat(self::barisModul(self::GRUP_DIPLOMASI, $modul));
        }

        return $baris->sortByDesc('dihapus_pada')->values();
    }

    /**
     * Jumlah data terhapus per grup dan per modul — dipakai untuk kartu
     * akumulasi dan dropdown filter. Jumlahnya dihitung untuk SEMUA modul
     * (tidak ikut tersaring), supaya admin tetap melihat modul mana saja yang
     * punya data terhapus meski sedang memfilter satu modul.
     *
     * @return Collection<int, object>
     */
    public static function ringkasan(): Collection
    {
        return collect([
            self::grupRingkasan(self::GRUP_MITRA, 'Mitra Biro KSD', 'handshake', 'blue', TipeMitra::cases()),
            self::grupRingkasan(self::GRUP_DIPLOMASI, 'Riwayat Diplomasi', 'clock-rotate-left', 'green', ModulDiplomasi::cases()),
        ]);
    }

    /**
     * Aktifkan kembali satu baris: `deleted_at` dikosongkan dan `is_active`
     * dikembalikan ke true dalam satu operasi simpan. Khusus subtype mitra,
     * baris tb_mitra pasangannya ikut dipulihkan — soft delete-nya sudah
     * ditangani hook BelongsToMitra, `is_active`-nya diurus di sini.
     *
     * @return object {modul: string, identitas: string}
     */
    public static function pulihkan(string $grup, string $slugModul, int|string $id): object
    {
        $modul = self::modul($grup, $slugModul);

        /** @var Model $record */
        $record = $modul->modelClass()::onlyTrashed()->findOrFail($id);

        $record->is_active = true;
        $record->restore();

        if ($modul instanceof TipeMitra) {
            $record->mitra->update(['is_active' => true]);
        }

        return (object) [
            'modul' => $modul instanceof TipeMitra ? $modul->labelSingkat() : $modul->value,
            'identitas' => self::identitas($modul, $record),
        ];
    }

    // ------------------------------------------------------------------------
    // INTERNAL
    // ------------------------------------------------------------------------

    /**
     * Terjemahkan pasangan grup + slug pada URL menjadi enum modulnya.
     * Slug yang tidak dikenal berujung 404, bukan diam-diam dianggap modul lain.
     */
    private static function modul(string $grup, string $slugModul): TipeMitra|ModulDiplomasi
    {
        $modul = match ($grup) {
            self::GRUP_MITRA => TipeMitra::dariSlug($slugModul),
            self::GRUP_DIPLOMASI => ModulDiplomasi::dariSlug($slugModul),
            default => null,
        };

        abort_if($modul === null, 404, 'Modul tidak dikenal.');

        return $modul;
    }

    /**
     * @return Collection<int, object>
     */
    private static function barisModul(string $grup, TipeMitra|ModulDiplomasi $modul): Collection
    {
        $query = $modul->modelClass()::onlyTrashed();

        // Nama mitra pada baris Riwayat Diplomasi dibaca lewat accessor
        // label_mitra, yang menyentuh relasi subtype — eager-load supaya tidak
        // N+1. Relasinya diturunkan dari TipeMitra, bukan didaftar manual.
        if ($modul instanceof ModulDiplomasi) {
            $query->with(TipeMitra::relasiMitra());
        }

        return $query->orderByDesc('deleted_at')->get()->map(fn (Model $record) => (object) [
            'grup' => $grup,
            'modul_slug' => $modul->slug(),
            'modul_label' => $modul instanceof TipeMitra ? $modul->labelSingkat() : $modul->value,
            'ikon' => $modul->ikon(),
            'warna' => $modul->warna(),
            'id' => $record->getKey(),
            'identitas' => self::identitas($modul, $record),
            'keterangan' => self::keterangan($modul, $record),
            // Timestamp database dalam UTC, ditampilkan dalam WIB.
            'dibuat_pada' => Waktu::tampil($record->created_at),
            'dihapus_pada' => Waktu::tampil($record->deleted_at),
            // Locale aplikasi masih 'en', jadi jeda waktunya dipaksa ke Bahasa
            // Indonesia di sini — bukan di blade — agar view tetap dumb.
            'dihapus_sejak' => $record->deleted_at?->locale('id')->diffForHumans(),
        ]);
    }

    /**
     * Baris identitas utama: nama resmi untuk mitra, judul peristiwa untuk
     * Riwayat Diplomasi. Judul dibaca lewat accessor judul_ringkas — accessor
     * yang sama dipakai index keenam modulnya, jadi pemenggalan dan pembersihan
     * tag HTML-nya persis sama di semua halaman.
     *
     * Selalu mengembalikan teks tidak kosong supaya setiap baris tabel Restore
     * Data punya bentuk yang sama: satu baris tebal + satu baris keterangan.
     */
    private static function identitas(TipeMitra|ModulDiplomasi $modul, Model $record): string
    {
        $identitas = $modul instanceof TipeMitra
            ? ($modul->berbasisNegara() ? $record->nama_negara : $record->{$modul->kolomNama()})
            : $record->judul_ringkas;

        return trim((string) $identitas) ?: '(tanpa judul)';
    }

    /**
     * Baris keterangan pendukung, supaya admin bisa memastikan data mana yang
     * dipulihkan tanpa harus membuka modul aslinya.
     */
    private static function keterangan(TipeMitra|ModulDiplomasi $modul, Model $record): string
    {
        if ($modul instanceof TipeMitra) {
            // Mitra berbasis negara dinamai menurut negaranya, jadi keterangannya
            // adalah nama resmi perwakilannya. Sisanya memakai kolom keterangan,
            // yang nullable — kalau kosong dipakai nama lengkap tipenya supaya
            // baris keduanya tidak pernah kosong.
            $keterangan = $modul->berbasisNegara()
                ? $record->{$modul->kolomNama()}
                : $record->keterangan;

            // Kolom keterangan mitra bisa sepanjang satu paragraf — dipotong
            // agar tinggi tiap baris tabel tetap seragam.
            return str(trim((string) $keterangan) ?: $modul->value)->stripTags()->limit(100)->toString();
        }

        $status = $record->{$modul->kolomStatus()} ?? '-';

        // Kelima modul ber-mitra tunggal menampilkan nama mitranya; Acara DKI
        // menampilkan jumlah mitra yang terlibat karena satu acara bisa punya
        // banyak mitra sekaligus (lihat CLAUDE.md Bagian 4).
        $mitra = $modul->berbasisMitraTunggal()
            ? ($record->mitra?->label_mitra ?? 'Mitra tidak diketahui')
            : $record->mitra->count().' mitra terlibat';

        return $mitra.' — Status '.$status;
    }

    /**
     * @param  list<TipeMitra|ModulDiplomasi>  $daftarModul
     */
    private static function grupRingkasan(string $grup, string $label, string $ikon, string $warna, array $daftarModul): object
    {
        $modul = collect($daftarModul)->map(fn (TipeMitra|ModulDiplomasi $modul) => (object) [
            'slug' => $modul->slug(),
            'label' => $modul instanceof TipeMitra ? $modul->labelSingkat() : $modul->value,
            'jumlah' => $modul->modelClass()::onlyTrashed()->count(),
        ]);

        return (object) [
            'grup' => $grup,
            'label' => $label,
            'ikon' => $ikon,
            'warna' => $warna,
            'jumlah' => $modul->sum('jumlah'),
            'modul' => $modul,
        ];
    }
}
