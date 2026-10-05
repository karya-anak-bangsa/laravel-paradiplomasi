<?php

namespace App\Support;

use App\Enums\ModulDiplomasi;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Satu bagian file ekspor Riwayat Diplomasi satu mitra: riwayat SATU modul
 * (mis. Kerjasama) milik mitra tersebut. Excel: satu sheet; PDF: satu tabel
 * berjudul. Dikumpulkan oleh EksporRiwayatMitra.
 *
 * Kolomnya sama dengan tab di x-mitra-riwayat (judul, tanggal, status) — kolom
 * Mitra tidak perlu karena seluruh baris milik mitra yang sama. Acara DKI
 * menambah kolom Kehadiran — status kehadiran mitra ini (kolom pivot, lihat
 * CLAUDE.md Bagian 4); alasannya hanya di Excel, sama seperti Daftar Undangan
 * pada ekspor Acara DKI.
 */
class BagianRiwayatMitra extends DaftarEkspor
{
    public function __construct(
        public readonly ModulDiplomasi $modul,
        private readonly Collection $data,
        private readonly bool $denganAlasan = false,
    ) {}

    public function judul(): string
    {
        return $this->modul->value;
    }

    public function keteranganFilter(): string
    {
        return 'Riwayat '.$this->modul->value;
    }

    public function namaSheet(): string
    {
        return $this->modul->value;
    }

    public function kolomSeragam(): bool
    {
        return true;
    }

    protected function kolomAutofit(): array
    {
        return ['No', ...self::KOLOM_TANGGAL, 'Status', 'Kehadiran'];
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
     * Acara DKI menyisipkan kolom kehadiran tepat setelah judul (arahan user,
     * 5 Okt 2026), supaya kolom Tanggal & Status di ujung kanan tetap sejajar
     * dengan kelima tabel lain di PDF.
     */
    protected function kolom(): array
    {
        $kehadiran = $this->modul->berbasisMitraTunggal() ? [] : [
            'Kehadiran' => fn (Model $item) => $item->pivot->status_kehadiran,
            ...($this->denganAlasan
                ? ['Keterangan Kehadiran' => fn (Model $item) => $item->pivot->keterangan_kehadiran]
                : []),
        ];

        return [
            ...EksporDiplomasi::kolomJudul($this->modul),
            ...$kehadiran,
            ...EksporDiplomasi::kolomJadwal($this->modul),
        ];
    }
}
