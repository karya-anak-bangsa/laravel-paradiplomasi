<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([

            # Modul Kedutaan Besar
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

            # Modul Misi Asing
            MisiAsingAseanSeeder::class,

            # Modul Misi Permanen
            MisiPermanenAseanSeeder::class,

            # Modul Diplomasi (Kerjasama - Kunjungan)
            KerjasamaSeeder::class,

            KolaborasiPart1Seeder::class,
            // KolaborasiPart2Seeder::class,


            UndanganPart1Seeder::class,
            // UndanganPart2Seeder::class,

            // AudiensiPart1Seeder::class,
            // AudiensiPart2Seeder::class,

            // KunjunganPart1Seeder::class,
            // KunjunganPart2Seeder::class,



        ]);
    }
}
