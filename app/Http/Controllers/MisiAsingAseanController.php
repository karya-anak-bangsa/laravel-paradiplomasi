<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreMisiAsingAseanRequest;
use App\Http\Requests\UpdateMisiAsingAseanRequest;
use App\Models\MisiAsingAsean;

class MisiAsingAseanController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $misiAsingAsean = MisiAsingAsean::where('is_active', true)->orderBy('nama_negara')->get();

        return view('mod_misi_asing_asean.index', compact('misiAsingAsean'));
    }

    public function show(MisiAsingAsean $misiAsingAsean)
    {
        $misiAsingAsean->load([
            'kerjasama' => fn ($query) => $query->latest('tanggal_diterima'),
            'kolaborasi' => fn ($query) => $query->latest('tanggal_diterima'),
            'undangan' => fn ($query) => $query->latest('tanggal_diterima'),
            'audiensi' => fn ($query) => $query->latest('tanggal_diterima'),
            'kunjungan' => fn ($query) => $query->latest('tanggal_diterima'),
            'acaraDki' => fn ($query) => $query->latest('tanggal_diterima'),
        ]);

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
            'type' => 'success',
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
            'type' => 'success',
            'message' => 'Data misi asing untuk ASEAN berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(MisiAsingAsean $misiAsingAsean)
    {
        $this->nonaktifkanMitra($misiAsingAsean);

        return redirect()->route('misi-asing-asean.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data misi asing untuk ASEAN berhasil dinonaktifkan.',
        ]);
    }
}
