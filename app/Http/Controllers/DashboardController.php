<?php

namespace App\Http\Controllers;

use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use App\Models\Kolaborasi;
use App\Models\Undangan;
use App\Models\Audiensi;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //  Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta
        $dash_akumulasi = [
            'kedutaan_besar'    => KedutaanBesar::where('is_active', true)->count(),
            'kerjasama'         => Kerjasama::where('is_active', true)->count(),
            'kolaborasi'        => Kolaborasi::where('is_active', true)->count(),
            'undangan'          => Undangan::where('is_active', true)->count(),
            'audiensi'          => Audiensi::where('is_active', true)->count(),
            'kunjungan'         => Kunjungan::where('is_active', true)->count(),
        ];

        // Peta Sebaran & Pencarian Lokasi Kedutaan Besar
        $daftarKedutaan = KedutaanBesar::where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('nama_negara')
            ->get(['id_kedutaan_besar', 'kode_negara', 'nama_negara', 'nama_kedutaan_besar_id', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'latitude', 'longitude',]);

        $rincianWilayah = KedutaanBesar::query()
            ->select([
                'kota',
                'kecamatan',
                'kelurahan',
                DB::raw('COUNT(*) AS jumlah_kelurahan'),
                DB::raw('SUM(COUNT(*)) OVER (PARTITION BY kota, kecamatan) AS jumlah_kecamatan'),
                DB::raw('SUM(COUNT(*)) OVER (PARTITION BY kota) AS jumlah_kota'),
                DB::raw('COUNT(*) OVER (PARTITION BY kota, kecamatan) AS baris_kecamatan'),
                DB::raw('COUNT(*) OVER (PARTITION BY kota) AS baris_kota'),
            ])
            ->where('is_active', true)
            ->groupBy('kota', 'kecamatan', 'kelurahan')->orderByDesc('jumlah_kota')
            ->orderBy('kota')->orderByDesc('jumlah_kecamatan')
            ->orderBy('kecamatan')->orderByDesc('jumlah_kelurahan')
            ->orderBy('kelurahan')
            ->get();
        $totalPerKecamatan = $rincianWilayah->unique(fn($baris) => $baris->kota . '|' . $baris->kecamatan)->sum('jumlah_kecamatan');
        $totalPerKelurahan = $rincianWilayah->sum('jumlah_kelurahan');

        // Analisa Statistik Pelayanan Perwakilan Negara Asing (perbandingan status per modul)
        $statusList = ['Berjalan', 'Selesai', 'Tunda', 'Batal', 'Regret'];
        $jumlahPerModul = [
            'Kerjasama'  => Kerjasama::selectRaw('status_kerjasama as status, COUNT(*) as total')->groupBy('status_kerjasama')->pluck('total', 'status'),
            'Kolaborasi' => Kolaborasi::selectRaw('status_kolaborasi as status, COUNT(*) as total')->groupBy('status_kolaborasi')->pluck('total', 'status'),
            'Undangan'   => Undangan::selectRaw('status_undangan as status, COUNT(*) as total')->groupBy('status_undangan')->pluck('total', 'status'),
            'Audiensi'   => Audiensi::selectRaw('status_audiensi as status, COUNT(*) as total')->groupBy('status_audiensi')->pluck('total', 'status'),
            'Kunjungan'  => Kunjungan::selectRaw('status_kunjungan as status, COUNT(*) as total')->groupBy('status_kunjungan')->pluck('total', 'status'),
        ];
        $moduleLabels = array_keys($jumlahPerModul);
        $pieSeriesPerModul = collect($jumlahPerModul)
            ->map(fn($counts) => collect($statusList)->map(fn($status) => $counts[$status] ?? 0)->values())
            ->values();

        // Mitra Diplomatik Paling Aktif (berdasarkan total Riwayat Diplomasi)
        $mitraAktif = KedutaanBesar::where('is_active', true)
            ->withCount(['kerjasama', 'kolaborasi', 'undangan', 'audiensi', 'kunjungan'])
            ->get()
            ->map(function ($kedutaan) {
                $kedutaan->total_aktivitas = $kedutaan->kerjasama_count
                    + $kedutaan->kolaborasi_count
                    + $kedutaan->undangan_count
                    + $kedutaan->audiensi_count
                    + $kedutaan->kunjungan_count;
                return $kedutaan;
            })
            ->sortByDesc('total_aktivitas')
            ->take(20)
            ->values();


        return view('mod_dashboard.dashboard', compact(
            'dash_akumulasi',
            'daftarKedutaan',
            'rincianWilayah',
            'totalPerKecamatan',
            'totalPerKelurahan',
            'statusList',
            'moduleLabels',
            'pieSeriesPerModul',
            'mitraAktif',
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
