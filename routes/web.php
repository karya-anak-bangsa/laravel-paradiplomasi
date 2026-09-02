<?php

# List Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KedutaanBesarController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\KolaborasiController;

# Other
use Illuminate\Support\Facades\Route;

# ------------------------------------------------------------------------------------------------- #
# Route Halaman Auth
# ------------------------------------------------------------------------------------------------- #
Route::middleware('cek.tamu')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

# ------------------------------------------------------------------------------------------------- #
# Modul-Modul di Paradiplomasi Jakarta
# ------------------------------------------------------------------------------------------------- #
Route::middleware('cek.auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('kedutaan-besar', KedutaanBesarController::class);
    Route::resource('kerjasama', KerjasamaController::class);
    Route::resource('kolaborasi', KolaborasiController::class);
});
