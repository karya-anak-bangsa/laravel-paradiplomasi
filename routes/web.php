<?php

// halaman auth
use App\Enums\ModulDiplomasi;
use App\Http\Controllers\AcaraDKIController;
// halaman backend
use App\Http\Controllers\AudiensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EksporDiplomasiController;
use App\Http\Controllers\KbriController;
use App\Http\Controllers\KedutaanBesarController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\KjriController;
use App\Http\Controllers\KolaborasiController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\MisiAsingAseanController;
use App\Http\Controllers\MisiPermanenAseanController;
use App\Http\Controllers\NonPerwakilanNegaraAsingController;
use App\Http\Controllers\PemprovDkiController;
use App\Http\Controllers\PtriController;
use App\Http\Controllers\RestoreDataController;
use App\Http\Controllers\TanggalPentingController;
use App\Http\Controllers\UndanganController;
// other
use Illuminate\Support\Facades\Route;

// ------------------------------------------------------------------------------------------------- #
// Route Halaman Auth
// ------------------------------------------------------------------------------------------------- #
Route::middleware('cek.tamu')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------------------------------------------------------------------------------------- #
// Modul-Modul di Paradiplomasi Jakarta
// ------------------------------------------------------------------------------------------------- #
Route::middleware('cek.auth')->group(function () {
    // dashboard & tanggal penting hanya punya halaman index (kalender Tanggal
    // Penting read-only, diturunkan dari Acara DKI), jadi tidak perlu resource penuh
    Route::resource('dashboard', DashboardController::class)->only(['index']);

    // khusus admin, boleh CRUD penuh
    Route::middleware('cek.admin')->group(function () {
        Route::resource('kedutaan-besar', KedutaanBesarController::class)->except(['index', 'show']);
        Route::resource('misi-asing-asean', MisiAsingAseanController::class)->except(['index', 'show']);
        Route::resource('misi-permanen-asean', MisiPermanenAseanController::class)->except(['index', 'show']);
        Route::resource('non-perwakilan-negara-asing', NonPerwakilanNegaraAsingController::class)->except(['index', 'show']);
        Route::resource('pemprov-dki', PemprovDkiController::class)->except(['index', 'show']);
        Route::resource('kbri', KbriController::class)->except(['index', 'show']);
        Route::resource('kjri', KjriController::class)->except(['index', 'show']);
        Route::resource('ptri', PtriController::class)->except(['index', 'show']);
        Route::resource('kerjasama', KerjasamaController::class)->except(['index', 'show']);
        Route::resource('kolaborasi', KolaborasiController::class)->except(['index', 'show']);
        Route::resource('undangan', UndanganController::class)->except(['index', 'show']);
        Route::resource('audiensi', AudiensiController::class)->except(['index', 'show']);
        Route::resource('kunjungan', KunjunganController::class)->except(['index', 'show']);
        Route::resource('acara-dki', AcaraDKIController::class)->except(['index', 'show']);
        Route::view('akun-pengguna', 'mod_akun_pengguna.index')->name('akun-pengguna.index');
        Route::view('riwayat-aktivitas', 'mod_riwayat_aktivitas.index')->name('riwayat-aktivitas.index');

        // Restore Data bukan resource: datanya berasal dari 14 modul sekaligus,
        // jadi tidak ada satu model pun yang bisa dijadikan route binding.
        // Segmen {grup}/{modul} divalidasi terhadap TipeMitra & ModulDiplomasi
        // di App\Support\DataTerhapus.
        Route::get('restore-data', [RestoreDataController::class, 'index'])->name('restore-data.index');
        Route::put('restore-data/{grup}/{modul}/{id}', [RestoreDataController::class, 'update'])->name('restore-data.update');
    });

    // admin & guest, cuma boleh lihat
    Route::resource('kedutaan-besar', KedutaanBesarController::class)->only(['index', 'show']);
    Route::resource('misi-asing-asean', MisiAsingAseanController::class)->only(['index', 'show']);
    Route::resource('misi-permanen-asean', MisiPermanenAseanController::class)->only(['index', 'show']);
    Route::resource('non-perwakilan-negara-asing', NonPerwakilanNegaraAsingController::class)->only(['index', 'show']);
    Route::resource('pemprov-dki', PemprovDkiController::class)->only(['index', 'show']);
    Route::resource('kbri', KbriController::class)->only(['index', 'show']);
    Route::resource('kjri', KjriController::class)->only(['index', 'show']);
    Route::resource('ptri', PtriController::class)->only(['index', 'show']);
    Route::resource('kerjasama', KerjasamaController::class)->only(['index', 'show']);
    Route::resource('kolaborasi', KolaborasiController::class)->only(['index', 'show']);
    Route::resource('undangan', UndanganController::class)->only(['index', 'show']);
    Route::resource('audiensi', AudiensiController::class)->only(['index', 'show']);
    Route::resource('kunjungan', KunjunganController::class)->only(['index', 'show']);
    Route::resource('acara-dki', AcaraDKIController::class)->only(['index', 'show']);
    Route::resource('tanggal-penting', TanggalPentingController::class)->only(['index']);

    // Ekspor Excel/PDF daftar Riwayat Diplomasi: satu pasang route untuk
    // keenam modul, segmen {modul} dibatasi ke slug App\Enums\ModulDiplomasi.
    Route::controller(EksporDiplomasiController::class)
        ->prefix('ekspor/{modul}')
        ->where(['modul' => implode('|', array_map(fn (ModulDiplomasi $modul) => $modul->slug(), ModulDiplomasi::cases()))])
        ->name('ekspor.')
        ->group(function () {
            Route::get('excel', 'excel')->name('excel');
            Route::get('pdf', 'pdf')->name('pdf');
        });
});
