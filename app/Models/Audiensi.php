<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\HasParadiplomasiFields;


class Audiensi extends Model
{
    use SoftDeletes, HasParadiplomasiFields;

    protected string $judulColumn  = 'topik';
    protected string $statusColumn = 'status_audiensi';

    protected $table        = 'tb_audiensi';
    protected $primaryKey   = 'id_audiensi';

    protected $fillable = [
        'id_mitra',
        'topik',
        'rangkuman',
        'catatan',
        'file_dokumen',
        'tanggal_diterima',
        'tanggal_selesai',
        'triwulan_audiensi',
        'status_audiensi',
        'nama_pic',
        'nomor_pic',
        'is_active',
    ];

    protected $casts = [
        'tanggal_diterima' => 'date',
        'tanggal_selesai'  => 'date',
        'is_active'        => 'boolean',
    ];

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }
}
