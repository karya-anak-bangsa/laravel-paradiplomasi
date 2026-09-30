<?php

namespace App\Http\Controllers;

use App\Enums\ModulDiplomasi;
use App\Enums\TipeMitra;
use App\Models\AcaraDKI;
use App\Models\Audiensi;
use App\Models\KedutaanBesar;
use App\Models\Kerjasama;
use App\Models\Kolaborasi;
use App\Models\Kunjungan;
use App\Models\Undangan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Filter tahun per kartu (Akumulasi, Analisa Statistik, Mitra Aktif),
        // masing-masing independen lewat parameter query sendiri. Tahun
        // mengikuti `tanggal_diterima` seperti filter Tahun di index modul;
        // nilai di luar daftar (mis. URL diketik manual) dianggap "Semua Tahun".
        $tahunOptions = collect(ModulDiplomasi::cases())
            ->flatMap(fn (ModulDiplomasi $modul) => $modul->modelClass()::tahunTersedia())
            ->unique()
            ->sortDesc()
            ->values()
            ->all();
        $tahunDipilih = fn (string $kunci): ?string => in_array((int) request($kunci), $tahunOptions, true)
            ? (string) request($kunci)
            : null;
        $tahunAkumulasi = $tahunDipilih('tahun_akumulasi');
        $tahunAnalisa = $tahunDipilih('tahun_analisa');
        $tahunMitra = $tahunDipilih('tahun_mitra');

        // Akumulasi Kegiatan Diplomasi di Biro KSD Setda DKI Jakarta — kelompok
        // Mitra diturunkan dari TipeMitra, sehingga jenis mitra baru otomatis
        // muncul di dashboard tanpa menyentuh controller maupun blade-nya.
        //
        // Ikon seluruh kartu diseragamkan jadi "landmark" khusus di kartu ini —
        // bukan lewat TipeMitra::ikon(), supaya modul Restore Data (yang memakai
        // method sama) tidak ikut berubah.
        $akumulasiMitra = collect(TipeMitra::cases())->map(fn (TipeMitra $tipe) => (object) [
            'label' => $tipe->labelSingkat(),
            'ikon' => 'landmark',
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
            'jumlah' => $modul['model']::where('is_active', true)->filterTahun($tahunAkumulasi)->count(),
        ]);

        // Peta Sebaran & Pencarian Lokasi Kedutaan Besar
        $daftarKedutaan = KedutaanBesar::where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('nama_negara')
            ->get(['id_kedutaan_besar', 'kode_negara', 'nama_negara', 'nama_kedutaan_besar_id', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'latitude', 'longitude']);

        // Rincian sebaran wilayah mencakup seluruh mitra berbasis negara (Kedutaan
        // Besar, Misi Asing ASEAN, Misi Permanen ASEAN) — ketiganya punya kolom
        // kota/kecamatan/kelurahan yang sama, jadi digabung lewat UNION sebelum
        // dihitung. Diturunkan dari TipeMitra::berbasisNegara() agar tipe
        // berbasis negara berikutnya otomatis ikut.
        //
        // Filter `tipe_wilayah` (slug TipeMitra) menyempitkan ke satu tipe; nilai
        // di luar daftar dianggap "Semua Mitra".
        $tipeWilayah = collect(TipeMitra::cases())
            ->filter(fn (TipeMitra $tipe) => $tipe->berbasisNegara());
        $tipeWilayahOptions = $tipeWilayah->mapWithKeys(fn (TipeMitra $tipe) => [$tipe->slug() => $tipe->labelSingkat()])->all();
        $wilayahMitra = $tipeWilayah
            ->when(
                array_key_exists((string) request('tipe_wilayah'), $tipeWilayahOptions),
                fn ($daftar) => $daftar->filter(fn (TipeMitra $tipe) => $tipe->slug() === request('tipe_wilayah')),
            )
            ->map(fn (TipeMitra $tipe) => DB::table((new ($tipe->modelClass()))->getTable())
                ->select('kota', 'kecamatan', 'kelurahan')
                ->where('is_active', true)
                ->whereNull('deleted_at'))
            ->reduce(fn ($gabungan, $query) => $gabungan ? $gabungan->unionAll($query) : $query);

        $rincianWilayah = DB::query()->fromSub($wilayahMitra, 'wilayah_mitra')
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
            'Kerjasama' => Kerjasama::filterTahun($tahunAnalisa)->selectRaw('status_kerjasama as status, COUNT(*) as total')->groupBy('status_kerjasama')->pluck('total', 'status'),
            'Kolaborasi' => Kolaborasi::filterTahun($tahunAnalisa)->selectRaw('status_kolaborasi as status, COUNT(*) as total')->groupBy('status_kolaborasi')->pluck('total', 'status'),
            'Undangan' => Undangan::filterTahun($tahunAnalisa)->selectRaw('status_undangan as status, COUNT(*) as total')->groupBy('status_undangan')->pluck('total', 'status'),
            'Audiensi' => Audiensi::filterTahun($tahunAnalisa)->selectRaw('status_audiensi as status, COUNT(*) as total')->groupBy('status_audiensi')->pluck('total', 'status'),
            'Kunjungan' => Kunjungan::filterTahun($tahunAnalisa)->selectRaw('status_kunjungan as status, COUNT(*) as total')->groupBy('status_kunjungan')->pluck('total', 'status'),
            'Acara DKI' => AcaraDKI::filterTahun($tahunAnalisa)->selectRaw('status_acara_dki as status, COUNT(*) as total')->groupBy('status_acara_dki')->pluck('total', 'status'),
        ];
        $moduleLabels = array_keys($jumlahPerModul);
        $pieSeriesPerModul = collect($jumlahPerModul)
            ->map(fn ($counts) => collect($statusList)->map(fn ($status) => $counts[$status] ?? 0)->values())
            ->values();

        // Mitra Diplomatik Paling Aktif (berdasarkan total Riwayat Diplomasi).
        //
        // SENGAJA hanya 3 tipe mitra: Kedutaan Besar, Misi Asing ASEAN, Misi
        // Permanen Negara ASEAN — yaitu perwakilan negara asing di Jakarta.
        // Kantor Dagang Asing, Pusat Kebudayaan Asing, Perwakilan RI, Pemprov
        // DKI, dan Mitra Non-PNA TIDAK diperingkat di sini sesuai arahan bisnis:
        // ranking ini mengukur keaktifan mitra diplomatik asing, bukan seluruh
        // pihak yang pernah berinteraksi dengan Biro KSD. Jangan "melengkapi" daftar ini dengan kelima tipe lain.
        //
        // Konsekuensi teknis: ketiga tipe di bawah pasti punya `kode_negara`,
        // sehingga grid-nya aman memakai `.flag-country-{kode}` langsung tanpa
        // perlu x-mitra-icon.
        $hitungAktivitas = function (TipeMitra $tipe) use ($tahunMitra) {
            $perTahun = fn ($query) => $query->filterTahun($tahunMitra);

            return $tipe->modelClass()::where('is_active', true)
                ->withCount([
                    'kerjasama' => $perTahun,
                    'kolaborasi' => $perTahun,
                    'undangan' => $perTahun,
                    'audiensi' => $perTahun,
                    'kunjungan' => $perTahun,
                    'acaraDki' => $perTahun,
                ])
                ->get()
                ->map(fn ($mitra) => (object) [
                    'kode_negara' => $mitra->kode_negara,
                    'nama_resmi' => $mitra->{$tipe->kolomNama()},
                    'url_profil' => route($tipe->routeShow(), $mitra),
                    'total_aktivitas' => $mitra->kerjasama_count
                        + $mitra->kolaborasi_count
                        + $mitra->undangan_count
                        + $mitra->audiensi_count
                        + $mitra->kunjungan_count
                        + $mitra->acara_dki_count,
                ]);
        };

        $mitraAktif = $hitungAktivitas(TipeMitra::KedutaanBesar)
            ->concat($hitungAktivitas(TipeMitra::MisiAsingAsean))
            ->concat($hitungAktivitas(TipeMitra::MisiPermanenAsean))
            ->where('total_aktivitas', '>', 0)
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
            'tahunOptions',
            'tipeWilayahOptions',
        ));
    }
}
