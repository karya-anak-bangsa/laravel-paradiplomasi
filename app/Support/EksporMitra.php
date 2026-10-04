<?php

namespace App\Support;

use App\Enums\TipeMitra;
use Illuminate\Database\Eloquent\Collection;

/**
 * Isi file ekspor (Excel & PDF) daftar mitra satu tipe. Data & urutannya
 * dari scope daftarIndex() — query yang sama dengan tabel index modulnya —
 * dan kolomnya dari kolomEkspor() milik model subtype (lihat BelongsToMitra).
 *
 * Ekspor parsial: bila $idTerpilih diisi, hanya mitra dengan primary key
 * subtype tersebut yang masuk file (urutannya tetap mengikuti daftarIndex()).
 * null = seluruh mitra aktif.
 */
class EksporMitra extends DaftarEkspor
{
    private Collection $data;

    /**
     * @param  list<int>|null  $idTerpilih
     */
    public function __construct(public readonly TipeMitra $tipe, private readonly ?array $idTerpilih = null)
    {
        $model = new ($tipe->modelClass());

        $this->data = $model::daftarIndex()
            ->when($idTerpilih !== null, fn ($query) => $query->whereIn($model->getQualifiedKeyName(), $idTerpilih))
            ->get();
    }

    public function judul(): string
    {
        return 'Daftar '.$this->tipe->value;
    }

    public function keteranganFilter(): string
    {
        return $this->idTerpilih === null ? 'Seluruh mitra Biro KSD' : 'Mitra terpilih';
    }

    public function pemisahKeterangan(): string
    {
        return '-';
    }

    public function namaSheet(): string
    {
        return $this->tipe->value;
    }

    /**
     * Mitra berbasis negara punya 6 kolom berisi teks panjang (nama, email,
     * alamat) — dibuat sama lebar agar tidak ada satu kolom yang mendominasi.
     */
    public function kolomSeragam(): bool
    {
        return $this->tipe->berbasisNegara();
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
