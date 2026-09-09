<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KedutaanBesar extends Model
{
    use SoftDeletes;

    protected $table        = 'tb_kedutaan_besar';
    protected $primaryKey   = 'id_kedutaan_besar';

    protected $fillable = [
        'kode_negara',
        'nama_negara',
        'nama_kedutaan_besar_id',
        'nama_kedutaan_besar_en',
        'format_undangan',
        'nama_diplomat',
        'jabatan_diplomat',
        'email_kantor',
        'telepon_kantor',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'website',
        'latitude',
        'longitude',
        'is_active',
    ];

    protected $casts = [
        'is_active'     => 'boolean',
        'latitude'      => 'decimal:7',
        'longitude'     => 'decimal:7',
    ];

    #--------------------------------------------------------------------------
    # ACCESSOR (FOR UI)
    #--------------------------------------------------------------------------

    # accessor - pecah telepon_kantor jadi array
    protected function teleponKantorArray(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->telepon_kantor
                ? array_map('trim', explode(',', $this->telepon_kantor))
                : [],
        );
    }

    # accessor - pecah email_kantor jadi array
    protected function emailKantorArray(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->email_kantor
                ? array_map('trim', explode(',', $this->email_kantor))
                : [],
        );
    }

    # accessor - label status aktif/nonaktif
    protected function activeLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_active ? 'Aktif' : 'Nonaktif',
        );
    }

    # accessor - warna badge status aktif/nonaktif
    protected function activeBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_active ? 'bg-success-lt' : 'bg-warning-lt',
        );
    }

    #--------------------------------------------------------------------------
    # RELASI ANTAR TABLE
    #--------------------------------------------------------------------------

    public function kerjasama(): HasMany
    {
        return $this->hasMany(Kerjasama::class, 'id_kedutaan_besar');
    }

    public function kolaborasi()
    {
        return $this->hasMany(Kolaborasi::class, 'id_kedutaan_besar');
    }

    public function undangan(): HasMany
    {
        return $this->hasMany(Undangan::class, 'id_kedutaan_besar');
    }

    public function audiensi(): HasMany
    {
        return $this->hasMany(Audiensi::class, 'id_kedutaan_besar');
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'id_kedutaan_besar');
    }
}
