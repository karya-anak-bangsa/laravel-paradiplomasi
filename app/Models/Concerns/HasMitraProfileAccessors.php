<?php

// app/Models/Concerns/HasMitraProfileAccessors.php

namespace App\Models\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * Accessor untuk UI yang dipakai bersama oleh setiap subtype Mitra
 * (KedutaanBesar, MisiAsingAsean, MisiPermanenAsean, dst).
 *
 * Model yang memakai trait ini WAJIB punya kolom `telepon_kantor`,
 * `email_kantor` (string/text, boleh berisi beberapa nilai dipisah
 * koma), dan `is_active` (boolean).
 */

/**
 * Accessor untuk UI yang dipakai bersama oleh setiap subtype Mitra
 * (KedutaanBesar, MisiAsingAsean, MisiPermanenAsean, dst).
 *
 * @property string|null $telepon_kantor Boleh berisi beberapa nomor dipisah koma
 * @property string|null $email_kantor Boleh berisi beberapa email dipisah koma
 * @property string|null $alamat Nama jalan
 * @property string|null $kelurahan
 * @property string|null $kecamatan
 * @property string|null $kota
 * @property string|null $kode_pos
 * @property bool $is_active
 */
trait HasMitraProfileAccessors
{
    protected function teleponKantorArray(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->telepon_kantor
                ? array_map('trim', explode(',', $this->telepon_kantor))
                : [],
        );
    }

    protected function emailKantorArray(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->email_kantor
                ? array_map('trim', explode(',', $this->email_kantor))
                : [],
        );
    }

    /**
     * Alamat dalam satu baris, dari nama jalan sampai kode pos. Bagian yang
     * kosong dilewati.
     */
    protected function alamatLengkap(): Attribute
    {
        return Attribute::make(
            get: fn () => collect([$this->alamat, $this->kelurahan, $this->kecamatan, $this->kota, $this->kode_pos])
                ->filter()
                ->implode(', ') ?: null,
        );
    }

    /**
     * Kolom Email & Alamat pada file ekspor ketiga mitra berbasis negara
     * (Kedutaan Besar, Misi Asing ASEAN, Misi Permanen ASEAN) — sengaja
     * tambahan di luar kolom tabel index (arahan user, 25 Sep 2026). Beberapa
     * email ditulis satu per baris dalam satu sel.
     *
     * @return array<string, Closure(Model): mixed>
     */
    public static function kolomKontakEkspor(): array
    {
        return [
            'Email' => fn (self $item) => implode("\n", $item->email_kantor_array) ?: null,
            'Alamat' => fn (self $item) => $item->alamat_lengkap,
        ];
    }

    protected function activeLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_active ? 'Aktif' : 'Nonaktif',
        );
    }

    protected function activeBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_active ? 'bg-success-lt' : 'bg-warning-lt',
        );
    }
}
