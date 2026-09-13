<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

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
            get: fn() => $this->tanggal_selesai?->format('d M Y') ?? 'Masih Berjalan',
        );
    }

    protected function tanggalSelesaiClass(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->tanggal_selesai ? '' : 'text-danger',
        );
    }

    protected function judulRingkas(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->ringkas($this->{$this->judulColumn}),
        );
    }

    protected function ringkas(?string $value, int $limit = 100): string
    {
        return str($value)->stripTags()->limit($limit)->toString();
    }
}
