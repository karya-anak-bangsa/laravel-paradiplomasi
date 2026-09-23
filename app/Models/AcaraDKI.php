<?php

namespace App\Models;

use App\Models\Concerns\HasDiplomasiFieldOptions;
use App\Models\Concerns\HasDiplomasiFilter;
use App\Models\Concerns\HasDiplomasiProfileAccessors;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcaraDKI extends Model
{
    use HasDiplomasiFieldOptions, HasDiplomasiFilter, HasDiplomasiProfileAccessors, SoftDeletes;

    protected string $judulColumn = 'acara_dki';

    protected string $statusColumn = 'status_acara_dki';

    protected $table = 'tb_acara_dki';

    protected $primaryKey = 'id_acara_dki';

    /**
     * `file_dokumen` sengaja BELUM dikumpulkan lewat aplikasi
     * (arahan Biro KSD): tidak ada input di _form.blade.php, tidak ada rule
     * validasi di Store/UpdateAcaraDKIRequest, dan tidak ditampilkan di halaman show —
     * jadi nilainya selalu null kecuali diisi lewat seeder.
     *
     * Kolom itu tetap didaftarkan di sini karena kolomnya sudah ada di
     * migration dan siap dipakai begitu Biro KSD memutuskan mengumpulkannya.
     * Ini keputusan bisnis yang ditunda, BUKAN kolom yang terlupakan — jangan
     * dihapus dari migration hanya karena terlihat tidak terpakai.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pelaksana',
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

    /**
     * Daftar mitra yang diundang/hadir pada acara ini. Beda dengan
     * ReferencesMitra (dipakai 5 modul Riwayat Diplomasi lain) karena
     * satu Acara DKI bisa melibatkan banyak mitra sekaligus, masing-masing
     * dengan status kehadirannya sendiri (lihat AcaraDkiMitra::pivot).
     *
     * `withTrashed()` menjaga daftar peserta acara tetap utuh: mitra yang
     * dihapus setelah acara berlangsung tetap tercatat pernah diundang/hadir,
     * sama alasannya dengan ReferencesMitra::mitra().
     */
    public function mitra(): BelongsToMany
    {
        return $this->belongsToMany(Mitra::class, 'tb_acara_dki_mitra', 'id_acara_dki', 'id_mitra')
            ->withTrashed()
            ->using(AcaraDkiMitra::class)
            ->withPivot('status_kehadiran', 'keterangan_kehadiran')
            ->withTimestamps();
    }
}
