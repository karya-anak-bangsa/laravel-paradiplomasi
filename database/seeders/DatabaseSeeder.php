<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([

            # Cara Seeder Baru.
            KedutaanBesarSeeder::class,     // akan diaktifkan di langkah 2
            MisiAsingAseanSeeder::class,    // langkah 3
            MisiPermanenNegaraAseanSeeder::class, // langkah 4

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
