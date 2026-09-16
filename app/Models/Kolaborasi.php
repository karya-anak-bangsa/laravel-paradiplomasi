<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\HasParadiplomasiFields;

class Kolaborasi extends Model
{
    use SoftDeletes, HasParadiplomasiFields;

    protected string $judulColumn  = 'kolaborasi';
    protected string $statusColumn = 'status_kolaborasi';

    protected $table        = 'tb_kolaborasi';
    protected $primaryKey   = 'id_kolaborasi';

    protected $fillable = [
        'id_mitra',
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

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }
}
