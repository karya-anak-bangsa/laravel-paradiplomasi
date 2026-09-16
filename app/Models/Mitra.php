<?php

namespace App\Models;

use App\Enums\TipeMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    // relasi ke masing-masing tabel spesifik (diisi bertahap seiring modul dibuat)
    public function kedutaanBesar()
    {
        return $this->hasOne(KedutaanBesar::class, 'id_mitra', 'id_mitra');
    }

    public function misiAsingAsean()
    {
        return $this->hasOne(MisiAsingAsean::class, 'id_mitra', 'id_mitra');
    }

    public function misiPermanenAsean()
    {
        return $this->hasOne(MisiPermanenNegaraAsean::class, 'id_mitra', 'id_mitra');
    }
}
