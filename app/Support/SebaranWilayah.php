<?php

namespace App\Support;

use App\Enums\TipeMitra;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Perbandingan sebaran wilayah (kota, kecamatan, kelurahan, total mitra) antar
 * tipe mitra berbasis negara, untuk chart di dashboard.
 *
 * Sengaja terpisah dari query "Rincian Sebaran Lokasi" di DashboardController:
 * rincian itu menyempit mengikuti filter `tipe_wilayah`, sedangkan chart
 * perbandingan harus selalu menampilkan seluruh tipe berdampingan — satu
 * query per tipe, tanpa UNION.
 *
 * Definisi hitungan sama dengan kartu angka rincian: kecamatan dibedakan per
 * kota, kelurahan per kota+kecamatan, dan "mitra" adalah jumlah barisnya.
 */
class SebaranWilayah
{
    /**
     * Warna chart per tipe, berurutan menurut TipeMitra::cases() yang berbasis
     * negara. Sengaja bukan TipeMitra::warna() (blue/azure/indigo): ketiganya
     * satu keluarga biru sehingga batang yang bersebelahan sulit dibedakan.
     * Tipe berbasis negara ke-4 dan seterusnya harus menambah warna di sini,
     * jangan diputar ulang.
     */
    private const WARNA_CHART = ['blue', 'orange', 'teal'];

    /**
     * @return Collection<int, array{label: string, warna: string, kota: int, kecamatan: int, kelurahan: int, mitra: int}>
     */
    public static function perTipe(): Collection
    {
        return collect(TipeMitra::cases())
            ->filter(fn (TipeMitra $tipe) => $tipe->berbasisNegara())
            ->values()
            ->map(function (TipeMitra $tipe, int $urutan) {
                $baris = DB::table((new ($tipe->modelClass()))->getTable())
                    ->where('is_active', true)
                    ->whereNull('deleted_at')
                    ->get(['kota', 'kecamatan', 'kelurahan']);

                return [
                    'label' => $tipe->labelSingkat(),
                    'warna' => self::WARNA_CHART[$urutan] ?? 'secondary',
                    'kota' => $baris->pluck('kota')->unique()->count(),
                    'kecamatan' => $baris->unique(fn ($b) => $b->kota.'|'.$b->kecamatan)->count(),
                    'kelurahan' => $baris->unique(fn ($b) => $b->kota.'|'.$b->kecamatan.'|'.$b->kelurahan)->count(),
                    'mitra' => $baris->count(),
                ];
            });
    }
}
