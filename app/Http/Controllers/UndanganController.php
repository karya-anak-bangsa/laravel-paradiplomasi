<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Undangan;
use Illuminate\Http\Request;

class UndanganController extends Controller
{
    public function index()
    {
        $undangan = Undangan::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_undangan.index', compact('undangan'));
    }

    public function show(Undangan $undangan)
    {
        $undangan->load('kedutaanBesar');
        return view('mod_undangan.show', compact('undangan'));
    }

    public function create()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_undangan.create', compact('kedutaanBesar')); // sesuaikan nama view per modul
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
