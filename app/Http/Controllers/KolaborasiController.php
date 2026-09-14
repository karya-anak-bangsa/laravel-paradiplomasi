<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Kolaborasi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKolaborasiRequest;

class KolaborasiController extends Controller
{
    public function index()
    {
        $kolaborasi = Kolaborasi::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_kolaborasi.index', compact('kolaborasi'));
    }

    public function show(Kolaborasi $kolaborasi)
    {
        $kolaborasi->load('kedutaanBesar');
        return view('mod_kolaborasi.show', compact('kolaborasi'));
    }

    public function create()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_kolaborasi.create', compact('kedutaanBesar'));
    }

    public function store(StoreKolaborasiRequest $request)
    {
        Kolaborasi::create($request->validated());
        return redirect()->route('kolaborasi.index');
    }

    public function edit(Kolaborasi $kolaborasi)
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        $kolaborasi->load('kedutaanBesar');
        return view('mod_kolaborasi.edit', compact('kolaborasi', 'kedutaanBesar'));
    }

    public function update(StoreKolaborasiRequest $request, Kolaborasi $kolaborasi)
    {
        $kolaborasi->update($request->validated());
        return redirect()->route('kolaborasi.index');
    }

    public function destroy(Kolaborasi $kolaborasi)
    {
        $kolaborasi->update(['is_active' => false]);
        return redirect()->route('kolaborasi.index');
    }
}
