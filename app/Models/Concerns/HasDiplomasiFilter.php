<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

/**
 * Scope filter status & tahun yang dipakai bersama oleh 5 modul Riwayat
 * Diplomasi (Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan) supaya
 * pencarian data dilakukan di level query (bukan memuat semua baris lalu
 * disaring di browser), penting karena data dicatat lintas tahun.
 *
 * Model yang memakai trait ini WAJIB punya kolom/property berikut:
 *
 * @property string $statusColumn Nama kolom status pada model ini, mis. 'status_kerjasama'
 */
trait HasDiplomasiFilter
{
    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        return $query->when($status, fn (Builder $q) => $q->where($this->statusColumn, $status));
    }

    public function scopeFilterTahun(Builder $query, ?string $tahun): Builder
    {
        return $query->when($tahun, fn (Builder $q) => $q->whereYear('tanggal_diterima', $tahun));
    }

    public static function tahunTersedia(): array
    {
        return static::query()
            ->whereNotNull('tanggal_diterima')
            ->selectRaw('DISTINCT YEAR(tanggal_diterima) as tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->toArray();
    }
}
