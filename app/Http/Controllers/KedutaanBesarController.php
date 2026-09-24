<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreKedutaanBesarRequest;
use App\Http\Requests\UpdateKedutaanBesarRequest;
use App\Models\KedutaanBesar;

class KedutaanBesarController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $kedutaanBesar = KedutaanBesar::daftarIndex()->get();

        return view('mod_kedutaan_besar.index', compact('kedutaanBesar'));
    }

    public function show(KedutaanBesar $kedutaanBesar)
    {
        $kedutaanBesar->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
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
            'type' => 'success',
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
            'type' => 'success',
            'message' => 'Data kedutaan besar berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(KedutaanBesar $kedutaanBesar)
    {
        $this->nonaktifkanMitra($kedutaanBesar);

        return redirect()->route('kedutaan-besar.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kedutaan besar berhasil dinonaktifkan.',
        ]);
    }
}
