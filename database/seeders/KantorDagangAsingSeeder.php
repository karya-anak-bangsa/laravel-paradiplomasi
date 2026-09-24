<?php

namespace Database\Seeders;

use App\Models\KantorDagangAsing;
use Illuminate\Database\Seeder;

class KantorDagangAsingSeeder extends Seeder
{
    /**
     * Kantor dagang/ekonomi asing di Jakarta yang tercatat sebagai mitra pada
     * sheet Riwayat Diplomasi.
     *
     * Spreadsheet Biro KSD belum punya sheet khusus untuk jenis mitra ini.
     * Daftar di bawah DITURUNKAN dari kolom "Mitra" pada sheet Riwayat Diplomasi
     * - sebelumnya tersimpan di NonPerwakilanNegaraAsingSeeder, lalu dipindah ke
     * sini setelah modul Kantor Dagang Asing dibuat atas arahan Kasubag:
     *   - Taipei Economic and Trade Office (TETO) -> sheet "Undangan (UD)", 1 baris
     *
     * Database yang sudah berjalan dipindahkan lewat migration
     * 2026_09_25_100002_pindahkan_teto_ke_tb_kantor_dagang_asing.
     *
     * URUTAN EKSEKUSI: WAJIB dijalankan sebelum seluruh seeder Riwayat Diplomasi,
     * karena seeder tersebut me-lookup id_mitra berdasarkan `nama_kantor_dagang_asing`.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kantor_dagang_asing' => 'Taipei Economic and Trade Office (TETO)',
                'keterangan' => 'Kantor perwakilan ekonomi dan dagang Taipei di Jakarta. Penanganan undangan dari kantor ini memerlukan kehati-hatian berkenaan dengan kebijakan One China Policy.',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            KantorDagangAsing::create($item);
        }
    }
}
