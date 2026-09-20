<?php

// app/Models/NonPerwakilanNegaraAsing.php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NonPerwakilanNegaraAsing extends Model
{
    use BelongsToMitra, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_non_perwakilan_negara_asing';

    protected $primaryKey = 'id_non_perwakilan_negara_asing';

    protected $fillable = [
        'nama_non_perwakilan_negara_asing',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::NonPNA->value;
    }
}
