<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use App\Models\Kolaborasi;
use App\Models\Undangan;
use App\Models\Audiensi;
use App\Models\Kunjungan;
// use App\Models\AcaraDKI;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dash_akumulasi = [
            'kedutaan_besar' => KedutaanBesar::where('is_active', true)->count(),
            'kerjasama'      => Kerjasama::where('is_active', true)->count(),
            'kolaborasi'     => Kolaborasi::where('is_active', true)->count(),
            'undangan'     => Undangan::where('is_active', true)->count(),
            'audiensi'     => Audiensi::where('is_active', true)->count(),
            'kunjungan'     => Kunjungan::where('is_active', true)->count(),
            // 'acara_dki'     => AcaraDKI::where('is_active', true)->count(),
        ];

        $daftarKedutaan = KedutaanBesar::where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('nama_negara')
            ->get(['id_kedutaan_besar', 'kode_negara', 'nama_negara', 'latitude', 'longitude']);

        return view('mod_dashboard.index', compact(
            'dash_akumulasi',
            'daftarKedutaan',
        ));
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
