<?php

namespace Database\Seeders;

use App\Models\PusatKebudayaanAsing;
use Illuminate\Database\Seeder;

class PusatKebudayaanAsingSeeder extends Seeder
{
    /**
     * Pusat kebudayaan asing di Jakarta.
     *
     * BELUM ADA DATA. Modul Pusat Kebudayaan Asing dibuat atas arahan Kasubag
     * mendahului datanya - sampai saat ini tidak ada satu pun baris pada sheet
     * Riwayat Diplomasi yang mitranya tercatat sebagai pusat kebudayaan asing,
     * dan Biro KSD belum menyediakan sheet khusus untuk jenis mitra ini.
     *
     * Seeder ini sengaja tetap dibuat (dengan $data kosong) dan didaftarkan di
     * DatabaseSeeder supaya slotnya jelas: begitu datanya tersedia, tinggal isi
     * array di bawah mengikuti pola KantorDagangAsingSeeder.
     *
     * Catatan: kolaborasi Fete de la Musique yang diajukan Institut Francais
     * d'Indonesie (IFI) TIDAK dipindah ke sini, karena sheet "Kolaborasi (KL)"
     * mencatat mitranya sebagai Kedutaan Besar Perancis - lihat KolaborasiSeeder.
     */
    public function run(): void
    {
        $data = [];

        foreach ($data as $item) {
            PusatKebudayaanAsing::create($item);
        }
    }
}
