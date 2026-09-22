<?php

namespace Database\Seeders;

use App\Models\Ptri;
use Illuminate\Database\Seeder;

class PtriSeeder extends Seeder
{
    /**
     * Perutusan Tetap Republik Indonesia pada organisasi internasional.
     *
     * BELUM ADA DATA. Modul PTRI dibuat atas arahan Kasubag mendahului
     * datanya - sampai saat ini tidak ada satu pun baris pada sheet Riwayat
     * Diplomasi (Kerja Sama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara
     * DKI) yang mitranya berupa PTRI, dan Biro KSD belum menyediakan sheet
     * khusus untuk jenis mitra ini.
     *
     * Seeder ini sengaja tetap dibuat (dengan $data kosong) dan didaftarkan di
     * DatabaseSeeder supaya slotnya jelas: begitu datanya tersedia, tinggal isi
     * array di bawah mengikuti pola KbriSeeder/KjriSeeder - tanpa perlu menebak
     * di mana data PTRI seharusnya ditempatkan.
     *
     * Catatan: "Misi Permanen Republik Indonesia untuk ASEAN" TIDAK dimasukkan
     * ke sini meski secara fungsi setara PTRI, karena sheet acuan Biro KSD
     * mengklasifikasikannya sebagai Misi Permanen Negara ASEAN - lihat
     * MisiPermanenAseanSeeder.
     */
    public function run(): void
    {
        $data = [];

        foreach ($data as $item) {
            Ptri::create($item);
        }
    }
}
