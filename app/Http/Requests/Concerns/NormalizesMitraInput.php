<?php

namespace App\Http\Requests\Concerns;

trait NormalizesMitraInput
{
    /**
     * Buang baris mitra yang seluruh kolomnya kosong sebelum validasi.
     *
     * Form Acara DKI selalu menyediakan satu baris mitra kosong sebagai
     * kenyamanan pengisian, sementara mitra sendiri bersifat opsional (acara
     * yang batal/ditunda, atau yang datanya belum dikurasi Biro KSD, boleh
     * tercatat tanpa mitra sama sekali). Baris bawaan yang dibiarkan kosong
     * karena itu tidak boleh menggagalkan penyimpanan. Baris yang terisi
     * sebagian tetap lolos ke validator supaya kesalahan isian tetap ketahuan.
     */
    protected function prepareForValidation(): void
    {
        $mitra = $this->input('mitra');

        if (! is_array($mitra)) {
            return;
        }

        $this->merge([
            'mitra' => collect($mitra)
                ->reject(fn ($baris) => is_array($baris) && collect($baris)->every(fn ($nilai) => blank($nilai)))
                ->values()
                ->all(),
        ]);
    }
}
