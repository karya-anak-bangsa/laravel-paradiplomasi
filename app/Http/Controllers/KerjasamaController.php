<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreKerjasamaRequest;
use App\Http\Requests\UpdateKerjasamaRequest;
use App\Models\Kerjasama;
use App\Support\DaftarMitra;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    use MenonaktifkanData;

    public function index(Request $request)
    {
        $kerjasama = Kerjasama::daftarIndex($request->input('status'), $request->input('tahun'))->get();

        return view('mod_kerjasama.index', [
            'kerjasama' => $kerjasama,
            'statusOptions' => Kerjasama::STATUS_OPTIONS,
            'tahunOptions' => Kerjasama::tahunTersedia(),
        ]);
    }

    public function show(Kerjasama $kerjasama)
    {
        $kerjasama->load(TipeMitra::relasiMitra());

        return view('mod_kerjasama.show', compact('kerjasama'));
    }

    public function create()
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();

        return view('mod_kerjasama.create', compact('daftarMitra'));
    }

    public function store(StoreKerjasamaRequest $request)
    {
        Kerjasama::create($request->validated());

        return redirect()->route('kerjasama.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kerjasama berhasil disimpan.',
        ]);
    }

    public function edit(Kerjasama $kerjasama)
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();
        $kerjasama->load(TipeMitra::relasiMitra());

        return view('mod_kerjasama.edit', compact('kerjasama', 'daftarMitra'));
    }

    public function update(UpdateKerjasamaRequest $request, Kerjasama $kerjasama)
    {
        $kerjasama->update($request->validated());

        return redirect()->route('kerjasama.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kerjasama berhasil diubah.',
        ]);
    }

    public function destroy(Kerjasama $kerjasama)
    {
        $this->nonaktifkan($kerjasama);

        return redirect()->route('kerjasama.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kerjasama berhasil dinonaktifkan.',
        ]);
    }
}
