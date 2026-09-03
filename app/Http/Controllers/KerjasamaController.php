<?php

namespace App\Http\Controllers;

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

    public function edit(string $id)
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
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
