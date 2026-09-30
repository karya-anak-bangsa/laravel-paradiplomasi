<?php

namespace App\Support;

use Closure;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Induk isi file ekspor (Excel & PDF) sebuah tabel index. Turunannya cukup
 * menyebutkan judul, filter, data, dan kolomnya; urusan header, penomoran
 * baris, dan nama file seragam di sini.
 *
 * Turunan: EksporDiplomasi (6 modul Riwayat Diplomasi) dan EksporMitra
 * (8 modul Mitra). Keduanya dirender oleh App\Exports\DaftarExport (Excel)
 * dan view ekspor.daftar-pdf (PDF).
 */
abstract class DaftarEkspor
{
    /** Induk kolom tanggal pada header dua tingkat PDF ("Tanggal" → Diterima | Selesai). */
    public const GRUP_TANGGAL = 'Tanggal';

    public const KOLOM_TANGGAL = [self::GRUP_TANGGAL.' Diterima', self::GRUP_TANGGAL.' Selesai'];

    /** Kolom berisi nilai pendek, dirata-tengah di PDF & dibuat sempit di Excel. */
    public const KOLOM_SEMPIT = ['No', ...self::KOLOM_TANGGAL, 'Status', 'Tipe'];

    /** Perkiraan lebar PDF seragam (pt): area cetak A4 landscape, 1 karakter font 11px, padding kiri+kanan sel. */
    private const LEBAR_CETAK_PT = 770;

    private const PT_PER_KARAKTER = 5;

    private const PADDING_SEL_PT = 10;

    abstract public function judul(): string;

    abstract public function keteranganFilter(): string;

    /** Nama sheet Excel (maks. 31 karakter). */
    abstract public function namaSheet(): string;

    /** Bagian nama file setelah "daftar_". */
    abstract protected function slug(): string;

    abstract protected function data(): Collection;

    /**
     * Kolom file, dikunci label header — sengaja sama dengan tabel index
     * modulnya (tanpa kolom Aksi).
     *
     * @return array<string, Closure(Model): mixed>
     */
    abstract protected function kolom(): array;

    /**
     * Khusus PDF: true = lebar kolom diatur sendiri (bukan otomatis oleh
     * dompdf) lewat lebarKolomSeragam(): kolom kolomAutofit() selebar isinya,
     * sisanya berbagi lebar menurut bobotKolom(). Bawaannya false.
     */
    public function kolomSeragam(): bool
    {
        return false;
    }

    /**
     * Teks sel PDF untuk tabel berlebar seragam (lihat kolomSeragam()). Sama
     * dengan nl2br(e($teks)), ditambah pemenggalan baris setelah "@" pada
     * baris berupa email yang panjang: dompdf tidak memecah kata di tengah,
     * sehingga satu email panjang saja melebarkan kolomnya di atas kolom lain.
     */
    public static function htmlSelSeragam(string $teks, int $batasEmail = 30): string
    {
        return collect(explode("\n", $teks))
            ->map(fn (string $baris) => str_contains($baris, '@') && mb_strlen($baris) > $batasEmail
                ? str_replace('@', '@<br>', e($baris))
                : e($baris))
            ->implode('<br>');
    }

    /**
     * Label kolom yang selebar isinya (autofit) pada tabel PDF berlebar
     * seragam. Bawaan mitra berbasis negara; EksporDiplomasi menimpanya.
     *
     * @return list<string>
     */
    protected function kolomAutofit(): array
    {
        return ['No', 'Negara'];
    }

    /**
     * Perbandingan lebar kolom NON-autofit (label => bobot); kolom yang tidak
     * disebut berbobot 1, jadi bawaannya sama lebar.
     *
     * @return array<string, int|float>
     */
    protected function bobotKolom(): array
    {
        return [];
    }

    /**
     * Lebar tiap kolom (persen) untuk tabel PDF berlebar seragam, dikunci
     * label header lengkap (mis. "Tanggal Diterima"). Kolom autofit seukuran
     * isi terpanjangnya (satu baris, tanpa turun) — dompdf menghitung lebar
     * dari pt, bukan karakter, jadi ukurannya diperkirakan lewat
     * PT_PER_KARAKTER ditambah padding sel. Sisa lebar dibagi menurut
     * bobotKolom().
     *
     * @param  list<array<string, mixed>>  $daftarBaris  hasil baris()
     * @return array<string, float> label kolom => persen
     */
    public function lebarKolomSeragam(array $daftarBaris): array
    {
        $lebar = [];

        foreach (array_intersect($this->header(), $this->kolomAutofit()) as $label) {
            $karakter = max(
                mb_strlen(Str::after($label, self::GRUP_TANGGAL.' ')),
                ...array_map(fn (array $baris) => self::panjangTeks($baris[$label] ?? null), $daftarBaris),
            );
            $lebar[$label] = round(($karakter * self::PT_PER_KARAKTER + self::PADDING_SEL_PT) / self::LEBAR_CETAK_PT * 100, 2);
        }

        $lainnya = array_diff($this->header(), array_keys($lebar));
        $bobot = array_map(fn (string $label) => $this->bobotKolom()[$label] ?? 1, $lainnya);
        $sisa = 100 - array_sum($lebar);

        foreach ($lainnya as $i => $label) {
            $lebar[$label] = round($sisa * $bobot[$i] / array_sum($bobot), 2);
        }

        return $lebar;
    }

    /** Jumlah karakter terpanjang di satu baris sel, sebagaimana tercetak di PDF. */
    private static function panjangTeks(mixed $nilai): int
    {
        return match (true) {
            $nilai instanceof DateTimeInterface => 11, // "02 Jul 2026"
            is_array($nilai) => 0,
            default => max(0, ...array_map('mb_strlen', explode("\n", (string) $nilai))),
        };
    }

    public function namaFile(string $ekstensi): string
    {
        return 'daftar_'.$this->slug().'_'.Waktu::sekarang()->format('Ymd_His').'.'.$ekstensi;
    }

    /**
     * @return list<string>
     */
    public function header(): array
    {
        return ['No', ...array_keys($this->kolom())];
    }

    /**
     * Header dua tingkat khusus PDF: kolom tanggal dikelompokkan di bawah
     * satu sel "Tanggal" (colspan), kolom lainnya memanjang dua baris
     * (rowspan). Tabel tanpa kolom tanggal cukup satu tingkat (bawah
     * kosong). Excel tetap memakai header() satu tingkat supaya autofilter
     * dan freeze pane-nya sederhana.
     *
     * @return array{atas: list<array{label: string, colspan: int, rowspan: int}>, bawah: list<string>}
     */
    public function headerBertingkat(): array
    {
        $header = $this->header();
        $rowspan = array_intersect($header, self::KOLOM_TANGGAL) === [] ? 1 : 2;
        $atas = [];
        $bawah = [];

        foreach ($header as $label) {
            if (! in_array($label, self::KOLOM_TANGGAL)) {
                $atas[] = ['label' => $label, 'colspan' => 1, 'rowspan' => $rowspan];

                continue;
            }

            if ($bawah === []) {
                $atas[] = ['label' => self::GRUP_TANGGAL, 'colspan' => count(self::KOLOM_TANGGAL), 'rowspan' => 1];
            }

            $bawah[] = Str::after($label, self::GRUP_TANGGAL.' ');
        }

        return ['atas' => $atas, 'bawah' => $bawah];
    }

    /**
     * Satu array per baris, dikunci label header. Tanggal dibiarkan berupa
     * objek tanggal supaya Excel bisa menyimpannya sebagai tanggal sungguhan.
     * Teks boleh berisi "\n" untuk nilai dua baris (mis. nama ID + EN).
     *
     * @return list<array<string, mixed>>
     */
    public function baris(): array
    {
        $kolom = $this->kolom();

        return $this->data()->values()->map(fn (Model $item, int $i) => [
            'No' => $i + 1,
            ...array_map(fn (Closure $nilai) => $nilai($item), $kolom),
        ])->all();
    }
}
