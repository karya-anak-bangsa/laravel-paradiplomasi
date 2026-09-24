<?php

namespace App\Exports;

use App\Support\EksporDiplomasi;
use DateTimeInterface;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithFreezePane;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RiwayatDiplomasiExport implements FromArray, WithColumnFormatting, WithColumnWidths, WithEvents, WithFreezePane, WithHeadings, WithStyles, WithTitle
{
    public function __construct(private EksporDiplomasi $ekspor) {}

    public function array(): array
    {
        // Tanggal diubah ke nilai serial Excel supaya bisa diurutkan/difilter
        // sebagai tanggal di Excel, bukan sebagai teks. Daftar Undangan Acara
        // DKI ditulis satu mitra per baris di dalam sel.
        return array_map(fn (array $baris) => array_values(array_map(
            fn ($nilai) => match (true) {
                $nilai instanceof DateTimeInterface => Date::dateTimeToExcel($nilai),
                is_array($nilai) => implode("\n", $nilai),
                default => $nilai ?? '-',
            },
            $baris,
        )), $this->ekspor->baris());
    }

    public function headings(): array
    {
        return $this->ekspor->header();
    }

    public function title(): string
    {
        return $this->ekspor->modul->value;
    }

    public function freezePane(): string
    {
        return 'A2';
    }

    public function columnFormats(): array
    {
        return $this->perKolom(fn (string $label) => in_array($label, EksporDiplomasi::KOLOM_TANGGAL) ? 'dd/mm/yyyy' : null);
    }

    public function columnWidths(): array
    {
        return $this->perKolom(fn (string $label) => match ($label) {
            'No' => 6,
            'Status' => 14,
            'Tanggal Diterima', 'Tanggal Selesai' => 18,
            default => 60,
        });
    }

    public function styles(Worksheet $sheet): array
    {
        return [1 => ['font' => ['bold' => true]]];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $area = $sheet->calculateWorksheetDimension();

                $sheet->setAutoFilter($area);
                $sheet->getStyle($area)->getAlignment()
                    ->setWrapText(true)
                    ->setVertical(Alignment::VERTICAL_TOP);
            },
        ];
    }

    /**
     * Petakan tiap label header ke huruf kolom Excel (A, B, ...). Urutan
     * kolom Acara DKI berbeda dari 5 modul lain, jadi hurufnya tidak di-hardcode.
     */
    private function perKolom(callable $nilai): array
    {
        $hasil = [];

        foreach ($this->ekspor->header() as $i => $label) {
            $hasil[Coordinate::stringFromColumnIndex($i + 1)] = $nilai($label);
        }

        return array_filter($hasil, fn ($v) => $v !== null);
    }
}
