<?php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasMitraProfileAccessors;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MisiPermanenAsean extends Model
{
    use BelongsToMitra, HasMitraProfileAccessors, HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_misi_permanen_asean';

    protected $primaryKey = 'id_misi_permanen_asean';

    protected $fillable = [
        'kode_negara',
        'nama_negara',
        'nama_misi_permanen_asean_id',
        'nama_misi_permanen_asean_en',
        'format_undangan',
        'nama_diplomat',
        'telepon_kantor',
        'email_kantor',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::MisiPermanenAsean->value;
    }
}
