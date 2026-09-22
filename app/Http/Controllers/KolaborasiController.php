<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Http\Requests\StoreKolaborasiRequest;
use App\Http\Requests\UpdateKolaborasiRequest;
use App\Models\Kolaborasi;
use App\Support\DaftarMitra;
use Illuminate\Http\Request;

class KolaborasiController extends Controller
{
    public function index(Request $request)
    {
        $kolaborasi = Kolaborasi::with(TipeMitra::relasiMitra())
            ->where('is_active', true)
            ->filterStatus($request->input('status'))
            ->filterTahun($request->input('tahun'))
            ->latest('tanggal_diterima')
            ->get();

        return view('mod_kolaborasi.index', [
            'kolaborasi' => $kolaborasi,
            'statusOptions' => Kolaborasi::STATUS_OPTIONS,
            'tahunOptions' => Kolaborasi::tahunTersedia(),
        ]);
    }

    public function show(Kolaborasi $kolaborasi)
    {
        $kolaborasi->load(TipeMitra::relasiMitra());

        return view('mod_kolaborasi.show', compact('kolaborasi'));
    }

    public function create()
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();

        return view('mod_kolaborasi.create', compact('daftarMitra'));
    }

    public function store(StoreKolaborasiRequest $request)
    {
        Kolaborasi::create($request->validated());

        return redirect()->route('kolaborasi.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kolaborasi berhasil disimpan.',
        ]);
    }

    public function edit(Kolaborasi $kolaborasi)
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();
        $kolaborasi->load(TipeMitra::relasiMitra());

        return view('mod_kolaborasi.edit', compact('kolaborasi', 'daftarMitra'));
    }

    public function update(UpdateKolaborasiRequest $request, Kolaborasi $kolaborasi)
    {
        $kolaborasi->update($request->validated());

        return redirect()->route('kolaborasi.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kolaborasi berhasil diubah.',
        ]);
    }

    public function destroy(Kolaborasi $kolaborasi)
    {
        $kolaborasi->update(['is_active' => false]);

        return redirect()->route('kolaborasi.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kolaborasi berhasil dinonaktifkan.',
        ]);
    }
}
