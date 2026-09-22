<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Http\Requests\StoreUndanganRequest;
use App\Http\Requests\UpdateUndanganRequest;
use App\Models\Undangan;
use App\Support\DaftarMitra;
use Illuminate\Http\Request;

class UndanganController extends Controller
{
    public function index(Request $request)
    {
        $undangan = Undangan::with(TipeMitra::relasiMitra())
            ->where('is_active', true)
            ->filterStatus($request->input('status'))
            ->filterTahun($request->input('tahun'))
            ->latest('tanggal_diterima')
            ->get();

        return view('mod_undangan.index', [
            'undangan' => $undangan,
            'statusOptions' => Undangan::STATUS_OPTIONS,
            'tahunOptions' => Undangan::tahunTersedia(),
        ]);
    }

    public function show(Undangan $undangan)
    {
        $undangan->load(TipeMitra::relasiMitra());

        return view('mod_undangan.show', compact('undangan'));
    }

    public function create()
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();

        return view('mod_undangan.create', compact('daftarMitra'));
    }

    public function store(StoreUndanganRequest $request)
    {
        Undangan::create($request->validated());

        return redirect()->route('undangan.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data undangan berhasil disimpan.',
        ]);
    }

    public function edit(Undangan $undangan)
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();
        $undangan->load(TipeMitra::relasiMitra());

        return view('mod_undangan.edit', compact('undangan', 'daftarMitra'));
    }

    public function update(UpdateUndanganRequest $request, Undangan $undangan)
    {
        $undangan->update($request->validated());

        return redirect()->route('undangan.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data undangan berhasil diubah.',
        ]);
    }

    public function destroy(Undangan $undangan)
    {
        $undangan->update(['is_active' => false]);

        return redirect()->route('undangan.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data undangan berhasil dinonaktifkan.',
        ]);
    }
}
