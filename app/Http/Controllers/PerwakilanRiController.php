<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StorePerwakilanRiRequest;
use App\Http\Requests\UpdatePerwakilanRiRequest;
use App\Models\PerwakilanRi;

/**
 * Perwakilan RI di luar negeri (KBRI, KJRI, PTRI).
 *
 * Mengikuti pola NonPerwakilanNegaraAsingController, ditambah satu kolom
 * pilihan tipe_perwakilan_ri. "Hapus" berarti menonaktifkan (is_active =
 * false) baik baris subtype maupun baris tb_mitra pasangannya.
 */
class PerwakilanRiController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $perwakilanRi = PerwakilanRi::daftarIndex()->get();

        return view('mod_perwakilan_ri.index', compact('perwakilanRi'));
    }

    public function show(PerwakilanRi $perwakilanRi)
    {
        $perwakilanRi->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
        ]);

        return view('mod_perwakilan_ri.show', compact('perwakilanRi'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_perwakilan_ri.create');
    }

    public function store(StorePerwakilanRiRequest $request)
    {
        PerwakilanRi::create($request->validated());

        return redirect()->route('perwakilan-ri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Perwakilan RI berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(PerwakilanRi $perwakilanRi)
    {
        return view('mod_perwakilan_ri.edit', compact('perwakilanRi'));
    }

    public function update(UpdatePerwakilanRiRequest $request, PerwakilanRi $perwakilanRi)
    {
        $perwakilanRi->update($request->validated());

        return redirect()->route('perwakilan-ri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Perwakilan RI berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(PerwakilanRi $perwakilanRi)
    {
        $this->nonaktifkanMitra($perwakilanRi);

        return redirect()->route('perwakilan-ri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Perwakilan RI berhasil dinonaktifkan.',
        ]);
    }
}
