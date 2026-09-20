<?php

namespace App\Models;

use App\Models\Concerns\HasDiplomasiFieldOptions;
use App\Models\Concerns\HasDiplomasiFilter;
use App\Models\Concerns\HasDiplomasiProfileAccessors;
use App\Models\Concerns\ReferencesMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kunjungan extends Model
{
    use HasDiplomasiFieldOptions, HasDiplomasiFilter, HasDiplomasiProfileAccessors, ReferencesMitra, SoftDeletes;

    protected string $judulColumn = 'perihal';

    protected string $statusColumn = 'status_kunjungan';

    protected $table = 'tb_kunjungan';

    protected $primaryKey = 'id_kunjungan';

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
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];
}
