<?php

namespace App\Http\Controllers;

use App\Models\MisiAsingAsean;
use Illuminate\Http\Request;

class MisiAsingAseanController extends Controller
{
    public function index()
    {
        $misiAsingAsean = MisiAsingAsean::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_misi_asing_asean.index', compact('misiAsingAsean'));
    }

    public function show(MisiAsingAsean $misiAsingAsean)
    {
        return view('mod_misi_asing_asean.show', compact('misiAsingAsean'));
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
