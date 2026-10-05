<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreNonPerwakilanNegaraAsingRequest;
use App\Http\Requests\UpdateNonPerwakilanNegaraAsingRequest;
use App\Models\NonPerwakilanNegaraAsing;
use Illuminate\Http\Request;

class NonPerwakilanNegaraAsingController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $nonPerwakilanNegaraAsing = NonPerwakilanNegaraAsing::daftarIndex()->get();

        return view('mod_non_perwakilan_negara_asing.index', compact('nonPerwakilanNegaraAsing'));
    }

    public function show(Request $request, NonPerwakilanNegaraAsing $nonPerwakilanNegaraAsing)
    {
        $nonPerwakilanNegaraAsing->muatRiwayatDiplomasi($request->query('tahun'));

        return view('mod_non_perwakilan_negara_asing.show', compact('nonPerwakilanNegaraAsing'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_non_perwakilan_negara_asing.create');
    }

    public function store(StoreNonPerwakilanNegaraAsingRequest $request)
    {
        NonPerwakilanNegaraAsing::create($request->validated());

        return redirect()->route('non-perwakilan-negara-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data non perwakilan negara asing berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(NonPerwakilanNegaraAsing $nonPerwakilanNegaraAsing)
    {
        return view('mod_non_perwakilan_negara_asing.edit', compact('nonPerwakilanNegaraAsing'));
    }

    public function update(UpdateNonPerwakilanNegaraAsingRequest $request, NonPerwakilanNegaraAsing $nonPerwakilanNegaraAsing)
    {
        $nonPerwakilanNegaraAsing->update($request->validated());

        return redirect()->route('non-perwakilan-negara-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data non perwakilan negara asing berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(NonPerwakilanNegaraAsing $nonPerwakilanNegaraAsing)
    {
        $this->nonaktifkanMitra($nonPerwakilanNegaraAsing);

        return redirect()->route('non-perwakilan-negara-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data non perwakilan negara asing berhasil dinonaktifkan.',
        ]);
    }
}
