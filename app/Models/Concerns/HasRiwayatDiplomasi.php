<?php

// app/Models/Concerns/HasRiwayatDiplomasi.php

namespace App\Models\Concerns;

use App\Enums\ModulDiplomasi;
use App\Models\AcaraDKI;
use App\Models\AcaraDkiMitra;
use App\Models\Audiensi;
use App\Models\Kerjasama;
use App\Models\Kolaborasi;
use App\Models\Kunjungan;
use App\Models\Undangan;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Relasi ke 5 modul Riwayat Diplomasi, berlaku untuk mitra jenis apapun.
 *
 * Dipakai oleh Mitra (supertype) DAN setiap subtype (KedutaanBesar,
 * MisiAsingAsean, MisiPermanenAsean, dst) karena kelimanya sama-sama
 * punya kolom `id_mitra` yang merujuk ke `tb_mitra.id_mitra` — baik
 * sebagai primary key (Mitra) maupun sebagai FK 1:1 milik subtype.
 */
trait HasRiwayatDiplomasi
{
    /**
     * Keenam relasi di bawah ini WAJIB difilter `is_active` — tombol
     * "hapus" di setiap modul Riwayat Diplomasi hanya menonaktifkan baris
     * (`is_active = false`), tidak benar-benar menghapusnya (lihat method
     * `destroy()` di masing-masing controller). Tanpa filter ini, baris
     * yang sudah "dihapus" tetap tampil selamanya di tab Riwayat Diplomasi
     * pada halaman profil mitra, meski sudah hilang dari index modulnya.
     */
    public function kerjasama(): HasMany
    {
        return $this->hasMany(Kerjasama::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    public function kolaborasi(): HasMany
    {
        return $this->hasMany(Kolaborasi::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    public function undangan(): HasMany
    {
        return $this->hasMany(Undangan::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    public function audiensi(): HasMany
    {
        return $this->hasMany(Audiensi::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    /**
     * Acara DKI yang melibatkan mitra ini (diundang/hadir/tidak hadir).
     * Beda dengan 5 relasi lain di atas karena satu Acara DKI bisa
     * melibatkan banyak mitra sekaligus — lihat AcaraDKI::mitra().
     */
    public function acaraDki(): BelongsToMany
    {
        return $this->belongsToMany(AcaraDKI::class, 'tb_acara_dki_mitra', 'id_mitra', 'id_acara_dki', 'id_mitra', 'id_acara_dki')
            ->using(AcaraDkiMitra::class)
            ->withPivot('status_kehadiran', 'keterangan_kehadiran')
            ->withTimestamps()
            ->where('tb_acara_dki.is_active', true);
    }

    // --------------------------------------------------------------------------
    // FILTER TAHUN — kartu "Riwayat Diplomasi" di halaman profil mitra beserta
    // ekspornya (EksporRiwayatMitra). Tahun = tahun tanggal_diterima, sama
    // dengan filter Tahun di index Riwayat Diplomasi.
    // --------------------------------------------------------------------------

    /** @var list<string>|null cache tahunRiwayatDiplomasi() */
    private ?array $tahunRiwayatTersedia = null;

    /**
     * Tahun yang punya riwayat diplomasi aktif untuk mitra ini (keenam modul),
     * terbaru dulu — pilihan dropdown tahun. Tahunnya diambil di PHP, bukan
     * YEAR() milik MySQL, supaya tetap jalan di SQLite pengujian.
     *
     * @return list<string>
     */
    public function tahunRiwayatDiplomasi(): array
    {
        return $this->tahunRiwayatTersedia ??= collect(ModulDiplomasi::cases())
            ->flatMap(function (ModulDiplomasi $modul) {
                $relasi = $this->{$modul->relasi()}();
                $kolom = $relasi->getRelated()->qualifyColumn('tanggal_diterima');

                return $relasi->whereNotNull($kolom)->pluck($kolom);
            })
            ->map(fn ($tanggal) => substr((string) $tanggal, 0, 4))
            ->unique()
            ->sortDesc()
            ->values()
            ->all();
    }

    /**
     * Tahun dari query string yang sah dipakai menyaring, atau null (= semua
     * tahun) bila kosong/di luar tahunRiwayatDiplomasi(). Dengan begitu
     * dropdown, isi tab, dan isi file ekspor selalu sepakat.
     */
    public function saringTahunRiwayat(mixed $tahun): ?string
    {
        // is_scalar: "?tahun[]=..." menghasilkan array — abaikan, jangan error.
        return is_scalar($tahun) && in_array((string) $tahun, $this->tahunRiwayatDiplomasi(), true) ? (string) $tahun : null;
    }

    /**
     * Muat keenam relasi Riwayat Diplomasi (urut tanggal_diterima terbaru),
     * disaring tahun bila $tahun sah. Dipakai show() kedelapan controller
     * mitra dan EksporRiwayatMitra.
     */
    public function muatRiwayatDiplomasi(mixed $tahun = null): static
    {
        $tahun = $this->saringTahunRiwayat($tahun);

        return $this->load(collect(ModulDiplomasi::cases())->mapWithKeys(fn (ModulDiplomasi $modul) => [
            $modul->relasi() => fn ($query) => $query->filterTahun($tahun)->latest('tanggal_diterima'),
        ])->all());
    }
}
