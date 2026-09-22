<?php

// app/Models/PemprovDki.php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Perangkat daerah di lingkungan Pemerintah Provinsi DKI Jakarta (biro, dinas,
 * badan) yang menjadi mitra Biro KSD. Dibutuhkan karena antar-perangkat daerah
 * Pemprov DKI dimungkinkan melakukan kerjasama, kolaborasi, audiensi, dsb.
 *
 * Mengikuti pola "nama + keterangan" seperti NonPerwakilanNegaraAsing — tidak
 * punya kode/nama negara, alamat, maupun koordinat.
 */
class PemprovDki extends Model
{
    use BelongsToMitra, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_pemprov_dki';

    protected $primaryKey = 'id_pemprov_dki';

    protected $fillable = [
        'nama_pemprov_dki',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::PemprovDki->value;
    }
}
