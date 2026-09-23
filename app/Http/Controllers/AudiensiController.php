<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Http\Controllers\Concerns\MenonaktifkanData;
use App\Http\Requests\StoreAudiensiRequest;
use App\Http\Requests\UpdateAudiensiRequest;
use App\Models\Audiensi;
use App\Support\DaftarMitra;
use Illuminate\Http\Request;

class AudiensiController extends Controller
{
    use MenonaktifkanData;

    public function index(Request $request)
    {
        $audiensi = Audiensi::with(TipeMitra::relasiMitra())
            ->where('is_active', true)
            ->filterStatus($request->input('status'))
            ->filterTahun($request->input('tahun'))
            ->latest('tanggal_diterima')
            ->get();

        return view('mod_audiensi.index', [
            'audiensi' => $audiensi,
            'statusOptions' => Audiensi::STATUS_OPTIONS,
            'tahunOptions' => Audiensi::tahunTersedia(),
        ]);
    }

    public function show(Audiensi $audiensi)
    {
        $audiensi->load(TipeMitra::relasiMitra());

        return view('mod_audiensi.show', compact('audiensi'));
    }

    public function create()
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();

        return view('mod_audiensi.create', compact('daftarMitra'));
    }

    public function store(StoreAudiensiRequest $request)
    {
        Audiensi::create($request->validated());

        return redirect()->route('audiensi.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data audiensi berhasil disimpan.',
        ]);
    }

    public function edit(Audiensi $audiensi)
    {
        $daftarMitra = DaftarMitra::aktifPerTipe();
        $audiensi->load(TipeMitra::relasiMitra());

        return view('mod_audiensi.edit', compact('audiensi', 'daftarMitra'));
    }

    public function update(UpdateAudiensiRequest $request, Audiensi $audiensi)
    {
        $audiensi->update($request->validated());

        return redirect()->route('audiensi.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data audiensi berhasil diubah.',
        ]);
    }

    public function destroy(Audiensi $audiensi)
    {
        $this->nonaktifkan($audiensi);

        return redirect()->route('audiensi.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data audiensi berhasil dinonaktifkan.',
        ]);
    }
}
