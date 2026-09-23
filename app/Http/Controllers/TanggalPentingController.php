<?php

namespace App\Http\Controllers;

use App\Models\AcaraDKI;

class TanggalPentingController extends Controller
{
    /**
     * Kalender read-only: satu-satunya aksi modul ini. Tanggal Penting tidak
     * punya tabel sendiri, isinya diturunkan dari rentang pelaksanaan Acara DKI
     * yang masih aktif — karena itu route-nya pun cuma `index`.
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
}
