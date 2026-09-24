<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreKunjunganRequest;
use App\Http\Requests\UpdateKunjunganRequest;
use App\Models\Kunjungan;
use App\Support\DaftarMitra;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    use MenonaktifkanData;

    public function index(Request $request)
    {
        $kunjungan = Kunjungan::daftarIndex($request->input('status'), $request->input('tahun'))->get();

        return view('mod_kunjungan.index', [
            'kunjungan' => $kunjungan,
            'statusOptions' => Kunjungan::STATUS_OPTIONS,
            'tahunOptions' => Kunjungan::tahunTersedia(),
        ]);
    }

    public function show(Kunjungan $kunjungan)
    {
        $kunjungan->load(TipeMitra::relasiMitra());

        return view('mod_kunjungan.show', compact('kunjungan'));
    }

    public function create()
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();

        return view('mod_kunjungan.create', compact('daftarMitra'));
    }

    public function store(StoreKunjunganRequest $request)
    {
        Kunjungan::create($request->validated());

        return redirect()->route('kunjungan.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kunjungan berhasil disimpan.',
        ]);
    }

    public function edit(Kunjungan $kunjungan)
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();
        $kunjungan->load(TipeMitra::relasiMitra());

        return view('mod_kunjungan.edit', compact('kunjungan', 'daftarMitra'));
    }

    public function update(UpdateKunjunganRequest $request, Kunjungan $kunjungan)
    {
        $kunjungan->update($request->validated());

        return redirect()->route('kunjungan.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kunjungan berhasil diubah.',
        ]);
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $this->nonaktifkan($kunjungan);

        return redirect()->route('kunjungan.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data kunjungan berhasil dinonaktifkan.',
        ]);
    }
}
