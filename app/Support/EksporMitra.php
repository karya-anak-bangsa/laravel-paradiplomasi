<?php

namespace App\Support;

use App\Enums\TipeMitra;
use Illuminate\Database\Eloquent\Collection;

/**
 * Isi file ekspor (Excel & PDF) daftar mitra satu tipe. Data & urutannya
 * dari scope daftarIndex() — query yang sama dengan tabel index modulnya —
 * dan kolomnya dari kolomEkspor() milik model subtype (lihat BelongsToMitra).
 */
class EksporMitra extends DaftarEkspor
{
    private Collection $data;

    public function __construct(public readonly TipeMitra $tipe)
    {
        $this->data = $tipe->modelClass()::daftarIndex()->get();
    }

    public function judul(): string
    {
        return 'Daftar '.$this->tipe->value;
    }

    public function keteranganFilter(): string
    {
        return 'Seluruh mitra aktif';
    }

    public function namaSheet(): string
    {
        return $this->tipe->value;
    }

    protected function slug(): string
    {
        return $this->tipe->slug();
    }

    protected function data(): Collection
    {
        return $this->data;
    }

    protected function kolom(): array
    {
        return $this->tipe->modelClass()::kolomEkspor();
    }
}
