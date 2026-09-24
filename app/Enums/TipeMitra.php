<?php

namespace App\Enums;

use App\Models\KantorDagangAsing;
use App\Models\KedutaanBesar;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Models\NonPerwakilanNegaraAsing;
use App\Models\PemprovDki;
use App\Models\PerwakilanRi;
use App\Models\PusatKebudayaanAsing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Daftar jenis mitra Biro KSD sekaligus SUMBER TUNGGAL metadata tiap jenis.
 *
 * Seluruh kode yang perlu "tahu ada tipe mitra apa saja" — Mitra::subtype(),
 * eager-load relasi di controller Riwayat Diplomasi, dropdown pemilihan mitra
 * (x-mitra-picker & form Acara DKI), ikon mitra, sampai lookup mitra di seeder —
 * WAJIB menurunkannya dari enum ini, bukan menuliskan daftarnya sendiri.
 *
 * Konsekuensinya: menambah jenis mitra baru cukup (1) tambah case di sini,
 * (2) buat migration + model subtype-nya, (3) buat controller/view/route
 * modulnya. Tidak ada lagi daftar tipe yang tersebar dan harus disisir manual.
 */
enum TipeMitra: string
{
    case KedutaanBesar = 'Kedutaan Besar';
    case MisiAsingAsean = 'Misi Asing untuk ASEAN';
    case MisiPermanenAsean = 'Misi Permanen Negara ASEAN';
    case KantorDagangAsing = 'Kantor Dagang Asing';
    case PusatKebudayaanAsing = 'Pusat Kebudayaan Asing';
    case PerwakilanRi = 'Perwakilan RI di Luar Negeri';
    case PemprovDki = 'Pemerintah Provinsi DKI Jakarta';
    case NonPNA = 'Non Perwakilan Negara Asing';

    /**
     * Kunci teknis tipe mitra — dipakai sebagai value <option> pada dropdown
     * tipe di form, dan sebagai key array daftar mitra per tipe.
     */
    public function slug(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'kedutaan_besar',
            self::MisiAsingAsean => 'misi_asing_asean',
            self::MisiPermanenAsean => 'misi_permanen_asean',
            self::KantorDagangAsing => 'kantor_dagang_asing',
            self::PusatKebudayaanAsing => 'pusat_kebudayaan_asing',
            self::PerwakilanRi => 'perwakilan_ri',
            self::PemprovDki => 'pemprov_dki',
            self::NonPNA => 'non_pna',
        };
    }

    /**
     * Class model subtype pemilik baris tb_mitra bertipe ini.
     *
     * @return class-string<Model>
     */
    public function modelClass(): string
    {
        return match ($this) {
            self::KedutaanBesar => KedutaanBesar::class,
            self::MisiAsingAsean => MisiAsingAsean::class,
            self::MisiPermanenAsean => MisiPermanenAsean::class,
            self::KantorDagangAsing => KantorDagangAsing::class,
            self::PusatKebudayaanAsing => PusatKebudayaanAsing::class,
            self::PerwakilanRi => PerwakilanRi::class,
            self::PemprovDki => PemprovDki::class,
            self::NonPNA => NonPerwakilanNegaraAsing::class,
        };
    }

    /**
     * Nama relasi hasOne dari Mitra (supertype) ke tabel subtype-nya.
     */
    public function relasi(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'kedutaanBesar',
            self::MisiAsingAsean => 'misiAsingAsean',
            self::MisiPermanenAsean => 'misiPermanenAsean',
            self::KantorDagangAsing => 'kantorDagangAsing',
            self::PusatKebudayaanAsing => 'pusatKebudayaanAsing',
            self::PerwakilanRi => 'perwakilanRi',
            self::PemprovDki => 'pemprovDki',
            self::NonPNA => 'nonPerwakilanNegaraAsing',
        };
    }

    /**
     * Kolom nama resmi (Bahasa Indonesia) pada tabel subtype — namanya berbeda
     * per tabel, sehingga tidak bisa diakses lewat properti generik.
     */
    public function kolomNama(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'nama_kedutaan_besar_id',
            self::MisiAsingAsean => 'nama_misi_asing_asean_id',
            self::MisiPermanenAsean => 'nama_misi_permanen_asean_id',
            self::KantorDagangAsing => 'nama_kantor_dagang_asing',
            self::PusatKebudayaanAsing => 'nama_pusat_kebudayaan_asing',
            self::PerwakilanRi => 'nama_perwakilan_ri',
            self::PemprovDki => 'nama_pemprov_dki',
            self::NonPNA => 'nama_non_perwakilan_negara_asing',
        };
    }

    /**
     * True bila subtype-nya punya kolom `kode_negara`/`nama_negara` — yaitu
     * perwakilan negara asing di Jakarta, yang di UI ditampilkan dengan bendera
     * negara dan dinamai menurut negaranya.
     *
     * False untuk mitra yang hanya mencatat nama + keterangan (Kantor Dagang
     * Asing, Pusat Kebudayaan Asing, Perwakilan RI, Pemprov DKI, Non-PNA) —
     * UI-nya memakai ikon generik dan nama resmi.
     */
    public function berbasisNegara(): bool
    {
        return match ($this) {
            self::KedutaanBesar, self::MisiAsingAsean, self::MisiPermanenAsean => true,
            default => false,
        };
    }

    /**
     * Label pendek untuk tempat sempit — kartu akumulasi dashboard, navbar,
     * kolom tabel. Bedanya dengan ->value: yang ini memangkas kata yang sudah
     * jelas dari konteksnya (mis. "Misi Permanen ASEAN" alih-alih "Misi
     * Permanen Negara ASEAN", "Mitra Non-PNA" alih-alih nama panjangnya).
     */
    public function labelSingkat(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'Kedutaan Besar',
            self::MisiAsingAsean => 'Misi Asing ASEAN',
            self::MisiPermanenAsean => 'Misi Permanen ASEAN',
            self::KantorDagangAsing => 'Kantor Dagang Asing',
            self::PusatKebudayaanAsing => 'Pusat Kebudayaan Asing',
            self::PerwakilanRi => 'Perwakilan RI di Luar Negeri',
            self::PemprovDki => 'Pemprov DKI Jakarta',
            self::NonPNA => 'Mitra Non-PNA',
        };
    }

    /**
     * Nama route index modul mitra ini, mis. untuk menjadikan kartu dashboard
     * tautan ke daftar modulnya.
     */
    public function routeIndex(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'kedutaan-besar.index',
            self::MisiAsingAsean => 'misi-asing-asean.index',
            self::MisiPermanenAsean => 'misi-permanen-asean.index',
            self::KantorDagangAsing => 'kantor-dagang-asing.index',
            self::PusatKebudayaanAsing => 'pusat-kebudayaan-asing.index',
            self::PerwakilanRi => 'perwakilan-ri.index',
            self::PemprovDki => 'pemprov-dki.index',
            self::NonPNA => 'non-perwakilan-negara-asing.index',
        };
    }

    /**
     * Nama route show (profil + Riwayat Diplomasi) modul mitra ini, mis. untuk
     * menjadikan kartu "Mitra Diplomasi Paling Aktif" di dashboard tautan ke
     * profil mitranya. Diturunkan dari routeIndex() karena kedua route lahir
     * dari Route::resource yang sama — tidak perlu daftar kedua.
     */
    public function routeShow(): string
    {
        return Str::replaceLast('.index', '.show', $this->routeIndex());
    }

    /**
     * Ikon Font Awesome (tanpa awalan "fa-solid fa-") dan warna Tabler untuk
     * penanda visual tipe ini di dashboard.
     *
     * Metadata tampilan sengaja ditaruh di enum — bukan di blade — supaya
     * dashboard tidak perlu menuliskan daftar tipe mitra lagi. Lihat CLAUDE.md
     * Bagian 3: daftar tipe mitra hanya boleh hidup di enum ini.
     */
    public function ikon(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'landmark',
            self::MisiAsingAsean => 'flag',
            self::MisiPermanenAsean => 'flag-checkered',
            self::KantorDagangAsing => 'briefcase',
            self::PusatKebudayaanAsing => 'masks-theater',
            self::PerwakilanRi => 'building-flag',
            self::PemprovDki => 'city',
            self::NonPNA => 'building-columns',
        };
    }

    public function warna(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'blue',
            self::MisiAsingAsean => 'azure',
            self::MisiPermanenAsean => 'indigo',
            self::KantorDagangAsing => 'orange',
            self::PusatKebudayaanAsing => 'green',
            self::PerwakilanRi => 'cyan',
            self::PemprovDki => 'teal',
            self::NonPNA => 'purple',
        };
    }

    /**
     * Cari tipe berdasarkan slug-nya, mis. untuk memvalidasi segmen URL pada
     * modul Restore Data. Kembalikan null bila slug tidak dikenal, supaya
     * pemanggilnya bisa abort(404) alih-alih menebak-nebak.
     */
    public static function dariSlug(?string $slug): ?self
    {
        foreach (self::cases() as $tipe) {
            if ($tipe->slug() === $slug) {
                return $tipe;
            }
        }

        return null;
    }

    /**
     * Daftar relasi untuk eager-load dari sisi Riwayat Diplomasi, mis.
     * with(TipeMitra::relasiMitra()) agar accessor nama_resmi_mitra tidak N+1.
     *
     * @return list<string>
     */
    public static function relasiMitra(string $prefix = 'mitra.'): array
    {
        return array_map(fn (self $tipe) => $prefix.$tipe->relasi(), self::cases());
    }
}
