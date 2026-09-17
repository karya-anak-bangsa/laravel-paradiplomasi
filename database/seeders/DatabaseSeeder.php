<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([

            # Cara Seeder Baru.
            KedutaanBesarSeeder::class,
            MisiAsingAseanSeeder::class,
            MisiPermanenAseanSeeder::class,

            # Cara Seeder Lama
            // KedutaanBesarPart1Seeder::class,
            // KedutaanBesarPart2Seeder::class,
            // KedutaanBesarPart3Seeder::class,
            // KedutaanBesarPart4Seeder::class,
            // KedutaanBesarPart5Seeder::class,
            // KedutaanBesarPart6Seeder::class,
            // KerjasamaSeeder::class,
            // KolaborasiSeeder::class,
            // UndanganSeeder::class,
            // AudiensiSeeder::class,
            // KunjunganSeeder::class,
        ]);
    }
}
