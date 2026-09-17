<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Kunjungan;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Http\Requests\StoreKunjunganRequest;
use App\Http\Requests\UpdateKunjunganRequest;

class KunjunganController extends Controller
{
    private const MITRA_RELATIONS = [
        'mitra.kedutaanBesar',
        'mitra.misiAsingAsean',
        'mitra.misiPermanenAsean',
    ];

    public function index()
    {
        $kunjungan = Kunjungan::with(self::MITRA_RELATIONS)
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_kunjungan.index', compact('kunjungan'));
    }

    public function show(Kunjungan $kunjungan)
    {
        $kunjungan->load(self::MITRA_RELATIONS);
        return view('mod_kunjungan.show', compact('kunjungan'));
    }

    public function create()
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean] = $this->daftarMitraAktif();
        return view('mod_kunjungan.create', compact('kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean'));
    }

    public function store(StoreKunjunganRequest $request)
    {
        Kunjungan::create($request->validated());
        return redirect()->route('kunjungan.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kunjungan berhasil disimpan.',
        ]);
    }

    public function edit(Kunjungan $kunjungan)
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean] = $this->daftarMitraAktif();
        $kunjungan->load(self::MITRA_RELATIONS);
        return view('mod_kunjungan.edit', compact('kunjungan', 'kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean'));
    }

    public function update(UpdateKunjunganRequest $request, Kunjungan $kunjungan)
    {
        $kunjungan->update($request->validated());
        return redirect()->route('kunjungan.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kunjungan berhasil diubah.',
        ]);
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->update(['is_active' => false]);
        return redirect()->route('kunjungan.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kunjungan berhasil dinonaktifkan.',
        ]);
    }

    private function daftarMitraAktif(): array
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)
            ->orderBy('nama_negara')
            ->get(['id_mitra', 'kode_negara', 'nama_negara', 'nama_kedutaan_besar_id']);

        $misiAsingAsean = MisiAsingAsean::where('is_active', true)
            ->orderBy('nama_negara')
            ->get(['id_mitra', 'kode_negara', 'nama_negara', 'nama_misi_asing_asean_id']);

        $misiPermanenAsean = MisiPermanenAsean::where('is_active', true)
            ->orderBy('nama_negara')
            ->get(['id_mitra', 'kode_negara', 'nama_negara', 'nama_misi_permanen_asean_id']);

        return [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean];
    }
}
