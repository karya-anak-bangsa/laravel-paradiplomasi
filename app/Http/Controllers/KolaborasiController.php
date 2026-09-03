<?php

namespace App\Http\Controllers;

use App\Models\Kolaborasi;
use Illuminate\Http\Request;

class KolaborasiController extends Controller
{
    public function index()
    {
        $kolaborasi = Kolaborasi::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_kolaborasi.index', compact('kolaborasi'));
    }

    public function show(Kolaborasi $kolaborasi)
    {
        $kolaborasi->load('kedutaanBesar');
        return view('mod_kolaborasi.show', compact('kolaborasi'));
    }

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
