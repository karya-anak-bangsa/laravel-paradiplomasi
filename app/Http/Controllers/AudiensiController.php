<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Audiensi;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Http\Requests\StoreAudiensiRequest;
use App\Http\Requests\UpdateAudiensiRequest;

class AudiensiController extends Controller
{
    private const MITRA_RELATIONS = [
        'mitra.kedutaanBesar',
        'mitra.misiAsingAsean',
        'mitra.misiPermanenAsean',
    ];

    public function index()
    {
        $audiensi = Audiensi::with(self::MITRA_RELATIONS)
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_audiensi.index', compact('audiensi'));
    }

    public function show(Audiensi $audiensi)
    {
        $audiensi->load(self::MITRA_RELATIONS);
        return view('mod_audiensi.show', compact('audiensi'));
    }

    public function create()
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean] = $this->daftarMitraAktif();
        return view('mod_audiensi.create', compact('kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean'));
    }

    public function store(StoreAudiensiRequest $request)
    {
        Audiensi::create($request->validated());
        return redirect()->route('audiensi.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data audiensi berhasil disimpan.',
        ]);
    }

    public function edit(Audiensi $audiensi)
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean] = $this->daftarMitraAktif();
        $audiensi->load(self::MITRA_RELATIONS);
        return view('mod_audiensi.edit', compact('audiensi', 'kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean'));
    }

    public function update(UpdateAudiensiRequest $request, Audiensi $audiensi)
    {
        $audiensi->update($request->validated());
        return redirect()->route('audiensi.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data audiensi berhasil diubah.',
        ]);
    }

    public function destroy(Audiensi $audiensi)
    {
        $audiensi->update(['is_active' => false]);
        return redirect()->route('audiensi.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data audiensi berhasil dinonaktifkan.',
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
