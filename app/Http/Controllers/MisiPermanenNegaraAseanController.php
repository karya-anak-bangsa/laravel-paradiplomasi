<?php

namespace App\Http\Controllers;

use App\Models\MisiPermanenNegaraAsean;
use Illuminate\Http\Request;

class MisiPermanenNegaraAseanController extends Controller
{
    public function index()
    {
        $misiPermanenAsean = MisiPermanenNegaraAsean::where('is_active', true)->orderBy('nama_negara')->get();
        return view('mod_misi_permanen_asean.index', compact('misiPermanenAsean'));
    }

    public function show(MisiPermanenNegaraAsean $misiPermanenAsean)
    {
        return view('mod_misi_permanen_asean.show', compact('misiPermanenAsean'));
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
