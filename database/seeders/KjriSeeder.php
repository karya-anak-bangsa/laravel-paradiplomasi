<?php

namespace Database\Seeders;

use App\Models\Kjri;
use Illuminate\Database\Seeder;

class KjriSeeder extends Seeder
{
    /**
     * Konsulat Jenderal Republik Indonesia di luar negeri yang tercatat sebagai
     * mitra pada sheet Riwayat Diplomasi.
     *
     * Spreadsheet Biro KSD belum punya sheet khusus untuk jenis mitra ini.
     * Daftar di bawah DITURUNKAN dari kolom "Mitra" pada sheet Riwayat Diplomasi
     * - sebelumnya tersimpan di NonPerwakilanNegaraAsingSeeder, lalu dipindah ke
     * sini setelah modul KJRI dibuat:
     *   - KJRI Mumbai -> sheet "Kolaborasi (KL)", 1 baris
     *
     * Koreksi data terhadap sheet acuan: baris "Rencana pelaksanaan
     * Jakarta-Mumbai (JAMU) 2026" pada sheet "Kolaborasi (KL)" menuliskan nama
     * mitra sebagai placeholder generik "Mitra Non-PNA". Perihal dan rangkuman
     * baris tersebut secara eksplisit menyebut Konsulat Jenderal RI di Mumbai
     * sebagai pihak pengaju, sehingga nama mitra dikoreksi menjadi "KJRI Mumbai"
     * - placeholder generik tidak layak tersimpan sebagai record mitra karena
     * akan muncul apa adanya di dropdown pemilihan mitra.
     *
     * URUTAN EKSEKUSI: WAJIB dijalankan sebelum seluruh seeder Riwayat Diplomasi,
     * karena seeder tersebut me-lookup id_mitra berdasarkan `nama_kjri`.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kjri' => 'KJRI Mumbai',
                'keterangan' => 'Konsulat Jenderal Republik Indonesia di Mumbai, India. Penggagas rangkaian Jakarta-Mumbai Update (JAMU) dan penjajakan hubungan Sister City antara Jakarta dan Mumbai.',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            Kjri::create($item);
        }
    }
}
