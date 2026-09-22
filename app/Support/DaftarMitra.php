<?php

namespace App\Support;

use App\Enums\TipeMitra;
use Illuminate\Database\Eloquent\Model;

/**
 * Penyedia daftar mitra aktif per tipe untuk dropdown pemilihan mitra di form
 * (x-mitra-picker pada 5 modul Riwayat Diplomasi, dan pemilih multi-mitra pada
 * form Acara DKI).
 *
 * Sebelumnya tiap controller Riwayat Diplomasi punya method daftarMitraAktif()
 * sendiri yang menyebut satu per satu model subtype, lalu meneruskannya sebagai
 * satu variabel per tipe ke view. Pola itu berarti setiap penambahan jenis mitra
 * harus disisir ke 6 controller + 6 view + komponen picker. Kelas ini
 * menggantinya dengan SATU struktur yang diturunkan dari TipeMitra, sehingga
 * jenis mitra baru otomatis ikut muncul tanpa menyentuh controller/view manapun.
 */
class DaftarMitra
{
    /**
     * Daftar mitra aktif dikelompokkan per tipe, siap dipakai sebagai sumber
     * <option> dropdown. Value tiap opsi adalah `id_mitra` (bukan primary key
     * subtype), karena itulah yang disimpan di kolom id_mitra modul Riwayat
     * Diplomasi.
     *
     * @return array<string, array{label: string, opsi: list<array{id: string, text: string}>}>
     */
    public static function aktifPerTipe(): array
    {
        $daftar = [];

        foreach (TipeMitra::cases() as $tipe) {
            /** @var class-string<Model> $model */
            $model = $tipe->modelClass();

            // Mitra berbasis negara dilabeli nama negaranya (mis. "Australia"),
            // sisanya dilabeli nama resminya (mis. "KBRI Tokyo").
            $kolomLabel = $tipe->berbasisNegara() ? 'nama_negara' : $tipe->kolomNama();

            $daftar[$tipe->slug()] = [
                'label' => $tipe->value,
                'opsi' => $model::query()
                    ->where('is_active', true)
                    ->orderBy($kolomLabel)
                    ->get(['id_mitra', $kolomLabel])
                    ->map(fn ($mitra) => [
                        'id' => (string) $mitra->id_mitra,
                        'text' => $mitra->{$kolomLabel},
                    ])
                    ->all(),
            ];
        }

        return $daftar;
    }
}
