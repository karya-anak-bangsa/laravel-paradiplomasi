<?php

namespace App\Http\Controllers;

use App\Models\MisiAsingAsean;
use App\Http\Requests\StoreMisiAsingAseanRequest;
use App\Http\Requests\UpdateMisiAsingAseanRequest;

class MisiAsingAseanController extends Controller
{
    public function index()
    {
        $misiAsingAsean = MisiAsingAsean::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_misi_asing_asean.index', compact('misiAsingAsean'));
    }

    public function show(MisiAsingAsean $misiAsingAsean)
    {
        return view('mod_misi_asing_asean.show', compact('misiAsingAsean'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_misi_asing_asean.create');
    }

    public function store(StoreMisiAsingAseanRequest $request)
    {
        MisiAsingAsean::create($request->validated());
        return redirect()->route('misi-asing-asean.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data misi asing untuk ASEAN berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(MisiAsingAsean $misiAsingAsean)
    {
        return view('mod_misi_asing_asean.edit', compact('misiAsingAsean'));
    }

    public function update(UpdateMisiAsingAseanRequest $request, MisiAsingAsean $misiAsingAsean)
    {
        $misiAsingAsean->update($request->validated());
        return redirect()->route('misi-asing-asean.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data misi asing untuk ASEAN berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(MisiAsingAsean $misiAsingAsean)
    {
        $misiAsingAsean->update(['is_active' => false]);
        $misiAsingAsean->mitra->update(['is_active' => false]);
        return redirect()->route('misi-asing-asean.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data misi asing untuk ASEAN berhasil dinonaktifkan.',
        ]);
    }
}
