<?php

namespace App\Enums;

use App\Models\Kbri;
use App\Models\KedutaanBesar;
use App\Models\Kjri;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Models\NonPerwakilanNegaraAsing;
use App\Models\PemprovDki;
use App\Models\Ptri;
use Illuminate\Database\Eloquent\Model;

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
    case NonPNA = 'Non Perwakilan Negara Asing';
    case PemprovDki = 'Pemerintah Provinsi DKI Jakarta';
    case Kbri = 'Kedutaan Besar Republik Indonesia (KBRI)';
    case Kjri = 'Konsulat Jenderal Republik Indonesia (KJRI)';
    case Ptri = 'Perutusan Tetap Republik Indonesia (PTRI)';

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
            self::NonPNA => 'non_pna',
            self::PemprovDki => 'pemprov_dki',
            self::Kbri => 'kbri',
            self::Kjri => 'kjri',
            self::Ptri => 'ptri',
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
            self::NonPNA => NonPerwakilanNegaraAsing::class,
            self::PemprovDki => PemprovDki::class,
            self::Kbri => Kbri::class,
            self::Kjri => Kjri::class,
            self::Ptri => Ptri::class,
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
            self::NonPNA => 'nonPerwakilanNegaraAsing',
            self::PemprovDki => 'pemprovDki',
            self::Kbri => 'kbri',
            self::Kjri => 'kjri',
            self::Ptri => 'ptri',
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
            self::NonPNA => 'nama_non_perwakilan_negara_asing',
            self::PemprovDki => 'nama_pemprov_dki',
            self::Kbri => 'nama_kbri',
            self::Kjri => 'nama_kjri',
            self::Ptri => 'nama_ptri',
        };
    }

    /**
     * True bila subtype-nya punya kolom `kode_negara`/`nama_negara` — yaitu
     * perwakilan negara asing di Jakarta, yang di UI ditampilkan dengan bendera
     * negara dan dinamai menurut negaranya.
     *
     * False untuk mitra yang hanya mencatat nama + keterangan (Non-PNA, Pemprov
     * DKI, KBRI, KJRI, PTRI) — UI-nya memakai ikon generik dan nama resmi.
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
     * Permanen Negara ASEAN", "KBRI" alih-alih nama panjangnya).
     */
    public function labelSingkat(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'Kedutaan Besar',
            self::MisiAsingAsean => 'Misi Asing ASEAN',
            self::MisiPermanenAsean => 'Misi Permanen ASEAN',
            self::NonPNA => 'Mitra Non-PNA',
            self::PemprovDki => 'Pemprov DKI Jakarta',
            self::Kbri => 'KBRI',
            self::Kjri => 'KJRI',
            self::Ptri => 'PTRI',
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
            self::NonPNA => 'non-perwakilan-negara-asing.index',
            self::PemprovDki => 'pemprov-dki.index',
            self::Kbri => 'kbri.index',
            self::Kjri => 'kjri.index',
            self::Ptri => 'ptri.index',
        };
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
            self::NonPNA => 'building-columns',
            self::PemprovDki => 'city',
            self::Kbri => 'building-flag',
            self::Kjri => 'passport',
            self::Ptri => 'earth-asia',
        };
    }

    public function warna(): string
    {
        return match ($this) {
            self::KedutaanBesar => 'blue',
            self::MisiAsingAsean => 'azure',
            self::MisiPermanenAsean => 'indigo',
            self::NonPNA => 'purple',
            self::PemprovDki => 'teal',
            self::Kbri => 'cyan',
            self::Kjri => 'lime',
            self::Ptri => 'pink',
        };
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
