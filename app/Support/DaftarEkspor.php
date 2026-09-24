<?php

namespace App\Support;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Induk isi file ekspor (Excel & PDF) sebuah tabel index. Turunannya cukup
 * menyebutkan judul, filter, data, dan kolomnya; urusan header, penomoran
 * baris, dan nama file seragam di sini.
 *
 * Turunan: EksporDiplomasi (6 modul Riwayat Diplomasi) dan EksporMitra
 * (8 modul Mitra). Keduanya dirender oleh App\Exports\DaftarExport (Excel)
 * dan view ekspor.daftar-pdf (PDF).
 */
abstract class DaftarEkspor
{
    /** Induk kolom tanggal pada header dua tingkat PDF ("Tanggal" → Diterima | Selesai). */
    public const GRUP_TANGGAL = 'Tanggal';

    public const KOLOM_TANGGAL = [self::GRUP_TANGGAL.' Diterima', self::GRUP_TANGGAL.' Selesai'];

    /** Kolom berisi nilai pendek, dirata-tengah di PDF & dibuat sempit di Excel. */
    public const KOLOM_SEMPIT = ['No', ...self::KOLOM_TANGGAL, 'Status', 'Tipe'];

    abstract public function judul(): string;

    abstract public function keteranganFilter(): string;

    /** Nama sheet Excel (maks. 31 karakter). */
    abstract public function namaSheet(): string;

    /** Bagian nama file setelah "daftar_". */
    abstract protected function slug(): string;

    abstract protected function data(): Collection;

    /**
     * Kolom file, dikunci label header — sengaja sama dengan tabel index
     * modulnya (tanpa kolom Aksi).
     *
     * @return array<string, Closure(Model): mixed>
     */
    abstract protected function kolom(): array;

    public function namaFile(string $ekstensi): string
    {
        return 'daftar_'.$this->slug().'_'.Waktu::sekarang()->format('Ymd_His').'.'.$ekstensi;
    }

    /**
     * @return list<string>
     */
    public function header(): array
    {
        return ['No', ...array_keys($this->kolom())];
    }

    /**
     * Header dua tingkat khusus PDF: kolom tanggal dikelompokkan di bawah
     * satu sel "Tanggal" (colspan), kolom lainnya memanjang dua baris
     * (rowspan). Tabel tanpa kolom tanggal cukup satu tingkat (bawah
     * kosong). Excel tetap memakai header() satu tingkat supaya autofilter
     * dan freeze pane-nya sederhana.
     *
     * @return array{atas: list<array{label: string, colspan: int, rowspan: int}>, bawah: list<string>}
     */
    public function headerBertingkat(): array
    {
        $header = $this->header();
        $rowspan = array_intersect($header, self::KOLOM_TANGGAL) === [] ? 1 : 2;
        $atas = [];
        $bawah = [];

        foreach ($header as $label) {
            if (! in_array($label, self::KOLOM_TANGGAL)) {
                $atas[] = ['label' => $label, 'colspan' => 1, 'rowspan' => $rowspan];

                continue;
            }

            if ($bawah === []) {
                $atas[] = ['label' => self::GRUP_TANGGAL, 'colspan' => count(self::KOLOM_TANGGAL), 'rowspan' => 1];
            }

            $bawah[] = Str::after($label, self::GRUP_TANGGAL.' ');
        }

        return ['atas' => $atas, 'bawah' => $bawah];
    }

    /**
     * Satu array per baris, dikunci label header. Tanggal dibiarkan berupa
     * objek tanggal supaya Excel bisa menyimpannya sebagai tanggal sungguhan.
     * Teks boleh berisi "\n" untuk nilai dua baris (mis. nama ID + EN).
     *
     * @return list<array<string, mixed>>
     */
    public function baris(): array
    {
        $kolom = $this->kolom();

        return $this->data()->values()->map(fn (Model $item, int $i) => [
            'No' => $i + 1,
            ...array_map(fn (Closure $nilai) => $nilai($item), $kolom),
        ])->all();
    }
}
