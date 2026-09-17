<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Http\Requests\StoreKedutaanBesarRequest;
use App\Http\Requests\UpdateKedutaanBesarRequest;

class KedutaanBesarController extends Controller
{
    public function index()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_kedutaan_besar.index', compact('kedutaanBesar'));
    }

    public function show(KedutaanBesar $kedutaanBesar)
    {
        $kedutaanBesar->load([
            'kerjasama'     => fn($query) => $query->latest('tanggal_diterima'),
            'kolaborasi'    => fn($query) => $query->latest('tanggal_diterima'),
            'undangan'      => fn($query) => $query->latest('tanggal_diterima'),
            'audiensi'      => fn($query) => $query->latest('tanggal_diterima'),
            'kunjungan'     => fn($query) => $query->latest('tanggal_diterima'),
        ]);
        return view('mod_kedutaan_besar.show', compact('kedutaanBesar'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_kedutaan_besar.create');
    }

    public function store(StoreKedutaanBesarRequest $request)
    {
        KedutaanBesar::create($request->validated());
        return redirect()->route('kedutaan-besar.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kedutaan besar berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(KedutaanBesar $kedutaanBesar)
    {
        return view('mod_kedutaan_besar.edit', compact('kedutaanBesar'));
    }

    public function update(UpdateKedutaanBesarRequest $request, KedutaanBesar $kedutaanBesar)
    {
        $kedutaanBesar->update($request->validated());
        return redirect()->route('kedutaan-besar.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kedutaan besar berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(KedutaanBesar $kedutaanBesar)
    {
        $kedutaanBesar->update(['is_active' => false]);
        return redirect()->route('kedutaan-besar.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kedutaan besar berhasil dinonaktifkan.',
        ]);
    }
}
