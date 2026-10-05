<?php

namespace App\Http\Controllers\Concerns;

use App\Exports\DaftarExport;
use App\Exports\RiwayatMitraExport;
use App\Support\DaftarEkspor;
use App\Support\EksporRiwayatMitra;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Satu-satunya tempat file Excel/PDF dibentuk dari sebuah DaftarEkspor.
 * Dipakai EksporDiplomasiController, EksporMitraController, dan
 * EksporRiwayatMitraController, yang cukup memvalidasi URL lalu menyerahkan
 * isi file-nya ke sini.
 */
trait MengunduhEkspor
{
    /**
     * Query "?pilih=3,7,12" dari x-tombol-ekspor (ekspor parsial: baris yang
     * dicentang di tabel index). Tidak ada parameter = ekspor seluruh data;
     * ada tapi tak satu pun id valid = 422, supaya pilihan yang rusak tidak
     * diam-diam mengunduh seluruh data.
     *
     * @return list<int>|null
     */
    protected function idTerpilih(Request $request): ?array
    {
        if (! $request->filled('pilih')) {
            return null;
        }

        $id = collect(explode(',', (string) $request->query('pilih')))
            ->filter(fn (string $nilai) => ctype_digit(trim($nilai)))
            ->map(fn (string $nilai) => (int) $nilai)
            ->unique()
            ->values()
            ->all();

        return $id === [] ? abort(422, 'Data yang dipilih tidak valid.') : $id;
    }

    protected function unduhExcel(DaftarEkspor $ekspor): BinaryFileResponse
    {
        return Excel::download(new DaftarExport($ekspor), $ekspor->namaFile('xlsx'));
    }

    protected function unduhPdf(DaftarEkspor $ekspor): Response
    {
        return $this->unduhPdfDariView('ekspor.daftar-pdf', ['ekspor' => $ekspor], $ekspor->namaFile('pdf'));
    }

    /** Riwayat Diplomasi satu mitra: Excel satu sheet per modul. */
    protected function unduhExcelRiwayatMitra(EksporRiwayatMitra $ekspor): BinaryFileResponse
    {
        return Excel::download(new RiwayatMitraExport($ekspor), $ekspor->namaFile('xlsx'));
    }

    /** Riwayat Diplomasi satu mitra: PDF satu tabel berjudul per modul. */
    protected function unduhPdfRiwayatMitra(EksporRiwayatMitra $ekspor): Response
    {
        return $this->unduhPdfDariView('ekspor.riwayat-mitra-pdf', ['ekspor' => $ekspor], $ekspor->namaFile('pdf'));
    }

    private function unduhPdfDariView(string $view, array $data, string $namaFile): Response
    {
        // Font subsetting: hanya huruf yang benar-benar dipakai yang disematkan,
        // bukan seluruh font DejaVu (±850 KB per file). Default laravel-dompdf
        // mematikannya.
        $pdf = Pdf::loadView($view, $data)
            ->setPaper('a4', 'landscape')
            ->setOption('enable_font_subsetting', true);

        $this->nomorHalaman($pdf);

        return $pdf->download($namaFile);
    }

    /**
     * Cetak "Halaman X dari Y" di pojok kanan footer. Harus lewat canvas
     * setelah render karena dompdf tidak mendukung counter(pages) di CSS
     * (hasilnya selalu "dari 0").
     */
    private function nomorHalaman(DomPdf $pdf): void
    {
        $pdf->render();

        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $font = $dompdf->getFontMetrics()->getFont('DejaVu Sans');
        $teks = 'Halaman {PAGE_NUM} dari {PAGE_COUNT}';
        $lebar = $dompdf->getFontMetrics()->getTextWidth('Halaman 99 dari 99', $font, 7.5);

        $canvas->page_text($canvas->get_width() - 27 - $lebar, $canvas->get_height() - 26, $teks, $font, 7.5, [0.39, 0.45, 0.55]);
    }
}
