<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    public function index()
    {
        $kerjasama = Kerjasama::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_kerjasama.index', compact('kerjasama'));
    }

    public function show(Kerjasama $kerjasama)
    {
        $kerjasama->load('kedutaanBesar');
        return view('mod_kerjasama.show', compact('kerjasama'));
    }

    public function create()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_kerjasama.create', compact('kedutaanBesar'));
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Kerjasama $kerjasama)
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        $kerjasama->load('kedutaanBesar');
        return view('mod_kerjasama.edit', compact('kerjasama', 'kedutaanBesar'));
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
