<?php

namespace App\Enums;

use App\Models\AcaraDKI;
use App\Models\Audiensi;
use App\Models\Kerjasama;
use App\Models\Kolaborasi;
use App\Models\Kunjungan;
use App\Models\Undangan;
use Illuminate\Database\Eloquent\Model;

/**
 * Daftar modul Riwayat Diplomasi sekaligus sumber tunggal metadata tiap modul —
 * pendamping App\Enums\TipeMitra. Bedanya: TipeMitra mendaftar *pihak* yang
 * berdiplomasi, enum ini mendaftar *peristiwa* diplomasinya.
 *
 * Dibuat untuk modul Restore Data, yang harus menyisir SELURUH modul pemilik
 * kolom `is_active` + `deleted_at`. Tanpa enum ini modul tersebut harus menulis
 * daftar keenam modul secara hardcode — pola yang justru dilarang di sisi mitra
 * (lihat CLAUDE.md Bagian 3).
 *
 * Catatan: Acara DKI ikut di sini meski proses bisnisnya berbeda (satu acara =
 * banyak mitra lewat pivot, lihat CLAUDE.md Bagian 4). Yang membedakannya
 * diwakili method berbasisMitraTunggal(), bukan pengecualian if/else di
 * pemakainya.
 */
enum ModulDiplomasi: string
{
    case Kerjasama = 'Kerjasama';
    case Kolaborasi = 'Kolaborasi';
    case Undangan = 'Undangan';
    case Audiensi = 'Audiensi';
    case Kunjungan = 'Kunjungan';
    case AcaraDki = 'Acara DKI';

    /**
     * Kunci teknis modul — dipakai sebagai value <option> dropdown filter dan
     * sebagai segmen URL pada route restore.
     */
    public function slug(): string
    {
        return match ($this) {
            self::Kerjasama => 'kerjasama',
            self::Kolaborasi => 'kolaborasi',
            self::Undangan => 'undangan',
            self::Audiensi => 'audiensi',
            self::Kunjungan => 'kunjungan',
            self::AcaraDki => 'acara_dki',
        };
    }

    /**
     * @return class-string<Model>
     */
    public function modelClass(): string
    {
        return match ($this) {
            self::Kerjasama => Kerjasama::class,
            self::Kolaborasi => Kolaborasi::class,
            self::Undangan => Undangan::class,
            self::Audiensi => Audiensi::class,
            self::Kunjungan => Kunjungan::class,
            self::AcaraDki => AcaraDKI::class,
        };
    }

    /**
     * Kolom judul peristiwa pada tabel modul ini. JANGAN ditebak dari nama
     * modul: hanya Kerjasama, Kolaborasi, dan Acara DKI yang kolomnya senama,
     * sisanya `tb_undangan.acara`, `tb_audiensi.topik`, `tb_kunjungan.perihal`.
     *
     * Karena itu nilainya diambil langsung dari $judulColumn milik model
     * (lewat HasDiplomasiProfileAccessors), bukan disalin ulang di sini —
     * supaya tidak ada dua daftar yang bisa saling melenceng.
     */
    public function kolomJudul(): string
    {
        return (new ($this->modelClass()))->kolomJudul();
    }

    /**
     * Kolom status peristiwa (Berjalan/Selesai/Tunda/Batal/Regret), diambil
     * dari $statusColumn milik model dengan alasan yang sama seperti di atas.
     */
    public function kolomStatus(): string
    {
        return (new ($this->modelClass()))->kolomStatus();
    }

    /**
     * Judul kolom "judul peristiwa" di tabel index & file ekspor. Sama seperti
     * kolomJudul(), labelnya TIDAK senama dengan modul untuk Undangan, Audiensi,
     * dan Kunjungan.
     */
    public function labelJudul(): string
    {
        return match ($this) {
            self::Kerjasama => 'Kerjasama',
            self::Kolaborasi => 'Kolaborasi',
            self::Undangan => 'Acara',
            self::Audiensi => 'Topik',
            self::Kunjungan => 'Perihal',
            self::AcaraDki => 'Acara DKI',
        };
    }

    /**
     * True bila satu baris modul ini menunjuk ke TEPAT SATU mitra lewat
     * `id_mitra` (pola ReferencesMitra) — berlaku untuk kelima modul selain
     * Acara DKI, yang justru memakai pivot banyak-mitra.
     *
     * Dipakai agar kode yang perlu menampilkan "mitra mana" tidak perlu
     * menyebut nama modulnya satu per satu.
     */
    public function berbasisMitraTunggal(): bool
    {
        return $this !== self::AcaraDki;
    }

    /**
     * Kolom triwulan (TW I–IV). Keenam migration konsisten menamainya
     * "triwulan_" + nama tabel tanpa awalan "tb_", jadi diturunkan dari
     * nama tabel model — bukan ditebak dari nama modul.
     */
    public function kolomTriwulan(): string
    {
        return 'triwulan_'.str((new ($this->modelClass()))->getTable())->after('tb_');
    }

    /**
     * Nama relasi di App\Models\Concerns\HasRiwayatDiplomasi (sisi Mitra) —
     * padanan TipeMitra::relasi(). Dipakai tab Riwayat Diplomasi pada halaman
     * profil mitra (komponen x-mitra-riwayat).
     */
    public function relasi(): string
    {
        return match ($this) {
            self::Kerjasama => 'kerjasama',
            self::Kolaborasi => 'kolaborasi',
            self::Undangan => 'undangan',
            self::Audiensi => 'audiensi',
            self::Kunjungan => 'kunjungan',
            self::AcaraDki => 'acaraDki',
        };
    }

    public function routeIndex(): string
    {
        return $this->prefixRoute().'.index';
    }

    public function routeEdit(): string
    {
        return $this->prefixRoute().'.edit';
    }

    /**
     * URL unduhan daftar modul ini, dipakai x-tombol-ekspor. Padanan
     * TipeMitra::urlEkspor().
     *
     * @param  'excel'|'pdf'  $format
     * @param  array{status?: string, tahun?: string}  $filter
     */
    public function urlEkspor(string $format, array $filter = []): string
    {
        return route('ekspor.'.$format, ['modul' => $this->slug(), ...$filter]);
    }

    /**
     * Nama resource route modul ini di routes/web.php.
     */
    private function prefixRoute(): string
    {
        return match ($this) {
            self::Kerjasama => 'kerjasama',
            self::Kolaborasi => 'kolaborasi',
            self::Undangan => 'undangan',
            self::Audiensi => 'audiensi',
            self::Kunjungan => 'kunjungan',
            self::AcaraDki => 'acara-dki',
        };
    }

    /**
     * Ikon Font Awesome (tanpa awalan "fa-solid fa-") dan warna Tabler, dipakai
     * sebagai penanda visual modul. Nilainya disamakan dengan kartu akumulasi
     * Riwayat Diplomasi di dashboard supaya satu modul berpenampilan konsisten.
     */
    public function ikon(): string
    {
        return match ($this) {
            self::Kerjasama => 'folder-closed',
            self::Kolaborasi => 'thumbs-up',
            self::Undangan => 'envelope',
            self::Audiensi => 'comments',
            self::Kunjungan => 'user-graduate',
            self::AcaraDki => 'calendar-days',
        };
    }

    public function warna(): string
    {
        return match ($this) {
            self::Kerjasama => 'green',
            self::Kolaborasi => 'yellow',
            self::Undangan => 'red',
            self::Audiensi => 'azure',
            self::Kunjungan => 'lime',
            self::AcaraDki => 'orange',
        };
    }

    /**
     * Cari modul berdasarkan slug-nya, mis. untuk memvalidasi segmen URL.
     */
    public static function dariSlug(?string $slug): ?self
    {
        foreach (self::cases() as $modul) {
            if ($modul->slug() === $slug) {
                return $modul;
            }
        }

        return null;
    }
}
