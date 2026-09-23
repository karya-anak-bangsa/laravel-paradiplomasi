<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * Pola "hapus" = nonaktifkan, dipakai oleh method destroy() di SELURUH modul
 * (8 modul Mitra + 6 modul Riwayat Diplomasi). Lihat CLAUDE.md Bagian 9.3.
 *
 * Tombol hapus melakukan dua hal, bukan satu:
 *
 *  1. `is_active = false` — status bisnisnya: data tidak lagi muncul di index,
 *     dropdown mitra, kartu dashboard, maupun tab Riwayat Diplomasi.
 *  2. `deleted_at` terisi (soft delete Eloquent) — CATATAN KAPAN data dihapus,
 *     dan sekaligus penanda bahwa baris ini layak muncul di Pengaturan Sistem >
 *     Restore Data. Tanpa langkah ini, waktu penghapusan hanya bisa ditebak
 *     dari `updated_at` dan modul Restore Data tidak punya cara membedakan
 *     "dihapus admin" dari "sekadar berstatus tidak aktif".
 *
 * Keduanya tetap terpisah karena perannya berbeda: `is_active` menentukan data
 * tampil atau tidak di modul aslinya, `deleted_at` mencatat jejak penghapusan.
 * Pemulihannya (kebalikan dari trait ini) ada di App\Support\DataTerhapus.
 *
 * Tidak ada data yang benar-benar hilang dari database di sini — force delete
 * tidak pernah dipanggil dari mana pun.
 */
trait MenonaktifkanData
{
    /**
     * Nonaktifkan satu baris modul Riwayat Diplomasi.
     *
     * Dua query memang disengaja: `delete()` pada model bersoft-delete hanya
     * menulis kolom `deleted_at` + `updated_at` (lihat SoftDeletes::runSoftDelete),
     * jadi `is_active` tidak akan ikut tersimpan bila hanya di-set di memori.
     */
    protected function nonaktifkan(Model $record): void
    {
        $record->update(['is_active' => false]);
        $record->delete();
    }

    /**
     * Nonaktifkan satu baris subtype Mitra beserta baris tb_mitra (supertype)
     * pasangannya — kalau supertype-nya tetap aktif, mitra yang sudah "dihapus"
     * masih akan muncul di dropdown pemilihan mitra.
     *
     * Soft delete tb_mitra tidak diurus di sini: hook `deleted` pada trait
     * App\Models\Concerns\BelongsToMitra sudah mencascade-nya begitu subtype-nya
     * di-soft-delete, persis seperti hook `restored` mencascade pemulihannya.
     */
    protected function nonaktifkanMitra(Model $subtype): void
    {
        $subtype->mitra->update(['is_active' => false]);

        $this->nonaktifkan($subtype);
    }
}
