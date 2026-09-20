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

            # ---------------------------------------------------------------------------------------

            # Modul Riwayat Diplomasi - Kerjasama 
            KerjasamaSeeder::class,
            KolaborasiPart1Seeder::class,
            UndanganPart1Seeder::class,
            AudiensiPart1Seeder::class,
        ]);
    }
}
