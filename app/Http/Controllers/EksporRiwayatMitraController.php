<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\MengunduhEkspor;
use App\Models\Mitra;
use App\Support\EksporRiwayatMitra;
use Illuminate\Http\Request;

/**
 * Ekspor seluruh Riwayat Diplomasi satu mitra (halaman profil mitra). Mitra
 * yang sudah dihapus (soft delete) otomatis 404 lewat route model binding,
 * sama seperti halaman profilnya. Query "tahun" = dropdown tahun di kartu
 * Riwayat Diplomasi; tahun yang tidak sah diabaikan (= semua tahun), sama
 * seperti halaman profilnya.
 */
class EksporRiwayatMitraController extends Controller
{
    use MengunduhEkspor;

    public function excel(Request $request, Mitra $mitra)
    {
        return $this->unduhExcelRiwayatMitra(new EksporRiwayatMitra($mitra, $request->query('tahun')));
    }

    public function pdf(Request $request, Mitra $mitra)
    {
        return $this->unduhPdfRiwayatMitra(new EksporRiwayatMitra($mitra, $request->query('tahun')));
    }
}
