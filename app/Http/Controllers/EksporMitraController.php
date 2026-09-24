<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Http\Controllers\Concerns\MengunduhEkspor;
use App\Support\EksporMitra;

class EksporMitraController extends Controller
{
    use MengunduhEkspor;

    public function excel(string $tipe)
    {
        return $this->unduhExcel($this->ekspor($tipe));
    }

    public function pdf(string $tipe)
    {
        return $this->unduhPdf($this->ekspor($tipe));
    }

    private function ekspor(string $slug): EksporMitra
    {
        return new EksporMitra(TipeMitra::dariSlug($slug) ?? abort(404));
    }
}
