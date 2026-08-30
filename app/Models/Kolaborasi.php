<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kolaborasi extends Model
{
    use SoftDeletes;

    protected $table        = 'tb_kolaborasi';
    protected $primaryKey   = 'id_kolaborasi';

    protected $fillable = [
        'id_kedutaan_besar',
        'kolaborasi',
        'rangkuman',
        'catatan',
        'file_dokumen',
        'tanggal_diterima',
        'tanggal_selesai',
        'triwulan_kolaborasi',
        'status_kolaborasi',
        'nama_pic',
        'nomor_pic',
        'is_active',
    ];

    protected $casts = [
        'tanggal_diterima'  => 'date',
        'tanggal_selesai'   => 'date',
        'is_active'         => 'boolean',
    ];

    public function kedutaanBesar()
    {
        return $this->belongsTo(KedutaanBesar::class, 'id_kedutaan_besar');
    }
}
