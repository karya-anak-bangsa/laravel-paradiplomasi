<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use Illuminate\Http\Request;

class KedutaanBesarController extends Controller
{
    public function index()
    {
        $kedutaanBesar = KedutaanBesar::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_kedutaan_besar.index', compact('kedutaanBesar'));
    }

    public function show(KedutaanBesar $kedutaanBesar)
    {
        $kedutaanBesar->load([
            'kerjasama'     => fn($query) => $query->latest('tanggal_diterima'),
            'kolaborasi'    => fn($query) => $query->latest('tanggal_diterima'),
            'undangan'      => fn($query) => $query->latest('tanggal_diterima'),
        ]);

        return view('mod_kedutaan_besar.show', compact('kedutaanBesar'));
    }

    // --------------------------------------------------------------------------------------------------
    // BELUM 
    // --------------------------------------------------------------------------------------------------

    public function create()
    {
        //
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
