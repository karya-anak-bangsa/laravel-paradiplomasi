<?php

namespace App\Http\Controllers;

use App\Models\AcaraDKI;
use Illuminate\Http\Request;

class TanggalPentingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acaraDkiEvents = AcaraDKI::where('is_active', true)
            ->whereNotNull('tanggal_awal_pelaksanaan')
            ->whereNotNull('tanggal_akhir_pelaksanaan')
            ->orderBy('tanggal_awal_pelaksanaan')
            ->get()
            ->map(fn (AcaraDKI $acaraDki) => [
                'title' => $acaraDki->judul_ringkas,
                'start' => $acaraDki->tanggal_awal_pelaksanaan->toDateString(),
                'end' => $acaraDki->tanggal_akhir_pelaksanaan->toDateString(),
            ]);

        return view('mod_tanggal_penting.index', compact('acaraDkiEvents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
