<?php

namespace Database\Seeders\Concerns;

use App\Enums\TipeMitra;
use Illuminate\Database\Eloquent\Model;

/**
 * Pencarian id_mitra untuk seeder Riwayat Diplomasi.
 *
 * Array $data pada tiap seeder sengaja TIDAK menuliskan angka id_mitra secara
 * hardcode (rawan berubah kalau urutan seeder Mitra berubah). Sebagai gantinya
 * setiap baris menyimpan nama resmi mitra pada kolom identitas sesuai tipenya —
 * 'nama_kedutaan_besar_id', 'nama_perwakilan_ri', 'nama_pemprov_dki', dan seterusnya —
 * lalu trait ini menerjemahkannya menjadi id_mitra saat seeding.
 *
 * Kolom mana yang dikenali diturunkan dari TipeMitra::kolomNama(), sehingga
 * menambah jenis mitra baru tidak perlu menyentuh satu pun seeder Riwayat
 * Diplomasi. Sebelumnya tiap seeder memuat rantai if/elseif sendiri yang harus
 * disisir manual setiap ada tipe mitra baru.
 */
trait ResolvesMitra
{
    /**
     * Terjemahkan kolom nama mitra pada satu baris data seeder menjadi id_mitra,
     * sekaligus membuang kolom nama tersebut dari $item agar sisanya bisa
     * langsung dipakai sebagai atribut Model::create().
     *
     * Mengembalikan null bila baris tidak punya kolom nama mitra sama sekali,
     * atau mitranya tidak ditemukan di database (mis. seeder mitra belum
     * dijalankan, atau ejaan namanya berubah). Pemanggil WAJIB memeriksa null
     * dan melewati baris tersebut, supaya seeder tidak gagal total.
     */
    protected function ambilIdMitra(array &$item): ?int
    {
        foreach (TipeMitra::cases() as $tipe) {
            $kolom = $tipe->kolomNama();

            if (! array_key_exists($kolom, $item)) {
                continue;
            }

            $nama = $item[$kolom];
            unset($item[$kolom]);

            return $this->cariIdMitra($tipe->slug(), $nama);
        }

        return null;
    }

    /**
     * Cari id_mitra dari slug tipe mitra + nama resminya. Dipakai AcaraDKISeeder,
     * yang menuliskan mitra per acara sebagai pasangan ['type' => ..., 'nama' => ...]
     * karena satu acara bisa melibatkan banyak mitra dari tipe berbeda-beda.
     */
    protected function cariIdMitra(string $slug, string $nama): ?int
    {
        foreach (TipeMitra::cases() as $tipe) {
            if ($tipe->slug() !== $slug) {
                continue;
            }

            /** @var class-string<Model> $model */
            $model = $tipe->modelClass();

            return $model::query()->where($tipe->kolomNama(), $nama)->value('id_mitra');
        }

        return null;
    }
}
