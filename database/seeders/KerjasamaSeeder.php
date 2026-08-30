<?php

namespace Database\Seeders;

use App\Models\Kerjasama;
use App\Models\KedutaanBesar;
use Illuminate\Database\Seeder;

class KerjasamaSeeder extends Seeder
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
                'pengaduan' => 'Permohonan kerjasama sister city dengan Kota Yokohama.',
                'rangkuman' => 'Kerjasama bidang pengelolaan sampah dan lingkungan perkotaan.',
                'catatan' => 'Dalam tahap penjajakan MoU.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-15',
                'tanggal_selesai' => null,
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => 'Andi Wijaya',
                'nomor_pic' => '0812-1000-1001',
            ],
            [
                'id_kedutaan_besar' => $amerika->id_kedutaan_besar,
                'pengaduan' => 'Program pertukaran pelajar tingkat SMA.',
                'rangkuman' => 'Kerjasama pendidikan dengan beberapa sekolah di Jakarta.',
                'catatan' => 'Sudah ditandatangani, dalam tahap pelaksanaan.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2025-11-02',
                'tanggal_selesai' => '2026-11-02',
                'triwulan_kerjasama' => 'TW IV',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => 'Siti Rahmawati',
                'nomor_pic' => '0812-2000-2002',
            ],
            [
                'id_kedutaan_besar' => $australia->id_kedutaan_besar,
                'pengaduan' => 'Kerjasama pelatihan tenaga kerja terampil.',
                'rangkuman' => 'Program vokasi bidang teknologi informasi.',
                'catatan' => 'Selesai dilaksanakan, laporan akhir sudah diserahkan.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2025-06-10',
                'tanggal_selesai' => '2025-12-20',
                'triwulan_kerjasama' => 'TW II',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => 'Budi Santoso',
                'nomor_pic' => '0812-3000-3003',
            ],
            [
                'id_kedutaan_besar' => $prancis->id_kedutaan_besar,
                'pengaduan' => 'Kerjasama pameran seni dan budaya.',
                'rangkuman' => 'Pameran seni rupa kontemporer Indonesia-Prancis.',
                'catatan' => 'Dibatalkan karena kendala anggaran.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2025-09-01',
                'tanggal_selesai' => null,
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Batal',
                'nama_pic' => 'Rina Kartika',
                'nomor_pic' => '0812-4000-4004',
            ],
            [
                'id_kedutaan_besar' => $tiongkok->id_kedutaan_besar,
                'pengaduan' => 'Kerjasama investasi infrastruktur transportasi.',
                'rangkuman' => 'Studi kelayakan proyek MRT fase lanjutan.',
                'catatan' => 'Masih tahap studi kelayakan bersama Bappeda.',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-02-01',
                'tanggal_selesai' => null,
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => 'Dedi Kurniawan',
                'nomor_pic' => '0812-5000-5005',
            ],
        ];

        foreach ($data as $row) {
            Kerjasama::create($row);
        }

        foreach ($data as $row) {
            Kerjasama::create($row);
        }

        foreach ($data as $row) {
            Kerjasama::create($row);
        }

        foreach ($data as $row) {
            Kerjasama::create($row);
        }
    }
}
