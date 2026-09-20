<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKerjasamaRequest;
use App\Http\Requests\UpdateKerjasamaRequest;
use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Models\NonPerwakilanNegaraAsing;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    /**
     * Eager-load relasi mitra + keempat subtype-nya, dipakai bareng oleh
     * index/show supaya accessor $mitra->nama_mitra / kode_mitra / nama_resmi_mitra tidak N+1.
     */
    private const MITRA_RELATIONS = [
        'mitra.kedutaanBesar',
        'mitra.misiAsingAsean',
        'mitra.misiPermanenAsean',
        'mitra.nonPerwakilanNegaraAsing',
    ];

    public function index(Request $request)
    {
        $kerjasama = Kerjasama::with(self::MITRA_RELATIONS)
            ->where('is_active', true)
            ->filterStatus($request->input('status'))
            ->filterTahun($request->input('tahun'))
            ->latest('tanggal_diterima')
            ->get();

        return view('mod_kerjasama.index', [
            'kerjasama' => $kerjasama,
            'statusOptions' => Kerjasama::STATUS_OPTIONS,
            'tahunOptions' => Kerjasama::tahunTersedia(),
        ]);
    }

    public function show(Kerjasama $kerjasama)
    {
        $kerjasama->load(self::MITRA_RELATIONS);

        return view('mod_kerjasama.show', compact('kerjasama'));
    }

    public function create()
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing] = $this->daftarMitraAktif();

        return view('mod_kerjasama.create', compact('kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean', 'nonPerwakilanNegaraAsing'));
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
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing] = $this->daftarMitraAktif();
        $kerjasama->load(self::MITRA_RELATIONS);

        return view('mod_kerjasama.edit', compact('kerjasama', 'kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean', 'nonPerwakilanNegaraAsing'));
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
        $kerjasama->update(['is_active' => false]);

        return redirect()->route('kerjasama.index')->with('notify', [
            'type' => 'success',
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

        $nonPerwakilanNegaraAsing = NonPerwakilanNegaraAsing::where('is_active', true)
            ->orderBy('nama_non_perwakilan_negara_asing')
            ->get(['id_mitra', 'nama_non_perwakilan_negara_asing']);

        return [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing];
    }
}
