<?php

namespace App\Models;

use App\Models\Concerns\HasDiplomasiFieldOptions;
use App\Models\Concerns\HasDiplomasiFilter;
use App\Models\Concerns\HasDiplomasiProfileAccessors;
use App\Models\Concerns\ReferencesMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kerjasama extends Model
{
    use HasDiplomasiFieldOptions, HasDiplomasiFilter, HasDiplomasiProfileAccessors, ReferencesMitra, SoftDeletes;

    protected string $judulColumn = 'kerjasama';

    protected string $statusColumn = 'status_kerjasama';

    protected $table = 'tb_kerjasama';

    protected $primaryKey = 'id_kerjasama';

    /**
     * `file_dokumen`, `nama_pic`, `nomor_pic` sengaja BELUM dikumpulkan lewat aplikasi
     * (arahan Biro KSD): tidak ada input di _form.blade.php, tidak ada rule
     * validasi di Store/UpdateKerjasamaRequest, dan tidak ditampilkan di halaman show —
     * jadi nilainya selalu null kecuali diisi lewat seeder.
     *
     * Ketiga kolom itu tetap didaftarkan di sini karena kolomnya sudah ada di
     * migration dan siap dipakai begitu Biro KSD memutuskan mengumpulkannya.
     * Ini keputusan bisnis yang ditunda, BUKAN kolom yang terlupakan — jangan
     * dihapus dari migration hanya karena terlihat tidak terpakai.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_mitra',
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
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];
}
