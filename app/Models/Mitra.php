<?php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mitra extends Model
{
    use SoftDeletes, HasRiwayatDiplomasi;

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
        return $this->hasOne(MisiPermanenAsean::class, 'id_mitra', 'id_mitra');
    }
}
