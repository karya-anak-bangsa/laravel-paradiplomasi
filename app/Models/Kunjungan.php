<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\HasParadiplomasiFields;

class Kunjungan extends Model
{
    use SoftDeletes, HasParadiplomasiFields;

    protected string $judulColumn  = 'perihal';
    protected string $statusColumn = 'status_kunjungan';

    protected $table        = 'tb_kunjungan';
    protected $primaryKey   = 'id_kunjungan';

    protected $fillable = [
        'id_mitra',
        'perihal',
        'rangkuman',
        'catatan',
        'file_dokumen',
        'tanggal_diterima',
        'tanggal_selesai',
        'triwulan_kunjungan',
        'status_kunjungan',
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
