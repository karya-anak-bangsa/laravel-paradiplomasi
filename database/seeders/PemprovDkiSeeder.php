<?php

namespace Database\Seeders;

use App\Models\PemprovDki;
use Illuminate\Database\Seeder;

class PemprovDkiSeeder extends Seeder
{
    /**
     * Perangkat daerah di lingkungan Pemerintah Provinsi DKI Jakarta yang
     * tercatat sebagai mitra pada sheet Riwayat Diplomasi.
     *
     * Sama seperti Non-PNA, spreadsheet Biro KSD belum punya sheet khusus untuk
     * jenis mitra ini. Daftar di bawah DITURUNKAN dari kolom "Mitra" pada sheet
     * Riwayat Diplomasi - sebelumnya keduanya tersimpan di
     * NonPerwakilanNegaraAsingSeeder, lalu dipindah ke sini setelah modul
     * Pemerintah Provinsi DKI Jakarta dibuat:
     *   - Biro Kepala Daerah                    -> sheet "Audiensi (AU)", 3 baris
     *   - Badan Kesatuan Bangsa dan Politik     -> sheet "Kolaborasi (KL)", 1 baris
     *
     * URUTAN EKSEKUSI: WAJIB dijalankan sebelum seluruh seeder Riwayat Diplomasi,
     * karena seeder tersebut me-lookup id_mitra berdasarkan `nama_pemprov_dki`.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_pemprov_dki' => 'Biro Kepala Daerah',
                'keterangan' => 'Biro Kepala Daerah Setda Provinsi DKI Jakarta. Kerap meneruskan permohonan audiensi kepada Gubernur/Wakil Gubernur dan meminta pendampingan Biro Kerja Sama Daerah untuk tamu asing.',
                'is_active' => true,
            ],
            [
                'nama_pemprov_dki' => 'Badan Kesatuan Bangsa dan Politik',
                'keterangan' => 'Badan Kesatuan Bangsa dan Politik Provinsi DKI Jakarta. Pelaksana kegiatan diplomasi hijau penanaman mangrove bersama Rumah Rusia di Jakarta.',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            PemprovDki::create($item);
        }
    }
}
