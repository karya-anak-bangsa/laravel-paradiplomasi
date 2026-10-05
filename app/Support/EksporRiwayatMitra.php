<?php

namespace App\Support;

use App\Enums\ModulDiplomasi;
use App\Models\Mitra;
use Illuminate\Support\Str;

/**
 * Isi file ekspor (Excel & PDF) seluruh Riwayat Diplomasi satu mitra — tombol
 * Ekspor di kartu "Riwayat Diplomasi" halaman profil mitra (8 jenis mitra).
 *
 * Berbeda dengan EksporDiplomasi/EksporMitra yang satu tabel, file ini dibagi
 * per modul (arahan user, 5 Okt 2026): Excel satu sheet per modul, PDF satu
 * tabel berjudul per modul — sama dengan keenam tab di halaman profil. Tiap
 * bagiannya sebuah BagianRiwayatMitra, sehingga format sel, header, dan lebar
 * kolomnya tetap dari DaftarEkspor/DaftarExport/ekspor._tabel.
 *
 * Datanya dimuat lewat HasRiwayatDiplomasi::muatRiwayatDiplomasi() — method
 * yang sama dengan show() controller mitra — sehingga isi file dijamin sama
 * dengan tab yang sedang dilihat, termasuk filter tahunnya.
 */
class EksporRiwayatMitra
{
    /** Tahun yang benar-benar dipakai menyaring (sudah divalidasi), null = semua tahun. */
    public readonly ?string $tahun;

    /** @var list<array<string, mixed>>|null cache lebarKolom() */
    private ?array $barisSemuaBagian = null;

    public function __construct(public readonly Mitra $mitra, mixed $tahun = null)
    {
        $this->tahun = $mitra->saringTahunRiwayat($tahun);
        $mitra->muatRiwayatDiplomasi($this->tahun);
    }

    public function judul(): string
    {
        return 'Riwayat Diplomasi '.$this->mitra->nama_resmi_mitra;
    }

    /** Baris keterangan di bawah judul PDF. */
    public function keterangan(): string
    {
        return ($this->tahun ? 'Tahun '.$this->tahun : 'Seluruh riwayat diplomasi').' - '.$this->jumlahData().' data';
    }

    /**
     * Satu bagian per modul, urut sesuai ModulDiplomasi::cases(). Modul tanpa
     * riwayat tetap ikut (sheet/tabel kosong), supaya isi file selalu lengkap
     * keenam modul. $denganAlasan: lihat BagianRiwayatMitra.
     *
     * @return list<BagianRiwayatMitra>
     */
    public function bagian(bool $denganAlasan = false): array
    {
        return array_map(
            fn (ModulDiplomasi $modul) => new BagianRiwayatMitra($modul, $this->mitra->{$modul->relasi()}, $denganAlasan),
            ModulDiplomasi::cases(),
        );
    }

    /**
     * Lebar kolom PDF (persen) sebuah bagian, dihitung dari baris KEENAM
     * bagian sekaligus — bukan dari baris bagian itu saja — sehingga No,
     * Tanggal, dan Status selebar sama di semua tabel (arahan user, 5 Okt
     * 2026). Kolom judul mengisi sisanya; di Acara DKI dibagi dengan kolom
     * Kehadiran.
     *
     * @return array<string, float>
     */
    public function lebarKolom(BagianRiwayatMitra $bagian): array
    {
        $this->barisSemuaBagian ??= array_merge(...array_map(
            fn (BagianRiwayatMitra $b) => $b->baris(),
            $this->bagian(),
        ));

        return $bagian->lebarKolomSeragam($this->barisSemuaBagian);
    }

    public function jumlahData(): int
    {
        return collect(ModulDiplomasi::cases())->sum(fn (ModulDiplomasi $modul) => $this->mitra->{$modul->relasi()}->count());
    }

    public function namaFile(string $ekstensi): string
    {
        $nama = Str::slug($this->mitra->nama_resmi_mitra ?? 'mitra', '_');

        $tahun = $this->tahun ? $this->tahun.'_' : '';

        return 'riwayat_diplomasi_'.$nama.'_'.$tahun.Waktu::sekarang()->format('Ymd_His').'.'.$ekstensi;
    }
}
