<?php

namespace App\Http\Controllers\Concerns;

use App\Exports\DaftarExport;
use App\Support\DaftarEkspor;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPdf;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Satu-satunya tempat file Excel/PDF dibentuk dari sebuah DaftarEkspor.
 * Dipakai EksporDiplomasiController dan EksporMitraController, yang cukup
 * memvalidasi URL lalu menyerahkan isi file-nya ke sini.
 */
trait MengunduhEkspor
{
    protected function unduhExcel(DaftarEkspor $ekspor): BinaryFileResponse
    {
        return Excel::download(new DaftarExport($ekspor), $ekspor->namaFile('xlsx'));
    }

    protected function unduhPdf(DaftarEkspor $ekspor): Response
    {
        // Font subsetting: hanya huruf yang benar-benar dipakai yang disematkan,
        // bukan seluruh font DejaVu (±850 KB per file). Default laravel-dompdf
        // mematikannya.
        $pdf = Pdf::loadView('ekspor.daftar-pdf', ['ekspor' => $ekspor])
            ->setPaper('a4', 'landscape')
            ->setOption('enable_font_subsetting', true);

        $this->nomorHalaman($pdf);

        return $pdf->download($ekspor->namaFile('pdf'));
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
