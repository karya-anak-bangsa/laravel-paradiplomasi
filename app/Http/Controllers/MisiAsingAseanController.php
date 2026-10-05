<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreMisiAsingAseanRequest;
use App\Http\Requests\UpdateMisiAsingAseanRequest;
use App\Models\MisiAsingAsean;
use Illuminate\Http\Request;

class MisiAsingAseanController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $misiAsingAsean = MisiAsingAsean::daftarIndex()->get();

        return view('mod_misi_asing_asean.index', compact('misiAsingAsean'));
    }

    public function show(Request $request, MisiAsingAsean $misiAsingAsean)
    {
        $misiAsingAsean->muatRiwayatDiplomasi($request->query('tahun'));

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
