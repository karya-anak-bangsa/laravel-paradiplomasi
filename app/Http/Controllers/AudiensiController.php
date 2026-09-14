<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Audiensi;
use App\Http\Requests\StoreAudiensiRequest;

class AudiensiController extends Controller
{
    public function index()
    {
        $audiensi = Audiensi::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_audiensi.index', compact('audiensi'));
    }

    public function show(Audiensi $audiensi)
    {
        $audiensi->load('kedutaanBesar');
        return view('mod_audiensi.show', compact('audiensi'));
    }

    public function create()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_audiensi.create', compact('kedutaanBesar'));
    }

    public function store(StoreAudiensiRequest $request)
    {
        Audiensi::create($request->validated());
        return redirect()->route('audiensi.index');
    }

    public function edit(Audiensi $audiensi)
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        $audiensi->load('kedutaanBesar');
        return view('mod_audiensi.edit', compact('audiensi', 'kedutaanBesar'));
    }

    public function update(StoreAudiensiRequest $request, Audiensi $audiensi)
    {
        $audiensi->update($request->validated());
        return redirect()->route('audiensi.index');
    }

    public function destroy(Audiensi $audiensi)
    {
        $audiensi->update(['is_active' => false]);
        return redirect()->route('audiensi.index');
    }
}
