<?php

// app/Models/Concerns/HasRiwayatDiplomasi.php

namespace App\Models\Concerns;

use App\Models\AcaraDKI;
use App\Models\AcaraDkiMitra;
use App\Models\Audiensi;
use App\Models\Kerjasama;
use App\Models\Kolaborasi;
use App\Models\Kunjungan;
use App\Models\Undangan;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    /**
     * Keenam relasi di bawah ini WAJIB difilter `is_active` — tombol
     * "hapus" di setiap modul Riwayat Diplomasi hanya menonaktifkan baris
     * (`is_active = false`), tidak benar-benar menghapusnya (lihat method
     * `destroy()` di masing-masing controller). Tanpa filter ini, baris
     * yang sudah "dihapus" tetap tampil selamanya di tab Riwayat Diplomasi
     * pada halaman profil mitra, meski sudah hilang dari index modulnya.
     */
    public function kerjasama(): HasMany
    {
        return $this->hasMany(Kerjasama::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    public function kolaborasi(): HasMany
    {
        return $this->hasMany(Kolaborasi::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    public function undangan(): HasMany
    {
        return $this->hasMany(Undangan::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    public function audiensi(): HasMany
    {
        return $this->hasMany(Audiensi::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'id_mitra', 'id_mitra')->where('is_active', true);
    }

    /**
     * Acara DKI yang melibatkan mitra ini (diundang/hadir/tidak hadir).
     * Beda dengan 5 relasi lain di atas karena satu Acara DKI bisa
     * melibatkan banyak mitra sekaligus — lihat AcaraDKI::mitra().
     */
    public function acaraDki(): BelongsToMany
    {
        return $this->belongsToMany(AcaraDKI::class, 'tb_acara_dki_mitra', 'id_mitra', 'id_acara_dki', 'id_mitra', 'id_acara_dki')
            ->using(AcaraDkiMitra::class)
            ->withPivot('status_kehadiran', 'keterangan_kehadiran')
            ->withTimestamps()
            ->where('tb_acara_dki.is_active', true);
    }
}
