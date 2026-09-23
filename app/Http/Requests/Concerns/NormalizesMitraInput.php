<?php

namespace App\Http\Requests\Concerns;

trait NormalizesMitraInput
{
    /**
     * Buang baris mitra yang belum diisi sama sekali sebelum validasi.
     *
     * Form Acara DKI selalu menyediakan satu baris mitra kosong sebagai
     * kenyamanan pengisian, sementara mitra sendiri bersifat opsional (acara
     * yang batal/ditunda, atau yang datanya belum dikurasi Biro KSD, boleh
     * tercatat tanpa mitra sama sekali). Baris bawaan yang dibiarkan kosong
     * karena itu tidak boleh menggagalkan penyimpanan.
     *
     * Yang diperiksa hanya `id_mitra` dan `keterangan_kehadiran`:
     * `status_kehadiran` datang dari dropdown yang selalu punya opsi terpilih,
     * jadi nilainya bukan penanda bahwa baris sungguh diisi. Baris yang
     * keterangannya sudah ditulis tapi mitranya belum dipilih tetap lolos ke
     * validator supaya kesalahan isian itu ketahuan, bukan hilang diam-diam.
     */
    protected function prepareForValidation(): void
    {
        $mitra = $this->input('mitra');

        if (! is_array($mitra)) {
            return;
        }

        $this->merge([
            'mitra' => collect($mitra)
                ->reject(fn ($baris) => is_array($baris)
                    && blank($baris['id_mitra'] ?? null)
                    && blank($baris['keterangan_kehadiran'] ?? null))
                ->values()
                ->all(),
        ]);
    }
}
