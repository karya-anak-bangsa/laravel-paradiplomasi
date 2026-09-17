<?php

namespace App\Http\Controllers;

use App\Models\MisiPermanenAsean;
use App\Http\Requests\StoreMisiPermanenAseanRequest;
use App\Http\Requests\UpdateMisiPermanenAseanRequest;

class MisiPermanenAseanController extends Controller
{
    public function index()
    {
        $misiPermanenAsean = MisiPermanenAsean::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_misi_permanen_asean.index', compact('misiPermanenAsean'));
    }

    public function show(MisiPermanenAsean $misiPermanenAsean)
    {
        return view('mod_misi_permanen_asean.show', compact('misiPermanenAsean'));
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function create()
    {
        return view('mod_misi_permanen_asean.create');
    }

    public function store(StoreMisiPermanenAseanRequest $request)
    {
        MisiPermanenAsean::create($request->validated());
        return redirect()->route('misi-permanen-asean.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data misi permanen negara ASEAN berhasil disimpan.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function edit(MisiPermanenAsean $misiPermanenAsean)
    {
        return view('mod_misi_permanen_asean.edit', compact('misiPermanenAsean'));
    }

    public function update(UpdateMisiPermanenAseanRequest $request, MisiPermanenAsean $misiPermanenAsean)
    {
        $misiPermanenAsean->update($request->validated());
        return redirect()->route('misi-permanen-asean.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data misi permanen negara ASEAN berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(MisiPermanenAsean $misiPermanenAsean)
    {
        $misiPermanenAsean->update(['is_active' => false]);
        $misiPermanenAsean->mitra->update(['is_active' => false]);
        return redirect()->route('misi-permanen-asean.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data misi permanen negara ASEAN berhasil dinonaktifkan.',
        ]);
    }
}
