<?php

// app/Models/PerwakilanRi.php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\BelongsToMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Perwakilan Republik Indonesia di luar negeri (mis. KBRI Tokyo, KJRI Mumbai).
 *
 * Gabungan tiga modul yang sebelumnya terpisah — Kbri, Kjri, Ptri — atas
 * arahan Kasubag (25 Sep 2026). Jenis perwakilannya kini dibedakan lewat kolom
 * `tipe_perwakilan_ri`, bukan lewat tipe mitra tersendiri; lihat migration
 * 2026_09_25_110000_gabung_kbri_kjri_ptri_ke_tb_perwakilan_ri.
 *
 * JANGAN tertukar dengan KedutaanBesar — model itu mencatat kedutaan besar
 * NEGARA ASING di Jakarta, sedangkan model ini mencatat perwakilan RI di
 * negara lain.
 *
 * Nama tetap ditulis lengkap beserta jenisnya (mis. "KBRI Tokyo", bukan
 * "Tokyo"), karena dropdown pemilih mitra, file ekspor, dan Restore Data
 * hanya menampilkan kolom nama.
 */
class PerwakilanRi extends Model
{
    use BelongsToMitra, HasRiwayatDiplomasi, SoftDeletes;

    /**
     * Jenis perwakilan RI: kode yang disimpan => label yang ditampilkan.
     */
    public const TIPE_OPTIONS = [
        'KBRI' => 'Kedutaan Besar Republik Indonesia (KBRI)',
        'KJRI' => 'Konsulat Jenderal Republik Indonesia (KJRI)',
        'PTRI' => 'Perutusan Tetap Republik Indonesia (PTRI)',
    ];

    protected $table = 'tb_perwakilan_ri';

    protected $primaryKey = 'id_perwakilan_ri';

    protected $fillable = [
        'nama_perwakilan_ri',
        'tipe_perwakilan_ri',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // WAJIB — dipanggil oleh trait BelongsToMitra saat record baru dibuat
    public static function tipeMitra(): string
    {
        return TipeMitra::PerwakilanRi->value;
    }

    /**
     * Kolom ekspor mengikuti mod_perwakilan_ri/index.blade.php — kolom
     * bawaan BelongsToMitra ditambah kode jenis perwakilan.
     */
    public static function kolomEkspor(): array
    {
        return [
            'Nama' => fn (self $item) => $item->nama_perwakilan_ri,
            'Tipe' => fn (self $item) => $item->tipe_perwakilan_ri,
            'Keterangan' => fn (self $item) => $item->keterangan,
        ];
    }

    /**
     * Label lengkap jenis perwakilan, mis. "Konsulat Jenderal Republik
     * Indonesia (KJRI)" untuk kode "KJRI".
     */
    protected function tipePerwakilanRiLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => self::TIPE_OPTIONS[$this->tipe_perwakilan_ri] ?? $this->tipe_perwakilan_ri,
        );
    }
}
