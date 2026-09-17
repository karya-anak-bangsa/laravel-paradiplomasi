<?php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MisiPermanenAsean extends Model
{
    use SoftDeletes, BelongsToMitra;

    protected $table        = 'tb_misi_permanen_asean';
    protected $primaryKey   = 'id_misi_permanen_asean';

    protected $fillable = [
        'kode_negara',
        'nama_negara',
        'nama_misi_permanen_asean_id',
        'nama_misi_permanen_asean_en',
        'format_undangan',
        'nama_diplomat',
        'telepon_kantor',
        'email_kantor',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::MisiPermanenAsean->value;
    }

    #--------------------------------------------------------------------------
    # ACCESSOR (FOR UI) — mengikuti pola KedutaanBesar & MisiAsingAsean
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
    # RELASI ANTAR TABLE — via id_mitra
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
