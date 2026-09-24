<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreAcaraDKIRequest;
use App\Http\Requests\UpdateAcaraDKIRequest;
use App\Models\AcaraDKI;
use App\Support\DaftarMitra;
use Illuminate\Http\Request;

class AcaraDKIController extends Controller
{
    use MenonaktifkanData;

    public function index(Request $request)
    {
        $acaraDki = AcaraDKI::daftarIndex($request->input('status'), $request->input('tahun'))->get();

        return view('mod_acara_dki.index', [
            'acaraDki' => $acaraDki,
            'statusOptions' => AcaraDKI::STATUS_OPTIONS,
            'tahunOptions' => AcaraDKI::tahunTersedia(),
        ]);
    }

    public function show(AcaraDKI $acaraDki)
    {
        $acaraDki->load(TipeMitra::relasiMitra());

        return view('mod_acara_dki.show', compact('acaraDki'));
    }

    public function create()
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();

        return view('mod_acara_dki.create', compact('daftarMitra'));
    }

    public function store(StoreAcaraDKIRequest $request)
    {
        $data = $request->validated();

        $acaraDki = AcaraDKI::create(collect($data)->except('mitra')->all());
        $acaraDki->mitra()->attach($this->pivotMitra($data['mitra'] ?? []));

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil disimpan.',
        ]);
    }

    public function edit(AcaraDKI $acaraDki)
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();
        $acaraDki->load(TipeMitra::relasiMitra());

        return view('mod_acara_dki.edit', compact('acaraDki', 'daftarMitra'));
    }

    public function update(UpdateAcaraDKIRequest $request, AcaraDKI $acaraDki)
    {
        $data = $request->validated();

        $acaraDki->update(collect($data)->except('mitra')->all());
        $acaraDki->mitra()->sync($this->pivotMitra($data['mitra'] ?? []));

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil diubah.',
        ]);
    }

    public function destroy(AcaraDKI $acaraDki)
    {
        $this->nonaktifkan($acaraDki);

        return redirect()->route('acara-dki.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data acara DKI berhasil dinonaktifkan.',
        ]);
    }

    /**
     * Ubah input form `mitra[]` (satu baris per mitra) menjadi payload
     * attach/sync tb_acara_dki_mitra: [id_mitra => atribut pivot].
     *
     * @param  array<int, array<string, mixed>>  $mitra
     * @return array<int, array<string, mixed>>
     */
    private function pivotMitra(array $mitra): array
    {
        return collect($mitra)
            ->mapWithKeys(fn (array $baris) => [
                (int) $baris['id_mitra'] => [
                    'status_kehadiran' => $baris['status_kehadiran'],
                    'keterangan_kehadiran' => $baris['keterangan_kehadiran'] ?? null,
                ],
            ])
            ->all();
    }
}
