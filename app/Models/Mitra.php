<?php

namespace App\Models;

use App\Enums\TipeMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mitra extends Model
{
    use SoftDeletes;

    protected $table      = 'tb_mitra';
    protected $primaryKey = 'id_mitra';

    protected $fillable = [
        'tipe_mitra',
        'is_active',
    ];

    protected $casts = [
        'tipe_mitra' => TipeMitra::class,
        'is_active'  => 'boolean',
    ];

    #--------------------------------------------------------------------------
    # RELASI KE DATA SPESIFIK (subtype) — sesuai tipe_mitra
    #--------------------------------------------------------------------------

    public function kedutaanBesar(): HasOne
    {
        return $this->hasOne(KedutaanBesar::class, 'id_mitra', 'id_mitra');
    }

    public function misiAsingAsean(): HasOne
    {
        return $this->hasOne(MisiAsingAsean::class, 'id_mitra', 'id_mitra');
    }

    public function misiPermanenAsean(): HasOne
    {
        return $this->hasOne(MisiPermanenNegaraAsean::class, 'id_mitra', 'id_mitra');
    }

    #--------------------------------------------------------------------------
    # RELASI KE MODUL RIWAYAT — berlaku untuk mitra jenis apapun
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
