<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Http\Requests\StoreKerjasamaRequest;
use App\Http\Requests\UpdateKerjasamaRequest;

class KerjasamaController extends Controller
{
    /**
     * Eager-load relasi mitra + ketiga subtype-nya, dipakai bareng oleh
     * index/show supaya accessor $mitra->nama_mitra / kode_mitra / nama_resmi_mitra tidak N+1.
     */
    private const MITRA_RELATIONS = [
        'mitra.kedutaanBesar',
        'mitra.misiAsingAsean',
        'mitra.misiPermanenAsean',
    ];

    public function index()
    {
        $kerjasama = Kerjasama::with(self::MITRA_RELATIONS)
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_kerjasama.index', compact('kerjasama'));
    }

    public function show(Kerjasama $kerjasama)
    {
        $kerjasama->load(self::MITRA_RELATIONS);
        return view('mod_kerjasama.show', compact('kerjasama'));
    }

    public function create()
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean] = $this->daftarMitraAktif();
        return view('mod_kerjasama.create', compact('kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean'));
    }

    public function store(StoreKerjasamaRequest $request)
    {
        Kerjasama::create($request->validated());
        return redirect()->route('kerjasama.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kerjasama berhasil disimpan.',
        ]);
    }

    public function edit(Kerjasama $kerjasama)
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean] = $this->daftarMitraAktif();
        $kerjasama->load(self::MITRA_RELATIONS);
        return view('mod_kerjasama.edit', compact('kerjasama', 'kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean'));
    }

    public function update(UpdateKerjasamaRequest $request, Kerjasama $kerjasama)
    {
        $kerjasama->update($request->validated());
        return redirect()->route('kerjasama.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kerjasama berhasil diubah.',
        ]);
    }

    public function destroy(Kerjasama $kerjasama)
    {
        $kerjasama->update(['is_active' => false]);
        return redirect()->route('kerjasama.index')->with('notify', [
            'type'    => 'success',
            'message' => 'Data kerjasama berhasil dinonaktifkan.',
        ]);
    }

    /**
     * Daftar mitra aktif per tipe, untuk dropdown tipe->detail di form.
     * Masing-masing sudah include `id_mitra` (bukan PK subtype-nya)
     * sebagai value yang akan disimpan di tb_kerjasama.id_mitra, plus
     * kolom nama resmi ID masing-masing untuk label opsi dropdown.
     */
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
