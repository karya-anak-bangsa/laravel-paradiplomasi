<?php

namespace App\Support;

use App\Enums\TipeMitra;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Data sebaran wilayah mitra berbasis negara untuk dashboard: daftar mitra per
 * lokasi (modal rincian) dan grafik batang berkelompok "Visualisasi Rincian
 * Sebaran Lokasi Mitra KSD".
 *
 * Sengaja terpisah dari query "Rincian Sebaran Lokasi" di DashboardController:
 * rincian itu menyempit mengikuti filter `tipe_wilayah`, sedangkan grafik
 * perbandingan harus selalu menampilkan seluruh tipe berdampingan — satu
 * query per tipe, tanpa UNION.
 */
class SebaranWilayah
{
    /** Jumlah kota teratas (menurut total mitra) yang wilayahnya ditampilkan di grafik. */
    private const JUMLAH_KOTA = 2;

    /** Jumlah kecamatan/kelurahan teratas dari tiap kota itu. */
    private const JUMLAH_PER_KOTA = 2;

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
     * Data dua grafik batang berkelompok (kecamatan & kelurahan) yang
     * membandingkan jumlah mitra per tipe berbasis negara — Kedutaan Besar,
     * Misi Asing ASEAN, dan Misi Permanen ASEAN — di wilayah dengan mitra
     * terbanyak.
     *
     * Wilayah yang ditampilkan dipilih bertingkat: JUMLAH_KOTA kota teratas
     * (menurut total mitra ketiga tipe), lalu JUMLAH_PER_KOTA kecamatan/
     * kelurahan teratas di tiap kota itu. Dengan nilai bawaan (2 × 2) tiap
     * grafik berisi 4 kelompok, mis. Menteng & Tanah Abang (Jakarta Pusat)
     * dan Setiabudi & Kebayoran Baru (Jakarta Selatan). Urutan kelompok
     * mengikuti peringkat kota, lalu peringkat wilayah di dalamnya.
     *
     * Kelurahan dibedakan per kota+kecamatan, kecamatan per kota (nama yang
     * sama di kota berbeda bukan wilayah yang sama), seperti kartu rincian.
     * Baris tanpa nama wilayah dilewati.
     *
     * @return array{
     *     tipe: list<array{label: string, warna: string}>,
     *     ada: bool,
     *     kecamatan: array{kota: list<string>, kategori: list<list<string>>, series: list<array{name: string, data: list<int>}>},
     *     kelurahan: array{kota: list<string>, kategori: list<list<string>>, series: list<array{name: string, data: list<int>}>}
     * }
     */
    public static function perWilayah(): array
    {
        $daftarTipe = collect(TipeMitra::cases())
            ->filter(fn (TipeMitra $tipe) => $tipe->berbasisNegara())
            ->values();

        // Satu elemen per mitra aktif: indeks tipenya + lokasinya.
        $mitra = $daftarTipe->flatMap(fn (TipeMitra $tipe, int $urutan) => DB::table((new ($tipe->modelClass()))->getTable())
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->get(['kota', 'kecamatan', 'kelurahan'])
            ->map(fn ($baris) => ['tipe' => $urutan, 'kota' => $baris->kota, 'kecamatan' => $baris->kecamatan, 'kelurahan' => $baris->kelurahan])
        )->filter(fn (array $baris) => filled($baris['kota']));

        $tipe = $daftarTipe->map(fn (TipeMitra $tipe, int $urutan) => [
            'label' => $tipe->labelSingkat(),
            'warna' => self::WARNA_CHART[$urutan] ?? 'secondary',
        ])->all();

        return [
            'tipe' => $tipe,
            'ada' => $mitra->isNotEmpty(),
            'kecamatan' => self::grupBar($mitra, $tipe, ['kecamatan']),
            'kelurahan' => self::grupBar($mitra, $tipe, ['kecamatan', 'kelurahan']),
        ];
    }

    /**
     * Susun satu grafik batang berkelompok.
     *
     * @param  Collection<int, array{tipe: int, kota: string, kecamatan: ?string, kelurahan: ?string}>  $mitra
     * @param  list<array{label: string, warna: string}>  $tipe
     * @param  list<string>  $tingkat  kolom pembentuk identitas wilayah (dari kota ke bawah); yang terakhir jadi nama kelompok
     */
    private static function grupBar(Collection $mitra, array $tipe, array $tingkat): array
    {
        $namaKolom = end($tingkat);
        $induk = count($tingkat) > 1 ? $tingkat[count($tingkat) - 2] : 'kota';

        $kotaTeratas = $mitra->countBy('kota')->sortKeys()->sortDesc()->take(self::JUMLAH_KOTA)->keys();

        $kelompok = $kotaTeratas->flatMap(function (string $kota) use ($mitra, $tingkat, $namaKolom) {
            return $mitra
                ->where('kota', $kota)
                ->filter(fn (array $baris) => collect($tingkat)->every(fn ($kolom) => filled($baris[$kolom])))
                ->groupBy(fn (array $baris) => collect($tingkat)->map(fn ($kolom) => $baris[$kolom])->implode('|'))
                ->map(fn (Collection $isi) => ['kota' => $kota, 'nama' => $isi->first()[$namaKolom], 'isi' => $isi])
                ->sortBy('nama')
                ->sortByDesc(fn (array $wilayah) => $wilayah['isi']->count())
                ->take(self::JUMLAH_PER_KOTA)
                ->values();
        })->values();

        return [
            'kota' => $kotaTeratas->all(),
            // Baris kedua label = induk wilayahnya, supaya kecamatan/kelurahan kembar nama tetap terbedakan.
            'kategori' => $kelompok->map(fn (array $wilayah) => [
                $wilayah['nama'],
                $induk === 'kota' ? $wilayah['kota'] : (string) $wilayah['isi']->first()[$induk],
            ])->all(),
            'series' => collect($tipe)->map(fn (array $info, int $urutan) => [
                'name' => $info['label'],
                'data' => $kelompok->map(fn (array $wilayah) => $wilayah['isi']->where('tipe', $urutan)->count())->all(),
            ])->all(),
        ];
    }
}
