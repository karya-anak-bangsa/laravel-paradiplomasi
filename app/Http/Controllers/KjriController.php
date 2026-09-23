<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreKjriRequest;
use App\Http\Requests\UpdateKjriRequest;
use App\Models\Kjri;

/**
 * Konsulat Jenderal Republik Indonesia di luar negeri.
 *
 * Mengikuti pola NonPerwakilanNegaraAsingController: mitra jenis ini hanya
 * mencatat nama + keterangan, dan "hapus" berarti menonaktifkan (is_active =
 * false) baik baris subtype maupun baris tb_mitra pasangannya.
 */
class KjriController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $kjri = Kjri::where('is_active', true)->orderBy('nama_kjri')->get();

        return view('mod_kjri.index', compact('kjri'));
    }

    public function show(Kjri $kjri)
    {
        $kjri->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
        ]);

        return view('mod_kjri.show', compact('kjri'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_kjri.create');
    }

    public function store(StoreKjriRequest $request)
    {
        Kjri::create($request->validated());

        return redirect()->route('kjri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data KJRI berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(Kjri $kjri)
    {
        return view('mod_kjri.edit', compact('kjri'));
    }

    public function update(UpdateKjriRequest $request, Kjri $kjri)
    {
        $kjri->update($request->validated());

        return redirect()->route('kjri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data KJRI berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(Kjri $kjri)
    {
        $this->nonaktifkanMitra($kjri);

        return redirect()->route('kjri.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data KJRI berhasil dinonaktifkan.',
        ]);
    }
}
