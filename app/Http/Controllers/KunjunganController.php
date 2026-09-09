<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = Kunjungan::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_kunjungan.index', compact('kunjungan'));
    }

    public function show(Kunjungan $kunjungan)
    {
        $kunjungan->load('kedutaanBesar');
        return view('mod_kunjungan.show', compact('kunjungan'));
    }

    public function create()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_kunjungan.create', compact('kedutaanBesar'));
    }


    public function store(Request $request)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
