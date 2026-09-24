<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreKantorDagangAsingRequest;
use App\Http\Requests\UpdateKantorDagangAsingRequest;
use App\Models\KantorDagangAsing;

/**
 * Kantor dagang/ekonomi asing di Jakarta.
 *
 * Mengikuti pola NonPerwakilanNegaraAsingController: mitra jenis ini hanya
 * mencatat nama + keterangan, dan "hapus" berarti menonaktifkan (is_active =
 * false) baik baris subtype maupun baris tb_mitra pasangannya.
 */
class KantorDagangAsingController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $kantorDagangAsing = KantorDagangAsing::daftarIndex()->get();

        return view('mod_kantor_dagang_asing.index', compact('kantorDagangAsing'));
    }

    public function show(KantorDagangAsing $kantorDagangAsing)
    {
        $kantorDagangAsing->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
        ]);

        return view('mod_kantor_dagang_asing.show', compact('kantorDagangAsing'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_kantor_dagang_asing.create');
    }

    public function store(StoreKantorDagangAsingRequest $request)
    {
        KantorDagangAsing::create($request->validated());

        return redirect()->route('kantor-dagang-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Kantor Dagang Asing berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(KantorDagangAsing $kantorDagangAsing)
    {
        return view('mod_kantor_dagang_asing.edit', compact('kantorDagangAsing'));
    }

    public function update(UpdateKantorDagangAsingRequest $request, KantorDagangAsing $kantorDagangAsing)
    {
        $kantorDagangAsing->update($request->validated());

        return redirect()->route('kantor-dagang-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Kantor Dagang Asing berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(KantorDagangAsing $kantorDagangAsing)
    {
        $this->nonaktifkanMitra($kantorDagangAsing);

        return redirect()->route('kantor-dagang-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Kantor Dagang Asing berhasil dinonaktifkan.',
        ]);
    }
}
