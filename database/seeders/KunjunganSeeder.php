<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kunjungan;

class KunjunganSeeder extends Seeder
{
    // id_kedutaan_besar di bawah ini mengikuti urutan insert KedutaanBesarPart1-6Seeder
    // JANGAN ubah urutan/isi seeder Kedutaan Besar tanpa menyesuaikan id di sini
    // Sumber data: Google Sheet Kasubag, tab Kunjungan
    // Hanya 1 baris valid untuk saat ini (mitra literal 'Kedutaan Besar X'); baris lain
    // ('Pemerintah Singapura', 'Pemerintah India', KBRI Tokyo, dll) menunggu konfirmasi Kasubag
    // perihal/rangkuman/catatan WYSIWYG: tiap baris baru di cell sheet jadi <p> terpisah
    public function run(): void
    {
        $data = [
            [
                'id_kedutaan_besar' => 34, // Kedutaan Besar India
                'perihal' => '<p>Kunjungan Duta Besar India ke Kepulauan Seribu</p>',
                'rangkuman' => '<p>Berdasarkan Surat Duta Besar India No. NV/JAK/AMB/05/2026 tanggal 18 Maret 2026 kepada Kepala Biro Kerja Sama Daerah, disampaikan bahwa Duta Besar India akan mengunjungi Kepulauan Seribu.</p><p>Kunjungan tersebut disertai oleh rombongan pengusaha dari India dan Indonesia berjumlah 20 (dua puluh) orang, sesuai daftar nama dan jadwal sebagaimana terlampir. Berdasarkan koordinasi lanjutan yang dilaksanakan dengan Direktorat Fasilitasi Diplomatik Kementerian Luar Negeri Republik Indonesia serta narahubung Kedutaan Besar India, disampaikan bahwa kegiatan tersebut bukan termasuk kunjungan dinas, dan merupakan pertama kalinya Duta Besar India untuk Indonesia melaksanakan kunjungan ke Kepulauan Seribu.</p><p>Biro Kerja Sama Daerah telah mengirimkan surat kepada Bupati Kepulauan Seribu, Kepala Satpol PP Provinsi DKI Jakarta, Dinas Perhubungan Provinsi DKI Jakarta, Dinas Oenanggulangan Kebakaran dan Penyelamatan DKI Jakarta, serta Dinas Kesehatan Provinsi DKI Jakarta untuk memantau kunjungan tersebut.</p><p>Kunjungan telah dilaksanakan pada 25 Maret 2026.</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-03-19',
                'tanggal_selesai' => '2026-03-25',
                'triwulan_kunjungan' => 'TW I',
                'status_kunjungan' => 'Selesai',
                'nama_pic' => 'Narahubung rombongan : Mr. Sachin Gopalan,  Narahubung dermaga : Mr. Rudi  Narahubung koord admin : Ms. Andhini Kristi',
                'nomor_pic' => '+62 819-0803-8130, +62 852-8279-0783, +62 896-2442-9453',
            ],
        ];

        foreach ($data as $item) {
            Kunjungan::create($item);
        }
    }
}
