<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            KedutaanBesarPart1Seeder::class,
            KedutaanBesarPart2Seeder::class,
            // KedutaanBesarPart3Seeder::class,
            // KedutaanBesarPart4Seeder::class,
            // KedutaanBesarPart5Seeder::class,
            // KedutaanBesarPart6Seeder::class,
            // KerjasamaSeeder::class,
            // KolaborasiSeeder::class
        ]);
    }
}
