<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StorePusatKebudayaanAsingRequest;
use App\Http\Requests\UpdatePusatKebudayaanAsingRequest;
use App\Models\PusatKebudayaanAsing;

/**
 * Pusat kebudayaan asing di Jakarta.
 *
 * Mengikuti pola NonPerwakilanNegaraAsingController: mitra jenis ini hanya
 * mencatat nama + keterangan, dan "hapus" berarti menonaktifkan (is_active =
 * false) baik baris subtype maupun baris tb_mitra pasangannya.
 */
class PusatKebudayaanAsingController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $pusatKebudayaanAsing = PusatKebudayaanAsing::daftarIndex()->get();

        return view('mod_pusat_kebudayaan_asing.index', compact('pusatKebudayaanAsing'));
    }

    public function show(PusatKebudayaanAsing $pusatKebudayaanAsing)
    {
        $pusatKebudayaanAsing->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
        ]);

        return view('mod_pusat_kebudayaan_asing.show', compact('pusatKebudayaanAsing'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_pusat_kebudayaan_asing.create');
    }

    public function store(StorePusatKebudayaanAsingRequest $request)
    {
        PusatKebudayaanAsing::create($request->validated());

        return redirect()->route('pusat-kebudayaan-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Pusat Kebudayaan Asing berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(PusatKebudayaanAsing $pusatKebudayaanAsing)
    {
        return view('mod_pusat_kebudayaan_asing.edit', compact('pusatKebudayaanAsing'));
    }

    public function update(UpdatePusatKebudayaanAsingRequest $request, PusatKebudayaanAsing $pusatKebudayaanAsing)
    {
        $pusatKebudayaanAsing->update($request->validated());

        return redirect()->route('pusat-kebudayaan-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Pusat Kebudayaan Asing berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(PusatKebudayaanAsing $pusatKebudayaanAsing)
    {
        $this->nonaktifkanMitra($pusatKebudayaanAsing);

        return redirect()->route('pusat-kebudayaan-asing.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data Pusat Kebudayaan Asing berhasil dinonaktifkan.',
        ]);
    }
}
