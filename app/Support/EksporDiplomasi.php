<?php

namespace App\Support;

use App\Enums\ModulDiplomasi;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Isi file ekspor (Excel & PDF) daftar Riwayat Diplomasi. Kolomnya sengaja
 * sama dengan tabel index.blade.php tiap modul (tanpa kolom Aksi); bedanya
 * judul ditulis utuh, tidak dipotong seperti judul_ringkas.
 *
 * Perbedaan Acara DKI (banyak mitra per acara, lihat CLAUDE.md Bagian 4)
 * diwakili ModulDiplomasi::berbasisMitraTunggal(), bukan if per nama modul.
 */
class EksporDiplomasi
{
    public const KOLOM_TANGGAL = ['Tanggal Diterima', 'Tanggal Selesai'];

    /** Kolom berisi nilai pendek, dirata-tengah di PDF & dibuat sempit di Excel. */
    public const KOLOM_SEMPIT = ['No', ...self::KOLOM_TANGGAL, 'Status'];

    private Collection $data;

    public function __construct(
        public readonly ModulDiplomasi $modul,
        public readonly ?string $status = null,
        public readonly ?string $tahun = null,
    ) {
        $this->data = $modul->modelClass()::daftarIndex($status, $tahun)->get();
    }

    public function judul(): string
    {
        return 'Daftar '.$this->modul->value;
    }

    public function keteranganFilter(): string
    {
        return 'Status: '.($this->status ?? 'Semua Status').' | Tahun: '.($this->tahun ?? 'Semua Tahun');
    }

    public function namaFile(string $ekstensi): string
    {
        return 'daftar_'.$this->modul->slug().'_'.now()->format('Ymd_His').'.'.$ekstensi;
    }

    /**
     * @return list<string>
     */
    public function header(): array
    {
        return ['No', ...array_keys($this->kolom())];
    }

    /**
     * Satu array per baris, dikunci label header. Tanggal dibiarkan berupa
     * objek tanggal supaya Excel bisa menyimpannya sebagai tanggal sungguhan,
     * dan Daftar Undangan berupa array supaya tiap format memilih pemisahnya
     * sendiri (Excel: satu mitra per baris; PDF: menyambung, karena dompdf
     * tidak bisa memecah satu baris tabel ke dua halaman).
     *
     * @return list<array<string, mixed>>
     */
    public function baris(): array
    {
        $kolom = $this->kolom();

        return $this->data->values()->map(fn (Model $item, int $i) => [
            'No' => $i + 1,
            ...array_map(fn (Closure $nilai) => $nilai($item), $kolom),
        ])->all();
    }

    /**
     * Urutan kolom mengikuti index.blade.php: Mitra dulu untuk 5 modul
     * berbasis mitra tunggal, judul acara dulu untuk Acara DKI.
     *
     * @return array<string, Closure(Model): mixed>
     */
    private function kolom(): array
    {
        $mitra = $this->modul->berbasisMitraTunggal()
            ? ['Mitra' => fn (Model $item) => $item->mitra->nama_resmi_mitra]
            : ['Daftar Undangan' => fn (Model $item) => $this->daftarUndangan($item)];

        $judul = [
            $this->modul->labelJudul() => fn (Model $item) => str(html_entity_decode(strip_tags((string) $item->{$this->modul->kolomJudul()})))
                ->squish()
                ->toString(),
        ];

        return [
            ...($this->modul->berbasisMitraTunggal() ? $mitra + $judul : $judul + $mitra),
            'Tanggal Diterima' => fn (Model $item) => $item->tanggal_diterima,
            'Tanggal Selesai' => fn (Model $item) => $item->tanggal_selesai ?? 'Masih Berjalan',
            'Status' => fn (Model $item) => $item->{$this->modul->kolomStatus()},
        ];
    }

    /**
     * Nama mitra beserta status kehadirannya (+ alasannya, bila ada).
     *
     * @return list<string>
     */
    private function daftarUndangan(Model $acara): array
    {
        if ($acara->mitra->isEmpty()) {
            return ['Belum ada mitra'];
        }

        return $acara->mitra->map(function (Model $mitra) {
            $kehadiran = $mitra->pivot->status_kehadiran;

            if ($mitra->pivot->keterangan_kehadiran) {
                $kehadiran .= ' – '.$mitra->pivot->keterangan_kehadiran;
            }

            return "{$mitra->nama_resmi_mitra} ({$kehadiran})";
        })->all();
    }
}
