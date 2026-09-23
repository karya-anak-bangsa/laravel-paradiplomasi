<?php

namespace App\Models\Concerns;

use App\Models\Mitra;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Relasi ke satu mitra (jenis apapun — Kedutaan Besar, Misi Asing ASEAN,
 * Misi Permanen ASEAN, dst) lewat `id_mitra`. Dipakai oleh 5 modul Riwayat
 * Diplomasi (Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan) untuk
 * menunjuk ke mitra yang SUDAH ADA (dipilih di form), bukan membuat mitra
 * baru — beda dengan BelongsToMitra yang otomatis membuat baris `tb_mitra`
 * untuk subtype mitra baru.
 *
 * Pasangan trait ini di sisi Mitra adalah HasRiwayatDiplomasi.
 */
trait ReferencesMitra
{
    /**
     * `withTrashed()` dipasang karena riwayat diplomasi bersifat HISTORIS:
     * sebuah kerjasama yang masih aktif tetap harus menampilkan nama mitranya
     * meski mitra itu sendiri sudah dinonaktifkan/dihapus (baris tb_mitra-nya
     * ter-soft-delete). Tanpa ini, index & halaman rincian kelima modul akan
     * gagal membaca $item->mitra->nama_resmi_mitra begitu mitranya dihapus.
     */
    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra')->withTrashed();
    }
}
