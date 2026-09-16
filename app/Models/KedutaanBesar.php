<?php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KedutaanBesar extends Model
{
    use SoftDeletes, BelongsToMitra;

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

    public static function tipeMitra(): string
    {
        return TipeMitra::KedutaanBesar->value;
    }

    #--------------------------------------------------------------------------
    # ACCESSOR (FOR UI)
    #--------------------------------------------------------------------------

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

    #--------------------------------------------------------------------------
    # RELASI ANTAR TABLE — via id_mitra (bukan lagi id_kedutaan_besar)
    #--------------------------------------------------------------------------

    public function kerjasama(): HasMany
    {
        return $this->hasMany(Kerjasama::class, 'id_mitra', 'id_mitra');
    }

    public function kolaborasi(): HasMany
    {
        return $this->hasMany(Kolaborasi::class, 'id_mitra', 'id_mitra');
    }

    public function undangan(): HasMany
    {
        return $this->hasMany(Undangan::class, 'id_mitra', 'id_mitra');
    }

    public function audiensi(): HasMany
    {
        return $this->hasMany(Audiensi::class, 'id_mitra', 'id_mitra');
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'id_mitra', 'id_mitra');
    }
}
