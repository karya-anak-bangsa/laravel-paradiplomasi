<?php

namespace App\Exports;

use App\Support\BagianRiwayatMitra;
use App\Support\EksporRiwayatMitra;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * File Excel Riwayat Diplomasi satu mitra: satu sheet per modul. Tiap sheet
 * adalah DaftarExport biasa, jadi format sel (tanggal, teks anti-rumus,
 * autofilter) sama persis dengan ekspor daftar lainnya.
 *
 * Export wajib disebut eksplisit: maatwebsite/excel 4 hanya menerima kelas
 * berpenanda Export, dan WithMultipleSheets tidak mewarisinya.
 */
class RiwayatMitraExport implements Export, WithMultipleSheets
{
    public function __construct(private EksporRiwayatMitra $ekspor) {}

    public function sheets(): array
    {
        return array_map(
            fn (BagianRiwayatMitra $bagian) => new DaftarExport($bagian),
            $this->ekspor->bagian(denganAlasan: true),
        );
    }
}
