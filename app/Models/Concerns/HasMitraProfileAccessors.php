<?php
// app/Models/Concerns/HasMitraProfileAccessors.php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Accessor untuk UI yang dipakai bersama oleh setiap subtype Mitra
 * (KedutaanBesar, MisiAsingAsean, MisiPermanenAsean, dst).
 *
 * Model yang memakai trait ini WAJIB punya kolom `telepon_kantor`,
 * `email_kantor` (string/text, boleh berisi beberapa nilai dipisah
 * koma), dan `is_active` (boolean).
 */
trait HasMitraProfileAccessors
{
    protected function teleponKantorArray(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->telepon_kantor
                ? array_map('trim', explode(',', $this->telepon_kantor))
                : [],
        );
    }

    protected function emailKantorArray(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->email_kantor
                ? array_map('trim', explode(',', $this->email_kantor))
                : [],
        );
    }

    protected function activeLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_active ? 'Aktif' : 'Nonaktif',
        );
    }

    protected function activeBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_active ? 'bg-success-lt' : 'bg-warning-lt',
        );
    }
}
