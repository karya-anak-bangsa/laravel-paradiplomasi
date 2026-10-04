<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Http\Controllers\Concerns\MengunduhEkspor;
use App\Support\EksporMitra;
use Illuminate\Http\Request;

class EksporMitraController extends Controller
{
    use MengunduhEkspor;

    public function excel(Request $request, string $tipe)
    {
        return $this->unduhExcel($this->ekspor($request, $tipe));
    }

    public function pdf(Request $request, string $tipe)
    {
        return $this->unduhPdf($this->ekspor($request, $tipe));
    }

    private function ekspor(Request $request, string $slug): EksporMitra
    {
        return new EksporMitra(TipeMitra::dariSlug($slug) ?? abort(404), $this->idTerpilih($request));
    }
}
