<?php

namespace App\Models\Concerns;

use App\Enums\TipeMitra;
use App\Models\Mitra;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static void creating(\Closure|string $callback)
 * @method static void deleted(\Closure|string $callback)
 * @method static void restored(\Closure|string $callback)
 * @method static void forceDeleted(\Closure|string $callback)
 */
trait BelongsToMitra
{
    public static function bootBelongsToMitra(): void
    {
        // otomatis buat baris tb_mitra setiap record anak dibuat
        static::creating(function ($model) {
            if (empty($model->id_mitra)) {
                $mitra = Mitra::create([
                    'tipe_mitra' => static::tipeMitra(),
                    'is_active' => $model->is_active ?? true,
                ]);

                $model->id_mitra = $mitra->id_mitra;
            }
        });

        // ikut soft-delete tb_mitra saat record anak di-soft-delete
        static::deleted(function ($model) {
            if (! $model->isForceDeleting()) {
                optional($model->mitra)->delete();
            }
        });

        // ikut restore tb_mitra saat record anak di-restore
        static::restored(function ($model) {
            optional($model->mitra)->restore();
        });

        // ikut hapus permanen tb_mitra saat record anak di-force delete
        static::forceDeleted(function ($model) {
            optional($model->mitra()->withTrashed()->first())->forceDelete();
        });
    }

    /**
     * `withTrashed()` WAJIB di sini: saat record anak di-soft-delete, baris
     * tb_mitra pasangannya ikut di-soft-delete oleh hook di atas. Tanpa
     * withTrashed, relasi ini akan mengembalikan null untuk record yang sudah
     * dihapus — sehingga hook `restored` gagal memulihkan tb_mitra dan modul
     * Restore Data tidak bisa mengaktifkan kembali supertype-nya.
     */
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra')->withTrashed();
    }

    /**
     * Query tabel index modul mitra — dipakai juga oleh ekspor Excel/PDF
     * (App\Support\EksporMitra), supaya file yang diunduh dijamin sama
     * dengan tabel. Mitra berbasis negara diurutkan menurut negaranya,
     * sisanya menurut nama resmi.
     */
    public function scopeDaftarIndex(Builder $query): void
    {
        $tipe = TipeMitra::from(static::tipeMitra());

        $query->where('is_active', true)
            ->orderBy($tipe->berbasisNegara() ? 'nama_negara' : $tipe->kolomNama());
    }

    /**
     * Kolom file ekspor, dikunci label header — sengaja sama dengan tabel
     * index modulnya (tanpa kolom Aksi), bedanya keterangan ditulis utuh.
     * Bawaan ini untuk mitra "nama + keterangan"; subtype yang tabel
     * index-nya berbeda meng-override method ini.
     *
     * @return array<string, Closure(Model): mixed>
     */
    public static function kolomEkspor(): array
    {
        $kolomNama = TipeMitra::from(static::tipeMitra())->kolomNama();

        return [
            'Nama' => fn (Model $item) => $item->{$kolomNama},
            'Keterangan' => fn (Model $item) => $item->keterangan,
        ];
    }

    // setiap model anak WAJIB override method ini untuk menentukan tipe_mitra-nya
    abstract public static function tipeMitra(): string;
}
