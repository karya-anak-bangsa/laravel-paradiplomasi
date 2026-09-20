<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKolaborasiRequest;
use App\Http\Requests\UpdateKolaborasiRequest;
use App\Models\KedutaanBesar;
use App\Models\Kolaborasi;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Models\NonPerwakilanNegaraAsing;

class KolaborasiController extends Controller
{
    private const MITRA_RELATIONS = [
        'mitra.kedutaanBesar',
        'mitra.misiAsingAsean',
        'mitra.misiPermanenAsean',
        'mitra.nonPerwakilanNegaraAsing',
    ];

    public function index()
    {
        $kolaborasi = Kolaborasi::with(self::MITRA_RELATIONS)
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();

        return view('mod_kolaborasi.index', compact('kolaborasi'));
    }

    public function show(Kolaborasi $kolaborasi)
    {
        $kolaborasi->load(self::MITRA_RELATIONS);

        return view('mod_kolaborasi.show', compact('kolaborasi'));
    }

    public function create()
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing] = $this->daftarMitraAktif();

        return view('mod_kolaborasi.create', compact('kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean', 'nonPerwakilanNegaraAsing'));
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
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing] = $this->daftarMitraAktif();
        $kolaborasi->load(self::MITRA_RELATIONS);

        return view('mod_kolaborasi.edit', compact('kolaborasi', 'kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean', 'nonPerwakilanNegaraAsing'));
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

        $nonPerwakilanNegaraAsing = NonPerwakilanNegaraAsing::where('is_active', true)
            ->orderBy('nama_non_perwakilan_negara_asing')
            ->get(['id_mitra', 'nama_non_perwakilan_negara_asing']);

        return [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing];
    }
}
