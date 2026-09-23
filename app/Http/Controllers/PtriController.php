<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StorePtriRequest;
use App\Http\Requests\UpdatePtriRequest;
use App\Models\Ptri;

/**
 * Perutusan Tetap Republik Indonesia pada organisasi internasional.
 *
 * Mengikuti pola NonPerwakilanNegaraAsingController: mitra jenis ini hanya
 * mencatat nama + keterangan, dan "hapus" berarti menonaktifkan (is_active =
 * false) baik baris subtype maupun baris tb_mitra pasangannya.
 */
class PtriController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $ptri = Ptri::where('is_active', true)->orderBy('nama_ptri')->get();

        return view('mod_ptri.index', compact('ptri'));
    }

    public function show(Ptri $ptri)
    {
        $ptri->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
        ]);

        return view('mod_ptri.show', compact('ptri'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_ptri.create');
    }

    public function store(StorePtriRequest $request)
    {
        Ptri::create($request->validated());

        return redirect()->route('ptri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data PTRI berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(Ptri $ptri)
    {
        return view('mod_ptri.edit', compact('ptri'));
    }

    public function update(UpdatePtriRequest $request, Ptri $ptri)
    {
        $ptri->update($request->validated());

        return redirect()->route('ptri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data PTRI berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(Ptri $ptri)
    {
        $this->nonaktifkanMitra($ptri);

        return redirect()->route('ptri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data PTRI berhasil dinonaktifkan.',
        ]);
    }
}
