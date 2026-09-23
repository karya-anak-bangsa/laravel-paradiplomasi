<?php

namespace App\Http\Controllers;

use App\Enums\TipeMitra;
use App\Models\AcaraDKI;
use App\Models\Audiensi;
use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use App\Models\Kolaborasi;
use App\Models\Kunjungan;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Models\Undangan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta — kelompok
        // Mitra diturunkan dari TipeMitra, sehingga jenis mitra baru otomatis
        // muncul di dashboard tanpa menyentuh controller maupun blade-nya.
        $akumulasiMitra = collect(TipeMitra::cases())->map(fn (TipeMitra $tipe) => (object) [
            'label' => $tipe->labelSingkat(),
            'ikon' => $tipe->ikon(),
            'warna' => $tipe->warna(),
            'route' => $tipe->routeIndex(),
            'jumlah' => $tipe->modelClass()::where('is_active', true)->count(),
        ]);

        // Kelompok Riwayat Diplomasi masih ditulis eksplisit karena butuh satu
        // metadata yang tidak ada di App\Enums\ModulDiplomasi, yaitu warna irisan
        // donat (`warnaChart`) — hanya dipakai di dashboard. Label, ikon, warna
        // kartu, dan route-nya sudah ada di enum tersebut dan nilainya disamakan;
        // kalau kelak warnaChart dipindah ke enum, blok ini bisa diturunkan dari
        // ModulDiplomasi::cases() seperti $akumulasiMitra di atas.
        $akumulasiRiwayat = collect([
            ['label' => 'Kerjasama', 'ikon' => 'folder-closed', 'warna' => 'green', 'route' => 'kerjasama.index', 'warnaChart' => 'primary', 'model' => Kerjasama::class],
            ['label' => 'Kolaborasi', 'ikon' => 'thumbs-up', 'warna' => 'yellow', 'route' => 'kolaborasi.index', 'warnaChart' => 'yellow', 'model' => Kolaborasi::class],
            ['label' => 'Undangan', 'ikon' => 'envelope', 'warna' => 'red', 'route' => 'undangan.index', 'warnaChart' => 'red', 'model' => Undangan::class],
            ['label' => 'Audiensi', 'ikon' => 'comments', 'warna' => 'azure', 'route' => 'audiensi.index', 'warnaChart' => 'azure', 'model' => Audiensi::class],
            ['label' => 'Kunjungan', 'ikon' => 'user-graduate', 'warna' => 'lime', 'route' => 'kunjungan.index', 'warnaChart' => 'green', 'model' => Kunjungan::class],
            ['label' => 'Acara DKI', 'ikon' => 'calendar-days', 'warna' => 'orange', 'route' => 'acara-dki.index', 'warnaChart' => 'orange', 'model' => AcaraDKI::class],
        ])->map(fn (array $modul) => (object) [
            ...$modul,
            'jumlah' => $modul['model']::where('is_active', true)->count(),
        ]);

        // Peta Sebaran & Pencarian Lokasi Kedutaan Besar
        $daftarKedutaan = KedutaanBesar::where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('nama_negara')
            ->get(['id_kedutaan_besar', 'kode_negara', 'nama_negara', 'nama_kedutaan_besar_id', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'latitude', 'longitude']);

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
        $totalPerKecamatan = $rincianWilayah->unique(fn ($baris) => $baris->kota.'|'.$baris->kecamatan)->sum('jumlah_kecamatan');
        $totalPerKelurahan = $rincianWilayah->sum('jumlah_kelurahan');

        // Analisa Statistik Pelayanan Perwakilan Negara Asing (perbandingan status per modul)
        $statusList = ['Berjalan', 'Selesai', 'Tunda', 'Batal', 'Regret'];
        $jumlahPerModul = [
            'Kerjasama' => Kerjasama::selectRaw('status_kerjasama as status, COUNT(*) as total')->groupBy('status_kerjasama')->pluck('total', 'status'),
            'Kolaborasi' => Kolaborasi::selectRaw('status_kolaborasi as status, COUNT(*) as total')->groupBy('status_kolaborasi')->pluck('total', 'status'),
            'Undangan' => Undangan::selectRaw('status_undangan as status, COUNT(*) as total')->groupBy('status_undangan')->pluck('total', 'status'),
            'Audiensi' => Audiensi::selectRaw('status_audiensi as status, COUNT(*) as total')->groupBy('status_audiensi')->pluck('total', 'status'),
            'Kunjungan' => Kunjungan::selectRaw('status_kunjungan as status, COUNT(*) as total')->groupBy('status_kunjungan')->pluck('total', 'status'),
            'Acara DKI' => AcaraDKI::selectRaw('status_acara_dki as status, COUNT(*) as total')->groupBy('status_acara_dki')->pluck('total', 'status'),
        ];
        $moduleLabels = array_keys($jumlahPerModul);
        $pieSeriesPerModul = collect($jumlahPerModul)
            ->map(fn ($counts) => collect($statusList)->map(fn ($status) => $counts[$status] ?? 0)->values())
            ->values();

        // Mitra Diplomatik Paling Aktif (berdasarkan total Riwayat Diplomasi).
        //
        // SENGAJA hanya 3 tipe mitra: Kedutaan Besar, Misi Asing ASEAN, Misi
        // Permanen Negara ASEAN — yaitu perwakilan negara asing di Jakarta.
        // Mitra Non-PNA, Pemprov DKI, KBRI, KJRI, dan PTRI TIDAK diperingkat di
        // sini sesuai arahan bisnis: ranking ini mengukur keaktifan mitra
        // diplomatik asing, bukan seluruh pihak yang pernah berinteraksi dengan
        // Biro KSD. Jangan "melengkapi" daftar ini dengan kelima tipe lain.
        //
        // Konsekuensi teknis: ketiga tipe di bawah pasti punya `kode_negara`,
        // sehingga grid-nya aman memakai `.flag-country-{kode}` langsung tanpa
        // perlu x-mitra-icon.
        $hitungAktivitas = function ($query, string $labelNamaResmi) {
            return $query
                ->withCount(['kerjasama', 'kolaborasi', 'undangan', 'audiensi', 'kunjungan', 'acaraDki'])
                ->get()
                ->map(fn ($mitra) => (object) [
                    'kode_negara' => $mitra->kode_negara,
                    'nama_resmi' => $mitra->{$labelNamaResmi},
                    'total_aktivitas' => $mitra->kerjasama_count
                        + $mitra->kolaborasi_count
                        + $mitra->undangan_count
                        + $mitra->audiensi_count
                        + $mitra->kunjungan_count
                        + $mitra->acara_dki_count,
                ]);
        };

        $mitraAktif = $hitungAktivitas(KedutaanBesar::where('is_active', true), 'nama_kedutaan_besar_id')
            ->concat($hitungAktivitas(MisiAsingAsean::where('is_active', true), 'nama_misi_asing_asean_id'))
            ->concat($hitungAktivitas(MisiPermanenAsean::where('is_active', true), 'nama_misi_permanen_asean_id'))
            ->sortByDesc('total_aktivitas')
            ->take(40)
            ->values();

        return view('mod_dashboard.dashboard', compact(
            'akumulasiMitra',
            'akumulasiRiwayat',
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
}
