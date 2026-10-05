<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StorePemprovDkiRequest;
use App\Http\Requests\UpdatePemprovDkiRequest;
use App\Models\PemprovDki;
use Illuminate\Http\Request;

/**
 * Perangkat daerah Pemprov DKI Jakarta (biro/dinas/badan) sebagai mitra Biro KSD.
 *
 * Mengikuti pola NonPerwakilanNegaraAsingController: mitra jenis ini hanya
 * mencatat nama + keterangan, dan "hapus" berarti menonaktifkan (is_active =
 * false) baik baris subtype maupun baris tb_mitra pasangannya.
 */
class PemprovDkiController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $pemprovDki = PemprovDki::daftarIndex()->get();

        return view('mod_pemprov_dki.index', compact('pemprovDki'));
    }

    public function show(Request $request, PemprovDki $pemprovDki)
    {
        $pemprovDki->muatRiwayatDiplomasi($request->query('tahun'));

        return view('mod_pemprov_dki.show', compact('pemprovDki'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_pemprov_dki.create');
    }

    public function store(StorePemprovDkiRequest $request)
    {
        PemprovDki::create($request->validated());

        return redirect()->route('pemprov-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Pemprov DKI Jakarta berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(PemprovDki $pemprovDki)
    {
        return view('mod_pemprov_dki.edit', compact('pemprovDki'));
    }

    public function update(UpdatePemprovDkiRequest $request, PemprovDki $pemprovDki)
    {
        $pemprovDki->update($request->validated());

        return redirect()->route('pemprov-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Pemprov DKI Jakarta berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(PemprovDki $pemprovDki)
    {
        $this->nonaktifkanMitra($pemprovDki);

        return redirect()->route('pemprov-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Pemprov DKI Jakarta berhasil dinonaktifkan.',
        ]);
    }
}
