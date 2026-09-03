<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Audiensi extends Model
{
    use SoftDeletes;

    protected $table        = 'tb_audiensi';
    protected $primaryKey   = 'id_audiensi';

    protected $fillable = [
        'id_kedutaan_besar',
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

    protected function statusBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->status_audiensi) {
                'Berjalan' => 'bg-blue-lt',
                'Selesai'  => 'bg-success-lt',
                'Batal'    => 'bg-danger-lt',
            },
        );
    }

    public function kedutaanBesar(): BelongsTo
    {
        return $this->belongsTo(KedutaanBesar::class, 'id_kedutaan_besar');
    }
}
