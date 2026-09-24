<?php

namespace App\Http\Controllers;

use App\Enums\ModulDiplomasi;
use App\Exports\RiwayatDiplomasiExport;
use App\Support\EksporDiplomasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class EksporDiplomasiController extends Controller
{
    public function excel(Request $request, string $modul)
    {
        $ekspor = $this->ekspor($request, $modul);

        return Excel::download(new RiwayatDiplomasiExport($ekspor), $ekspor->namaFile('xlsx'));
    }

    public function pdf(Request $request, string $modul)
    {
        $ekspor = $this->ekspor($request, $modul);

        // Font subsetting: hanya huruf yang benar-benar dipakai yang disematkan,
        // bukan seluruh font DejaVu (±850 KB per file). Default laravel-dompdf
        // mematikannya.
        $pdf = Pdf::loadView('ekspor.riwayat-diplomasi-pdf', ['ekspor' => $ekspor])
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

    /**
     * Filter status/tahun divalidasi dulu karena nilainya ikut tercetak di
     * judul file, jadi tidak boleh berisi teks sembarang dari query string.
     */
    private function ekspor(Request $request, string $slug): EksporDiplomasi
    {
        $modul = ModulDiplomasi::dariSlug($slug) ?? abort(404);

        $filter = $request->validate([
            'status' => ['nullable', Rule::in(array_keys($modul->modelClass()::STATUS_OPTIONS))],
            'tahun' => ['nullable', 'integer'],
        ]);

        return new EksporDiplomasi($modul, $filter['status'] ?? null, $filter['tahun'] ?? null);
    }
}
