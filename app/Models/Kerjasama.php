<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\HasParadiplomasiFields;

class Kerjasama extends Model
{
    use SoftDeletes, HasParadiplomasiFields;

    protected string $judulColumn  = 'kerjasama';
    protected string $statusColumn = 'status_kerjasama';

    protected $table        = 'tb_kerjasama';
    protected $primaryKey   = 'id_kerjasama';

    protected $fillable = [
        'id_kedutaan_besar',
        'kerjasama',
        'rangkuman',
        'catatan',
        'file_dokumen',
        'tanggal_diterima',
        'tanggal_selesai',
        'triwulan_kerjasama',
        'status_kerjasama',
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
