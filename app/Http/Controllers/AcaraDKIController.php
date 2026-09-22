<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcaraDKIRequest;
use App\Http\Requests\UpdateAcaraDKIRequest;
use App\Models\AcaraDKI;
use App\Models\KedutaanBesar;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Models\NonPerwakilanNegaraAsing;
use Illuminate\Http\Request;

class AcaraDKIController extends Controller
{
    private const MITRA_RELATIONS = [
        'mitra.kedutaanBesar',
        'mitra.misiAsingAsean',
        'mitra.misiPermanenAsean',
        'mitra.nonPerwakilanNegaraAsing',
    ];

    public function index(Request $request)
    {
        $acaraDki = AcaraDKI::with(self::MITRA_RELATIONS)
            ->where('is_active', true)
            ->filterStatus($request->input('status'))
            ->filterTahun($request->input('tahun'))
            ->latest('tanggal_diterima')
            ->get();

        return view('mod_acara_dki.index', [
            'acaraDki' => $acaraDki,
            'statusOptions' => AcaraDKI::STATUS_OPTIONS,
            'tahunOptions' => AcaraDKI::tahunTersedia(),
        ]);
    }

    public function show(AcaraDKI $acaraDki)
    {
        $acaraDki->load(self::MITRA_RELATIONS);

        return view('mod_acara_dki.show', compact('acaraDki'));
    }

    public function create()
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing] = $this->daftarMitraAktif();

        return view('mod_acara_dki.create', compact('kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean', 'nonPerwakilanNegaraAsing'));
    }

    public function store(StoreAcaraDKIRequest $request)
    {
        $data = $request->validated();

        $acaraDki = AcaraDKI::create(collect($data)->except('mitra')->all());
        $acaraDki->mitra()->attach($this->pivotMitra($data['mitra']));

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil disimpan.',
        ]);
    }

    public function edit(AcaraDKI $acaraDki)
    {
        [$kedutaanBesar, $misiAsingAsean, $misiPermanenAsean, $nonPerwakilanNegaraAsing] = $this->daftarMitraAktif();
        $acaraDki->load(self::MITRA_RELATIONS);

        return view('mod_acara_dki.edit', compact('acaraDki', 'kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean', 'nonPerwakilanNegaraAsing'));
    }

    public function update(UpdateAcaraDKIRequest $request, AcaraDKI $acaraDki)
    {
        $data = $request->validated();

        $acaraDki->update(collect($data)->except('mitra')->all());
        $acaraDki->mitra()->sync($this->pivotMitra($data['mitra']));

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil diubah.',
        ]);
    }

    public function destroy(AcaraDKI $acaraDki)
    {
        $acaraDki->update(['is_active' => false]);

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil dinonaktifkan.',
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

    private function pivotMitra(array $mitra): array
    {
        return collect($mitra)->mapWithKeys(fn (array $row) => [
            $row['id_mitra'] => [
                'status_kehadiran' => $row['status_kehadiran'],
                'keterangan_kehadiran' => $row['keterangan_kehadiran'] ?? null,
            ],
        ])->all();
    }
}
