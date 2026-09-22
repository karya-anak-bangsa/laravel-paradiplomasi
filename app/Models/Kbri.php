<?php

// app/Models/Kbri.php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Kedutaan Besar Republik Indonesia di luar negeri (mis. KBRI Tokyo, KBRI Bern).
 *
 * JANGAN tertukar dengan KedutaanBesar — model itu mencatat kedutaan besar
 * NEGARA ASING di Jakarta, sedangkan model ini mencatat perwakilan RI di
 * negara lain. Keduanya tipe mitra yang berbeda di tb_mitra.
 *
 * Mengikuti pola "nama + keterangan" seperti NonPerwakilanNegaraAsing.
 */
class Kbri extends Model
{
    use BelongsToMitra, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_kbri';

    protected $primaryKey = 'id_kbri';

    protected $fillable = [
        'nama_kbri',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::Kbri->value;
    }
}
