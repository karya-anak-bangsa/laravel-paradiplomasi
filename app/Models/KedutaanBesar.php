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

    # relasi - hub ke modul kerjasama
    public function kerjasama(): HasMany
    {
        return $this->hasMany(Kerjasama::class, 'id_kedutaan_besar');
    }

    public function kolaborasi()
    {
        return $this->hasMany(Kolaborasi::class, 'id_kedutaan_besar');
    }
}
