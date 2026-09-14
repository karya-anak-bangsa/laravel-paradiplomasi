<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\HasParadiplomasiFields;

class Undangan extends Model
{
    use SoftDeletes, HasParadiplomasiFields;

    protected string $judulColumn  = 'acara';
    protected string $statusColumn = 'status_undangan';

    protected $table        = 'tb_undangan';
    protected $primaryKey   = 'id_undangan';

    protected $fillable = [
        'id_kedutaan_besar',
        'acara',
        'rangkuman',
        'catatan',
        'file_dokumen',
        'tanggal_diterima',
        'tanggal_selesai',
        'triwulan_undangan',
        'status_undangan',
        'nama_pic',
        'nomor_pic',
        'is_active',
    ];

    protected $casts = [
        'tanggal_diterima' => 'date',
        'tanggal_selesai'  => 'date',
        'is_active'        => 'boolean',
    ];

    public function kedutaanBesar(): BelongsTo
    {
        return $this->belongsTo(KedutaanBesar::class, 'id_kedutaan_besar');
    }
}
