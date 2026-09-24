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
    //
    // Nama tiap relasi di bawah WAJIB sama dengan TipeMitra::relasi(), karena
    // accessor di bawah dan eager-load di controller menurunkannya dari enum.
    //
    // Kesepuluhnya memakai withTrashed() dengan alasan yang sama seperti
    // ReferencesMitra::mitra(): riwayat diplomasi yang masih aktif tetap harus
    // bisa menampilkan nama mitranya meski mitra itu sudah dihapus (subtype dan
    // supertype-nya ter-soft-delete berbarengan lewat BelongsToMitra). Tanpa
    // ini, accessor nama_resmi_mitra/label_mitra di bawah akan mengembalikan
    // null untuk mitra yang sudah dihapus — termasuk saat modul Restore Data
    // menampilkan kembali data tersebut.
    // --------------------------------------------------------------------------

    public function kedutaanBesar(): HasOne
    {
        return $this->hasOne(KedutaanBesar::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function misiAsingAsean(): HasOne
    {
        return $this->hasOne(MisiAsingAsean::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function misiPermanenAsean(): HasOne
    {
        return $this->hasOne(MisiPermanenAsean::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function kantorDagangAsing(): HasOne
    {
        return $this->hasOne(KantorDagangAsing::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function pusatKebudayaanAsing(): HasOne
    {
        return $this->hasOne(PusatKebudayaanAsing::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function nonPerwakilanNegaraAsing(): HasOne
    {
        return $this->hasOne(NonPerwakilanNegaraAsing::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function pemprovDki(): HasOne
    {
        return $this->hasOne(PemprovDki::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function kbri(): HasOne
    {
        return $this->hasOne(Kbri::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function kjri(): HasOne
    {
        return $this->hasOne(Kjri::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    public function ptri(): HasOne
    {
        return $this->hasOne(Ptri::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    // --------------------------------------------------------------------------
    // ACCESSOR LINTAS SUBTYPE — dipakai oleh modul Riwayat Diplomasi supaya
    // tidak perlu tahu/peduli mitra ini sebenarnya tipe apa
    // --------------------------------------------------------------------------

    /**
     * Ambil record subtype yang benar-benar terisi, sesuai `tipe_mitra`.
     *
     * Relasi yang dibaca ditentukan oleh TipeMitra::relasi(), jadi menambah
     * jenis mitra baru TIDAK perlu menyentuh method ini. Panggil dengan
     * eager-load `with(TipeMitra::relasiMitra(''))` untuk hindari N+1.
     */
    public function subtype(): ?Model
    {
        $relasi = $this->tipe_mitra?->relasi();

        if ($relasi === null) {
            return null;
        }

        return $this->{$relasi};
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
     * Nama resmi (Bahasa Indonesia) mitra sesuai tipenya — kolom nama resmi
     * berbeda nama per tabel subtype (nama_kedutaan_besar_id, nama_kbri, dst),
     * sehingga tidak bisa diakses lewat properti generik seperti namaMitra.
     * Pemetaan kolomnya diambil dari TipeMitra::kolomNama().
     */
    protected function namaResmiMitra(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->subtype()?->{$this->tipe_mitra->kolomNama()},
        );
    }

    /**
     * Label yang aman dipakai di UI manapun: nama negara bila mitra ini
     * perwakilan negara asing, selain itu nama resminya.
     */
    protected function labelMitra(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tipe_mitra?->berbasisNegara()
                ? $this->nama_mitra
                : $this->nama_resmi_mitra,
        );
    }
}
