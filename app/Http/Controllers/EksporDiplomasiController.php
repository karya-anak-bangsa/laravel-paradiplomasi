<?php

namespace App\Http\Controllers;

use App\Enums\ModulDiplomasi;
use App\Http\Controllers\Concerns\MengunduhEkspor;
use App\Support\EksporDiplomasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EksporDiplomasiController extends Controller
{
    use MengunduhEkspor;

    public function excel(Request $request, string $modul)
    {
        return $this->unduhExcel($this->ekspor($request, $modul));
    }

    public function pdf(Request $request, string $modul)
    {
        return $this->unduhPdf($this->ekspor($request, $modul));
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
