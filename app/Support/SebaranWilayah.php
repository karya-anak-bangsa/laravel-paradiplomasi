<?php

namespace App\Support;

use App\Enums\TipeMitra;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
     * Mitra aktif beserta lokasinya, untuk modal yang terbuka saat sel
     * kecamatan/kelurahan di tabel rincian diklik. Diurutkan menurut nama.
     *
     * @param  Collection<int, TipeMitra>  $daftarTipe  tipe mitra berbasis negara yang dicakup
     * @return Collection<int, array{tipe: string, nama: string, url: string, kota: ?string, kecamatan: ?string, kelurahan: ?string}>
     */
    public static function mitraPerLokasi(Collection $daftarTipe): Collection
    {
        return $daftarTipe
            ->flatMap(fn (TipeMitra $tipe) => $tipe->modelClass()::where('is_active', true)
                ->get()
                ->map(fn ($mitra) => [
                    'tipe' => $tipe->labelSingkat(),
                    'nama' => $mitra->{$tipe->kolomNama()},
                    'nama_en' => $mitra->getAttributes()[Str::replaceLast('_id', '_en', $tipe->kolomNama())] ?? null,
                    'kode_negara' => $mitra->kode_negara,
                    'nama_negara' => $mitra->nama_negara,
                    'nama_diplomat' => $mitra->nama_diplomat,
                    'jabatan_diplomat' => $mitra->getAttributes()['jabatan_diplomat'] ?? null,
                    'url' => route($tipe->routeShow(), $mitra),
                    'kota' => $mitra->kota,
                    'kecamatan' => $mitra->kecamatan,
                    'kelurahan' => $mitra->kelurahan,
                ]))
            ->sortBy('nama', SORT_NATURAL | SORT_FLAG_CASE)
            ->values();
    }

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
