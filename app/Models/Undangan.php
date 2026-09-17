<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Concerns\HasDiplomasiFieldOptions;
use App\Models\Concerns\HasDiplomasiProfileAccessors;
use App\Models\Concerns\ReferencesMitra;

class Undangan extends Model
{
    use SoftDeletes, HasDiplomasiFieldOptions, HasDiplomasiProfileAccessors, ReferencesMitra;

    protected string $judulColumn  = 'acara';
    protected string $statusColumn = 'status_undangan';

    protected $table        = 'tb_undangan';
    protected $primaryKey   = 'id_undangan';

    protected $fillable = [
        'id_mitra',
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
}
