<?php

namespace Database\Seeders;

use App\Models\Kbri;
use Illuminate\Database\Seeder;

class KbriSeeder extends Seeder
{
    /**
     * Kedutaan Besar Republik Indonesia di luar negeri yang tercatat sebagai
     * mitra pada sheet Riwayat Diplomasi.
     *
     * Spreadsheet Biro KSD belum punya sheet khusus untuk jenis mitra ini.
     * Daftar di bawah DITURUNKAN dari kolom "Mitra" pada sheet Riwayat Diplomasi
     * - sebelumnya tersimpan di NonPerwakilanNegaraAsingSeeder, lalu dipindah ke
     * sini setelah modul KBRI dibuat:
     *   - KBRI Tokyo -> sheet "Kunjungan (VI)", 1 baris
     *   - KBRI Bern  -> sheet "Audiensi (AU)", 1 baris
     *
     * URUTAN EKSEKUSI: WAJIB dijalankan sebelum seluruh seeder Riwayat Diplomasi,
     * karena seeder tersebut me-lookup id_mitra berdasarkan `nama_kbri`.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kbri' => 'KBRI Tokyo',
                'keterangan' => 'Kedutaan Besar Republik Indonesia di Tokyo, Jepang. Mitra Biro Kerja Sama Daerah dalam penguatan kerja sama strategis Jakarta-Jepang di sektor investasi, infrastruktur, transportasi publik, dan pengelolaan lingkungan.',
                'is_active' => true,
            ],
            [
                'nama_kbri' => 'KBRI Bern',
                'keterangan' => 'Kedutaan Besar Republik Indonesia di Bern, Swiss.',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            Kbri::create($item);
        }
    }
}
