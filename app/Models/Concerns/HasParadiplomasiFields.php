<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Trait ini mengasumsikan dipakai pada model Eloquent (tb_kerjasama, tb_kolaborasi,
 * tb_undangan, tb_audiensi, tb_kunjungan) dengan kolom dan property berikut:
 *
 * @property-read \Illuminate\Support\Carbon|null $tanggal_diterima
 * @property-read \Illuminate\Support\Carbon|null $tanggal_selesai
 * @property string $statusColumn Nama kolom status pada model ini, mis. 'status_kerjasama'
 * @property string $judulColumn  Nama kolom judul pada model ini, mis. 'kerjasama'
 */
trait HasParadiplomasiFields
{
    public const TRIWULAN_OPTIONS = [
        'TW I'      => 'TW I',
        'TW II'     => 'TW II',
        'TW III'    => 'TW III',
        'TW IV'     => 'TW IV',
    ];

    public const STATUS_OPTIONS = [
        'Berjalan'  => 'Berjalan',
        'Selesai'   => 'Selesai',
        'Tunda'     => 'Tunda',
        'Batal'     => 'Batal',
        'Regret'    => 'Regret',
    ];

    protected function statusBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->{$this->statusColumn}) {
                'Berjalan' => 'bg-blue-lt',
                'Selesai'  => 'bg-success-lt',
                'Tunda'    => 'bg-warning-lt',
                'Batal'    => 'bg-danger-lt',
                'Regret'   => 'bg-secondary-lt',
                default    => 'bg-secondary-lt',
            },
        );
    }

    protected function tanggalDiterimaDisplay(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->tanggal_diterima?->format('d M Y') ?? '-',
        );
    }

    protected function tanggalSelesaiDisplay(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->tanggal_selesai
                ? $this->tanggal_selesai->format('d M Y')
                : '<span class="text-danger">Masih Berjalan</span>',
        );
    }

    protected function judulRingkas(): Attribute
    {
        return Attribute::make(
            get: fn() => str($this->{$this->judulColumn})->stripTags()->limit(100)->toString(),
        );
    }
}
