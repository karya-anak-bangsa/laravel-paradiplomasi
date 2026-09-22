<?php

namespace App\Models\Concerns;

use App\Models\Mitra;

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

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }

    // setiap model anak WAJIB override method ini untuk menentukan tipe_mitra-nya
    abstract public static function tipeMitra(): string;
}
