<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcaraDKIRequest;
use App\Http\Requests\UpdateAcaraDKIRequest;
use App\Models\AcaraDKI;
use Illuminate\Http\Request;

class AcaraDKIController extends Controller
{
    public function index(Request $request)
    {
        $acaraDki = AcaraDKI::where('is_active', true)
            ->filterStatus($request->input('status'))
            ->filterTahun($request->input('tahun'))
            ->latest('tanggal_diterima')
            ->get();

        return view('mod_acara_dki.index', [
            'acaraDki' => $acaraDki,
            'statusOptions' => AcaraDKI::STATUS_OPTIONS,
            'tahunOptions' => AcaraDKI::tahunTersedia(),
        ]);
    }

    public function show(AcaraDKI $acaraDki)
    {
        return view('mod_acara_dki.show', compact('acaraDki'));
    }

    public function create()
    {
        return view('mod_acara_dki.create');
    }

    public function store(StoreAcaraDKIRequest $request)
    {
        AcaraDKI::create($request->validated());

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil disimpan.',
        ]);
    }

    public function edit(AcaraDKI $acaraDki)
    {
        return view('mod_acara_dki.edit', compact('acaraDki'));
    }

    public function update(UpdateAcaraDKIRequest $request, AcaraDKI $acaraDki)
    {
        $acaraDki->update($request->validated());

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil diubah.',
        ]);
    }

    public function destroy(AcaraDKI $acaraDki)
    {
        $acaraDki->update(['is_active' => false]);

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil dinonaktifkan.',
        ]);
    }
}
