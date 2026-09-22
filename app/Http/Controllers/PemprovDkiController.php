<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePemprovDkiRequest;
use App\Http\Requests\UpdatePemprovDkiRequest;
use App\Models\PemprovDki;

/**
 * Perangkat daerah Pemprov DKI Jakarta (biro/dinas/badan) sebagai mitra Biro KSD.
 *
 * Mengikuti pola NonPerwakilanNegaraAsingController: mitra jenis ini hanya
 * mencatat nama + keterangan, dan "hapus" berarti menonaktifkan (is_active =
 * false) baik baris subtype maupun baris tb_mitra pasangannya.
 */
class PemprovDkiController extends Controller
{
    public function index()
    {
        $pemprovDki = PemprovDki::where('is_active', true)->orderBy('nama_pemprov_dki')->get();

        return view('mod_pemprov_dki.index', compact('pemprovDki'));
    }

    public function show(PemprovDki $pemprovDki)
    {
        $pemprovDki->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
        ]);

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
        $pemprovDki->update(['is_active' => false]);
        $pemprovDki->mitra->update(['is_active' => false]);

        return redirect()->route('pemprov-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Pemprov DKI Jakarta berhasil dinonaktifkan.',
        ]);
    }
}
