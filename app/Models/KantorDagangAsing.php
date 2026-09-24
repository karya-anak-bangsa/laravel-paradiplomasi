<?php

// app/Models/KantorDagangAsing.php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Kantor dagang/ekonomi asing di Jakarta (mis. Taipei Economic and Trade
 * Office/TETO).
 *
 * Perwakilan ekonomi dan perdagangan pihak asing yang bukan kedutaan besar —
 * umumnya karena tidak ada hubungan diplomatik resmi dengan Indonesia —
 * sehingga tidak dicatat di KedutaanBesar.
 *
 * Mengikuti pola "nama + keterangan" seperti NonPerwakilanNegaraAsing.
 */
class KantorDagangAsing extends Model
{
    use BelongsToMitra, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_kantor_dagang_asing';

    protected $primaryKey = 'id_kantor_dagang_asing';

    protected $fillable = [
        'nama_kantor_dagang_asing',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::KantorDagangAsing->value;
    }
}
