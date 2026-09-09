<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Audiensi;
use Illuminate\Http\Request;

class AudiensiController extends Controller
{
    public function index()
    {
        $audiensi = Audiensi::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_audiensi.index', compact('audiensi'));
    }

    public function show(Audiensi $audiensi)
    {
        $audiensi->load('kedutaanBesar');
        return view('mod_audiensi.show', compact('audiensi'));
    }

    public function create()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_audiensi.create', compact('kedutaanBesar'));
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
