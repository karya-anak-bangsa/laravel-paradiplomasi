<?php

// app/Models/Concerns/HasRiwayatDiplomasi.php

namespace App\Models\Concerns;

use App\Models\AcaraDKI;
use App\Models\Audiensi;
use App\Models\Kerjasama;
use App\Models\Kolaborasi;
use App\Models\Kunjungan;
use App\Models\Undangan;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Relasi ke 5 modul Riwayat Diplomasi, berlaku untuk mitra jenis apapun.
 *
 * Dipakai oleh Mitra (supertype) DAN setiap subtype (KedutaanBesar,
 * MisiAsingAsean, MisiPermanenAsean, dst) karena kelimanya sama-sama
 * punya kolom `id_mitra` yang merujuk ke `tb_mitra.id_mitra` — baik
 * sebagai primary key (Mitra) maupun sebagai FK 1:1 milik subtype.
 */
trait HasRiwayatDiplomasi
{
    public function kerjasama(): HasMany
    {
        return $this->hasMany(Kerjasama::class, 'id_mitra', 'id_mitra');
    }

    public function kolaborasi(): HasMany
    {
        return $this->hasMany(Kolaborasi::class, 'id_mitra', 'id_mitra');
    }

    public function undangan(): HasMany
    {
        return $this->hasMany(Undangan::class, 'id_mitra', 'id_mitra');
    }

    public function audiensi(): HasMany
    {
        return $this->hasMany(Audiensi::class, 'id_mitra', 'id_mitra');
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'id_mitra', 'id_mitra');
    }

    public function acaraDki(): HasMany
    {
        return $this->hasMany(AcaraDKI::class, 'id_mitra', 'id_mitra');
    }
}
