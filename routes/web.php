<?php

# List Controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KedutaanBesarController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\KolaborasiController;

# Other
use Illuminate\Support\Facades\Route;

# Proses Auth
Route::view('/', 'auth.login')->name('login');

# Modul-Modul di Paradiplomasi Jakarta
Route::resource('dashboard', DashboardController::class);
Route::resource('kedutaan-besar', KedutaanBesarController::class);
Route::resource('kerjasama', KerjasamaController::class);
Route::resource('kolaborasi', KolaborasiController::class);
