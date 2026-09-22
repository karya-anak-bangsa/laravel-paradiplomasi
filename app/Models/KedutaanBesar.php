<?php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasMitraProfileAccessors;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KedutaanBesar extends Model
{
    use BelongsToMitra, HasMitraProfileAccessors, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_kedutaan_besar';

    protected $primaryKey = 'id_kedutaan_besar';

    protected $fillable = [
        'kode_negara',
        'nama_negara',
        'nama_kedutaan_besar_id',
        'nama_kedutaan_besar_en',
        'format_undangan',
        'nama_diplomat',
        'jabatan_diplomat',
        'email_kantor',
        'telepon_kantor',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'website',
        'latitude',
        'longitude',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::KedutaanBesar->value;
    }
}
