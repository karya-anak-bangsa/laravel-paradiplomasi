<?php

// app/Models/Kjri.php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Konsulat Jenderal Republik Indonesia di luar negeri (mis. KJRI Mumbai).
 *
 * Perwakilan RI setingkat konsulat jenderal — berbeda dari Kbri (kedutaan besar
 * RI) maupun Ptri (perutusan tetap RI pada organisasi internasional).
 *
 * Mengikuti pola "nama + keterangan" seperti NonPerwakilanNegaraAsing.
 */
class Kjri extends Model
{
    use BelongsToMitra, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_kjri';

    protected $primaryKey = 'id_kjri';

    protected $fillable = [
        'nama_kjri',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::Kjri->value;
    }
}
