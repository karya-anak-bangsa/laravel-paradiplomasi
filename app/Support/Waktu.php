<?php

namespace App\Support;

use Carbon\CarbonInterface;

/**
 * Jam yang ditampilkan ke pengguna, dalam WIB.
 *
 * Aplikasi & database berjalan dalam UTC (config app.timezone) supaya semua
 * timestamp tersimpan konsisten. Akibatnya now() dan created_at/deleted_at
 * bernilai UTC — tujuh jam lebih lambat dari WIB — sehingga setiap jam yang
 * ditampilkan dengan label "WIB" WAJIB lewat kelas ini (atau komponen
 * <x-waktu-akses>), bukan now()/->format() polos.
 *
 * Tanggal tanpa jam (tanggal_diterima, tanggal_selesai, dst.) tidak perlu
 * lewat sini: kolom `date` tidak punya zona waktu.
 */
class Waktu
{
    public static function sekarang(): CarbonInterface
    {
        return now(config('app.timezone_tampilan'));
    }

    /**
     * Timestamp dari database (UTC) dikonversi ke zona tampilan. Objek aslinya
     * tidak diubah, supaya model yang sama tetap aman disimpan ulang.
     */
    public static function tampil(?CarbonInterface $waktu): ?CarbonInterface
    {
        return $waktu?->copy()->setTimezone(config('app.timezone_tampilan'));
    }
}
