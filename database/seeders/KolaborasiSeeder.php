<?php

namespace Database\Seeders;

use App\Models\Kolaborasi;
use App\Models\KedutaanBesar;
use Illuminate\Database\Seeder;

class KolaborasiSeeder extends Seeder
{
    public function run(): void
    {
        $jepang = KedutaanBesar::where('kode_negara', 'jp')->first();
        $amerika = KedutaanBesar::where('kode_negara', 'us')->first();
        $australia = KedutaanBesar::where('kode_negara', 'au')->first();
        $prancis = KedutaanBesar::where('kode_negara', 'fr')->first();
        $tiongkok = KedutaanBesar::where('kode_negara', 'cn')->first();

        $data = [
            [
                'id_kedutaan_besar' => $jepang->id_kedutaan_besar,
                'kolaborasi' => 'Pertukaran budaya dan festival Jepang di Jakarta.',
                'rangkuman' => 'Penyelenggaraan Jak-Japan Matsuri bersama Pemprov DKI.',
                'catatan' => 'Berlangsung setiap tahun, sudah rutin dilaksanakan.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-20',
                'tanggal_selesai' => null,
                'triwulan_kolaborasi' => 'TW I',
                'status_kolaborasi' => 'Berjalan',
                'nama_pic' => 'Andi Wijaya',
                'nomor_pic' => '0812-1000-1001',
            ],
            [
                'id_kedutaan_besar' => $amerika->id_kedutaan_besar,
                'kolaborasi' => 'Program beasiswa dan pelatihan kepemimpinan pemuda.',
                'rangkuman' => 'Kolaborasi dengan Kedubes AS untuk program YSEALI.',
                'catatan' => 'Peserta dari DKI Jakarta mengikuti program tahun ini.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2025-10-05',
                'tanggal_selesai' => '2026-04-05',
                'triwulan_kolaborasi' => 'TW IV',
                'status_kolaborasi' => 'Berjalan',
                'nama_pic' => 'Siti Rahmawati',
                'nomor_pic' => '0812-2000-2002',
            ],
            [
                'id_kedutaan_besar' => $australia->id_kedutaan_besar,
                'kolaborasi' => 'Kolaborasi riset perubahan iklim perkotaan.',
                'rangkuman' => 'Kerja sama riset dengan universitas di Australia.',
                'catatan' => 'Laporan riset sudah diserahkan dan dipublikasikan.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2025-05-15',
                'tanggal_selesai' => '2025-11-15',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => 'Budi Santoso',
                'nomor_pic' => '0812-3000-3003',
            ],
            [
                'id_kedutaan_besar' => $prancis->id_kedutaan_besar,
                'kolaborasi' => 'Kolaborasi festival film Prancis-Indonesia.',
                'rangkuman' => 'Pemutaran film dan diskusi budaya di Jakarta.',
                'catatan' => 'Ditunda ke tahun depan karena kendala jadwal venue.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2025-08-10',
                'tanggal_selesai' => null,
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Batal',
                'nama_pic' => 'Rina Kartika',
                'nomor_pic' => '0812-4000-4004',
            ],
            [
                'id_kedutaan_besar' => $tiongkok->id_kedutaan_besar,
                'kolaborasi' => 'Kolaborasi pengembangan smart city.',
                'rangkuman' => 'Studi banding sistem transportasi pintar.',
                'catatan' => 'Tahap kunjungan delegasi dan diskusi teknis.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-02-10',
                'tanggal_selesai' => null,
                'triwulan_kolaborasi' => 'TW I',
                'status_kolaborasi' => 'Berjalan',
                'nama_pic' => 'Dedi Kurniawan',
                'nomor_pic' => '0812-5000-5005',
            ],
        ];

        foreach ($data as $row) {
            Kolaborasi::create($row);
        }
    }
}
