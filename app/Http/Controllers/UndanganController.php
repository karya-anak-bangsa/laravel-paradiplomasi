<?php

namespace App\Http\Controllers;

use App\Models\Undangan;
use Illuminate\Http\Request;

class UndanganController extends Controller
{
    public function index()
    {
        $kolaborasi = Undangan::with('kedutaanBesar')
            ->where('is_active', true)
            ->latest('tanggal_diterima')
            ->get();
        return view('mod_undangan.index', compact('kolaborasi'));
    }

    public function show(string $id)
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
