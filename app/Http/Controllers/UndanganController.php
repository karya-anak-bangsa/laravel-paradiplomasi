<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUndanganRequest;
use App\Http\Requests\UpdateUndanganRequest;
use App\Models\KedutaanBesar;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Models\NonPerwakilanNegaraAsing;
use App\Models\Undangan;

class UndanganController extends Controller
{
    private const MITRA_RELATIONS = [
        'mitra.kedutaanBesar',
        'mitra.misiAsingAsean',
        'mitra.misiPermanenAsean',
        'mitra.nonPerwakilanNegaraAsing',
    ];

    public function index()
    {
        $undangan = Undangan::with(self::MITRA_RELATIONS)
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();

        return view('mod_undangan.index', compact('undangan'));
    }

    public function show(Undangan $undangan)
    {
        $undangan->load(self::MITRA_RELATIONS);

        return view('mod_undangan.show', compact('undangan'));
    }

    public function create()
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing] = $this->daftarMitraAktif();

        return view('mod_undangan.create', compact('kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean', 'nonPerwakilanNegaraAsing'));
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
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing] = $this->daftarMitraAktif();
        $undangan->load(self::MITRA_RELATIONS);

        return view('mod_undangan.edit', compact('undangan', 'kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean', 'nonPerwakilanNegaraAsing'));
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
