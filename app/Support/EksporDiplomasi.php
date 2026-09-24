<?php

namespace App\Support;

use App\Enums\ModulDiplomasi;
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
class EksporDiplomasi extends DaftarEkspor
{
    public const TANPA_MITRA = 'Belum ada mitra';

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

    public function namaSheet(): string
    {
        return $this->modul->value;
    }

    /**
     * Satu undangan Acara DKI sebagai teks: "Nama Mitra (Status)", plus
     * alasannya bila $denganAlasan. Excel mencantumkan alasan (selnya lebar
     * dan alasan penting untuk analisis pola kehadiran); PDF tidak, supaya
     * kolom Daftar Undangan tetap ringkas (arahan user, 25 Sep 2026).
     *
     * @param  array{mitra: string, kehadiran: string, alasan: ?string}  $undangan
     */
    public static function teksUndangan(array $undangan, bool $denganAlasan): string
    {
        $kehadiran = $undangan['kehadiran'];

        if ($denganAlasan && $undangan['alasan']) {
            $kehadiran .= ' – '.$undangan['alasan'];
        }

        return "{$undangan['mitra']} ({$kehadiran})";
    }

    protected function slug(): string
    {
        return $this->modul->slug();
    }

    protected function data(): Collection
    {
        return $this->data;
    }

    /**
     * Urutan kolom mengikuti index.blade.php: Mitra dulu untuk 5 modul
     * berbasis mitra tunggal, judul acara dulu untuk Acara DKI.
     */
    protected function kolom(): array
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
     * Daftar Undangan berupa array supaya tiap format memilih cara
     * menampilkannya sendiri (Excel: satu mitra per baris di dalam sel,
     * lengkap dengan alasan; PDF: satu mitra per <tr> bernomor tanpa alasan,
     * karena dompdf tidak bisa memecah satu baris tabel ke dua halaman).
     * Array kosong = acara belum punya mitra. Teksnya lewat teksUndangan().
     *
     * @return list<array{mitra: string, kehadiran: string, alasan: ?string}>
     */
    private function daftarUndangan(Model $acara): array
    {
        return $acara->mitra->map(fn (Model $mitra) => [
            'mitra' => $mitra->nama_resmi_mitra,
            'kehadiran' => $mitra->pivot->status_kehadiran,
            'alasan' => $mitra->pivot->keterangan_kehadiran,
        ])->all();
    }
}
