<?php

namespace Database\Seeders;

use App\Models\PerwakilanRi;
use Illuminate\Database\Seeder;

class PerwakilanRiSeeder extends Seeder
{
    /**
     * Perwakilan Republik Indonesia di luar negeri yang tercatat sebagai mitra
     * pada sheet Riwayat Diplomasi.
     *
     * Gabungan KbriSeeder, KjriSeeder, dan PtriSeeder setelah ketiga modulnya
     * disatukan atas arahan Kasubag (25 Sep 2026). Database yang sudah berjalan
     * dipindahkan lewat migration
     * 2026_09_25_110000_gabung_kbri_kjri_ptri_ke_tb_perwakilan_ri.
     *
     * Spreadsheet Biro KSD belum punya sheet khusus untuk jenis mitra ini.
     * Daftar di bawah DITURUNKAN dari kolom "Mitra" pada sheet Riwayat Diplomasi
     * (sebelumnya tersimpan di NonPerwakilanNegaraAsingSeeder):
     *   - KBRI Tokyo  -> sheet "Kunjungan (VI)", 1 baris
     *   - KBRI Bern   -> sheet "Audiensi (AU)", 1 baris
     *   - KJRI Mumbai -> sheet "Kolaborasi (KL)", 1 baris
     *   - PTRI        -> belum ada data di sheet manapun
     *
     * Nama tetap ditulis lengkap beserta jenisnya ("KBRI Tokyo", bukan
     * "Tokyo") — lihat docblock model PerwakilanRi.
     *
     * Koreksi data terhadap sheet acuan: baris "Rencana pelaksanaan
     * Jakarta-Mumbai (JAMU) 2026" pada sheet "Kolaborasi (KL)" menuliskan nama
     * mitra sebagai placeholder generik "Mitra Non-PNA". Perihal dan rangkuman
     * baris tersebut secara eksplisit menyebut Konsulat Jenderal RI di Mumbai
     * sebagai pihak pengaju, sehingga nama mitra dikoreksi menjadi "KJRI Mumbai".
     *
     * Catatan: "Misi Permanen Republik Indonesia untuk ASEAN" TIDAK dimasukkan
     * ke sini meski secara fungsi setara PTRI, karena sheet acuan Biro KSD
     * mengklasifikasikannya sebagai Misi Permanen Negara ASEAN - lihat
     * MisiPermanenAseanSeeder.
     *
     * URUTAN EKSEKUSI: WAJIB dijalankan sebelum seluruh seeder Riwayat Diplomasi,
     * karena seeder tersebut me-lookup id_mitra berdasarkan `nama_perwakilan_ri`.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_perwakilan_ri' => 'KBRI Tokyo',
                'tipe_perwakilan_ri' => 'KBRI',
                'keterangan' => 'Kedutaan Besar Republik Indonesia di Tokyo, Jepang. Mitra Biro Kerja Sama Daerah dalam penguatan kerja sama strategis Jakarta-Jepang di sektor investasi, infrastruktur, transportasi publik, dan pengelolaan lingkungan.',
                'is_active' => true,
            ],
            [
                'nama_perwakilan_ri' => 'KBRI Bern',
                'tipe_perwakilan_ri' => 'KBRI',
                'keterangan' => 'Kedutaan Besar Republik Indonesia di Bern, Swiss.',
                'is_active' => true,
            ],
            [
                'nama_perwakilan_ri' => 'KJRI Mumbai',
                'tipe_perwakilan_ri' => 'KJRI',
                'keterangan' => 'Konsulat Jenderal Republik Indonesia di Mumbai, India. Penggagas rangkaian Jakarta-Mumbai Update (JAMU) dan penjajakan hubungan Sister City antara Jakarta dan Mumbai.',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            PerwakilanRi::create($item);
        }
    }
}
