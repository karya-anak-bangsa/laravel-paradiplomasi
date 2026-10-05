<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreMisiPermanenAseanRequest;
use App\Http\Requests\UpdateMisiPermanenAseanRequest;
use App\Models\MisiPermanenAsean;
use Illuminate\Http\Request;

class MisiPermanenAseanController extends Controller
{
    use MenonaktifkanData;

    public function index()
    {
        $misiPermanenAsean = MisiPermanenAsean::daftarIndex()->get();

        return view('mod_misi_permanen_asean.index', compact('misiPermanenAsean'));
    }

    public function show(Request $request, MisiPermanenAsean $misiPermanenAsean)
    {
        $misiPermanenAsean->muatRiwayatDiplomasi($request->query('tahun'));

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
            'type' => 'success',
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
            'type' => 'success',
            'message' => 'Data misi permanen negara ASEAN berhasil diubah.',
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------------------

    public function destroy(MisiPermanenAsean $misiPermanenAsean)
    {
        $this->nonaktifkanMitra($misiPermanenAsean);

        return redirect()->route('misi-permanen-asean.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data misi permanen negara ASEAN berhasil dinonaktifkan.',
        ]);
    }
}
