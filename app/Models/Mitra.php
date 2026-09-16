<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mitra extends Model
{
    use SoftDeletes;

    protected $table        = 'tb_mitra';
    protected $primaryKey   = 'id_mitra';

    protected $fillable = [
        'tipe_mitra',
        'is_active',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
    ];
}
