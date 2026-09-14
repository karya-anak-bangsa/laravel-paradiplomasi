<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Undangan;
use App\Http\Requests\StoreUndanganRequest;

class UndanganController extends Controller
{
    public function index()
    {
        $undangan = Undangan::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_undangan.index', compact('undangan'));
    }

    public function show(Undangan $undangan)
    {
        $undangan->load('kedutaanBesar');
        return view('mod_undangan.show', compact('undangan'));
    }

    public function create()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_undangan.create', compact('kedutaanBesar')); // sesuaikan nama view per modul
    }

    public function store(StoreUndanganRequest $request)
    {
        Undangan::create($request->validated());
        return redirect()->route('undangan.index');
    }

    public function edit(Undangan $undangan)
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        $undangan->load('kedutaanBesar');
        return view('mod_undangan.edit', compact('undangan', 'kedutaanBesar'));
    }

    public function update(StoreUndanganRequest $request, Undangan $undangan)
    {
        $undangan->update($request->validated());
        return redirect()->route('undangan.index');
    }

    public function destroy(Undangan $undangan)
    {
        $undangan->update(['is_active' => false]);
        return redirect()->route('undangan.index');
    }
}
