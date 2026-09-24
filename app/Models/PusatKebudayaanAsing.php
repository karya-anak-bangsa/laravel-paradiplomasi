<?php

// app/Models/PusatKebudayaanAsing.php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Pusat kebudayaan asing di Jakarta (mis. Goethe-Institut, Japan Foundation,
 * Korean Cultural Center).
 *
 * Lembaga kebudayaan milik negara asing yang bermitra langsung dengan Biro
 * KSD, di luar jalur kedutaan besarnya. Catatan: kegiatan yang pada sheet
 * acuan dicatat atas nama kedutaan besar (mis. IFI di bawah Kedutaan Besar
 * Perancis) tetap di KedutaanBesar, mengikuti sheet acuan.
 *
 * Mengikuti pola "nama + keterangan" seperti NonPerwakilanNegaraAsing.
 */
class PusatKebudayaanAsing extends Model
{
    use BelongsToMitra, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_pusat_kebudayaan_asing';

    protected $primaryKey = 'id_pusat_kebudayaan_asing';

    protected $fillable = [
        'nama_pusat_kebudayaan_asing',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::PusatKebudayaanAsing->value;
    }
}
