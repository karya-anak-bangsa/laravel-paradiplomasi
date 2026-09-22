<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([

            // Modul Kedutaan Besar
            KedutaanBesarPart1Seeder::class,
            KedutaanBesarPart2Seeder::class,
            KedutaanBesarPart3Seeder::class,
            KedutaanBesarPart4Seeder::class,
            KedutaanBesarPart5Seeder::class,
            KedutaanBesarPart6Seeder::class,
            KedutaanBesarPart7Seeder::class,
            KedutaanBesarPart8Seeder::class,
            KedutaanBesarPart9Seeder::class,
            KedutaanBesarPart10Seeder::class,
            KedutaanBesarPart11Seeder::class,

            // Modul Misi Asing dan Misi Permanen
            MisiAsingAseanSeeder::class,
            MisiPermanenAseanSeeder::class,

            // Modul mitra "nama + keterangan"
            // WAJIB sebelum seluruh seeder Riwayat Diplomasi di bawah, karena
            // seeder tersebut me-lookup id_mitra berdasarkan nama mitranya.
            NonPerwakilanNegaraAsingSeeder::class,
            PemprovDkiSeeder::class,
            KbriSeeder::class,
            KjriSeeder::class,
            PtriSeeder::class,

            // Modul Riwayat Diplomasi
            KerjasamaSeeder::class,
            KolaborasiSeeder::class,
            UndanganSeeder::class,
            AudiensiSeeder::class,
            KunjunganSeeder::class,
            AcaraDKISeeder::class,
        ]);
    }
}
