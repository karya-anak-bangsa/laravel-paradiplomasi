<?php

// app/Models/Ptri.php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Perutusan Tetap Republik Indonesia pada organisasi internasional
 * (mis. PTRI New York, PTRI Jenewa).
 *
 * Perwakilan RI yang diakreditasi ke organisasi internasional, bukan ke negara
 * penerima — berbeda dari Kbri (kedutaan besar RI) dan Kjri (konsulat jenderal
 * RI). Catatan: "Misi Permanen Republik Indonesia untuk ASEAN" TIDAK dicatat di
 * sini, melainkan tetap di MisiPermanenAsean, mengikuti klasifikasi sheet acuan.
 *
 * Mengikuti pola "nama + keterangan" seperti NonPerwakilanNegaraAsing.
 */
class Ptri extends Model
{
    use BelongsToMitra, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_ptri';

    protected $primaryKey = 'id_ptri';

    protected $fillable = [
        'nama_ptri',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::Ptri->value;
    }
}
