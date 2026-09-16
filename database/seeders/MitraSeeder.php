<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_mitra' => '1',
                'tipe_mitra' => 'Kedutaan Besar',
            ],
            [
                'id_mitra' => '2',
                'tipe_mitra' => 'Misi Asing untuk ASEAN',
            ],
            [
                'id_mitra' => '3',
                'tipe_mitra' => 'Misi Permanen Negara ASEAN',
            ],
            [
                'id_mitra' => '4',
                'tipe_mitra' => 'Non Perwakilan Negara Asing',
            ],
        ];

        foreach ($data as $item) {
            Mitra::create($item);
        }
    }
}
