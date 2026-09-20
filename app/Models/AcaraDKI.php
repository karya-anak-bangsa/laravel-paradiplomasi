<?php

namespace App\Models;

use App\Models\Concerns\HasDiplomasiFieldOptions;
use App\Models\Concerns\HasDiplomasiFilter;
use App\Models\Concerns\HasDiplomasiProfileAccessors;
use App\Models\Concerns\ReferencesMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcaraDKI extends Model
{
    use HasDiplomasiFieldOptions, HasDiplomasiFilter, HasDiplomasiProfileAccessors, ReferencesMitra, SoftDeletes;

    protected string $judulColumn = 'acara_dki';

    protected string $statusColumn = 'status_acara_dki';

    protected $table = 'tb_acara_dki';

    protected $primaryKey = 'id_acara_dki';

    protected $fillable = [
        'id_mitra',
        'acara_dki',
        'rangkuman',
        'catatan',
        'file_dokumen',
        'tanggal_diterima',
        'tanggal_selesai',
        'tanggal_awal_pelaksanaan',
        'tanggal_akhir_pelaksanaan',
        'triwulan_acara_dki',
        'status_acara_dki',
        'is_active',
    ];

    protected $casts = [
        'tanggal_diterima' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_awal_pelaksanaan' => 'date',
        'tanggal_akhir_pelaksanaan' => 'date',
        'is_active' => 'boolean',
    ];
}
