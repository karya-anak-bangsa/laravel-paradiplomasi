<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AcaraDkiMitra extends Pivot
{
    public const STATUS_KEHADIRAN_OPTIONS = [
        'Diundang' => 'Diundang',
        'Hadir' => 'Hadir',
        'Tidak Hadir' => 'Tidak Hadir',
    ];

    protected $table = 'tb_acara_dki_mitra';

    protected $primaryKey = 'id_acara_dki_mitra';

    public $incrementing = true;

    protected $fillable = [
        'id_acara_dki',
        'id_mitra',
        'status_kehadiran',
        'keterangan_kehadiran',
    ];
}
