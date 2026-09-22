<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKbriRequest;
use App\Http\Requests\UpdateKbriRequest;
use App\Models\Kbri;

/**
 * Kedutaan Besar Republik Indonesia di luar negeri.
 *
 * Mengikuti pola NonPerwakilanNegaraAsingController: mitra jenis ini hanya
 * mencatat nama + keterangan, dan "hapus" berarti menonaktifkan (is_active =
 * false) baik baris subtype maupun baris tb_mitra pasangannya.
 */
class KbriController extends Controller
{
    public function index()
    {
        $kbri = Kbri::where('is_active', true)->orderBy('nama_kbri')->get();

        return view('mod_kbri.index', compact('kbri'));
    }

    public function show(Kbri $kbri)
    {
        $kbri->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
        ]);

        return view('mod_kbri.show', compact('kbri'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_kbri.create');
    }

    public function store(StoreKbriRequest $request)
    {
        Kbri::create($request->validated());

        return redirect()->route('kbri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data KBRI berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(Kbri $kbri)
    {
        return view('mod_kbri.edit', compact('kbri'));
    }

    public function update(UpdateKbriRequest $request, Kbri $kbri)
    {
        $kbri->update($request->validated());

        return redirect()->route('kbri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data KBRI berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(Kbri $kbri)
    {
        $kbri->update(['is_active' => false]);
        $kbri->mitra->update(['is_active' => false]);

        return redirect()->route('kbri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data KBRI berhasil dinonaktifkan.',
        ]);
    }
}
