<?php

namespace App\Models;

use App\Enums\TipeMitra;
use App\Models\Concerns\HasRiwayatDiplomasi;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mitra extends Model
{
    use HasRiwayatDiplomasi, SoftDeletes;

    protected $table = 'tb_mitra';

    protected $primaryKey = 'id_mitra';

    protected $fillable = [
        'tipe_mitra',
        'is_active',
    ];

    protected $casts = [
        'tipe_mitra' => TipeMitra::class,
        'is_active' => 'boolean',
    ];

    // --------------------------------------------------------------------------
    // RELASI KE DATA SPESIFIK (subtype) — sesuai tipe_mitra
    // --------------------------------------------------------------------------

    public function kedutaanBesar(): HasOne
    {
        return $this->hasOne(KedutaanBesar::class, 'id_mitra', 'id_mitra');
    }

    public function misiAsingAsean(): HasOne
    {
        return $this->hasOne(MisiAsingAsean::class, 'id_mitra', 'id_mitra');
    }

    public function misiPermanenAsean(): HasOne
    {
        return $this->hasOne(MisiPermanenAsean::class, 'id_mitra', 'id_mitra');
    }

    public function nonPerwakilanNegaraAsing(): HasOne
    {
        return $this->hasOne(NonPerwakilanNegaraAsing::class, 'id_mitra', 'id_mitra');
    }

    // --------------------------------------------------------------------------
    // ACCESSOR LINTAS SUBTYPE — dipakai oleh 5 modul Riwayat Diplomasi supaya
    // tidak perlu tahu/peduli mitra ini sebenarnya tipe apa
    // --------------------------------------------------------------------------

    /**
     * Ambil record subtype yang benar-benar terisi (KedutaanBesar,
     * MisiAsingAsean, MisiPermanenAsean, atau NonPerwakilanNegaraAsing),
     * sesuai `tipe_mitra`. Panggil dengan eager-load keempat relasi
     * (with('kedutaanBesar', 'misiAsingAsean', 'misiPermanenAsean',
     * 'nonPerwakilanNegaraAsing')) untuk hindari N+1.
     */
    public function subtype(): KedutaanBesar|MisiAsingAsean|MisiPermanenAsean|NonPerwakilanNegaraAsing|null
    {
        return $this->kedutaanBesar ?? $this->misiAsingAsean ?? $this->misiPermanenAsean ?? $this->nonPerwakilanNegaraAsing;
    }

    protected function namaMitra(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->subtype()?->nama_negara,
        );
    }

    protected function kodeMitra(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->subtype()?->kode_negara,
        );
    }

    /**
     * Nama resmi (Bahasa Indonesia) mitra sesuai tipenya — kolom nama
     * resmi berbeda nama per tabel subtype (nama_kedutaan_besar_id,
     * nama_misi_asing_asean_id, nama_misi_permanen_asean_id,
     * nama_non_perwakilan_negara_asing), sehingga tidak bisa diakses
     * lewat properti generik seperti namaMitra.
     */
    protected function namaResmiMitra(): Attribute
    {
        return Attribute::make(
            get: function () {
                $subtype = $this->subtype();

                return match (true) {
                    $subtype instanceof KedutaanBesar => $subtype->nama_kedutaan_besar_id,
                    $subtype instanceof MisiAsingAsean => $subtype->nama_misi_asing_asean_id,
                    $subtype instanceof MisiPermanenAsean => $subtype->nama_misi_permanen_asean_id,
                    $subtype instanceof NonPerwakilanNegaraAsing => $subtype->nama_non_perwakilan_negara_asing,
                    default => null,
                };
            },
        );
    }
}
