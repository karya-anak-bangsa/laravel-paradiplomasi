<?php

namespace Database\Seeders;

use App\Models\Kunjungan;
use App\Models\KedutaanBesar;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use Illuminate\Database\Seeder;

class KunjunganPart1Seeder extends Seeder
{
    /**
     * Sumber data: sheet "Kunjungan (VI)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - KHUSUS baris dengan mitra Kedutaan Besar, Misi Asing untuk
     * ASEAN, dan Misi Permanen ASEAN (modul mitra yang sudah tersedia).
     *
     * Baris dengan mitra Non Perwakilan Negara Asing (mis. Hainan Provincial
     * Department of Civil Affairs, KBRI Tokyo, Kementerian Luar Negeri RI,
     * Pemerintah Singapura, Pemerintah India, UNDP) TIDAK disimpan di sini
     * karena modul/tabel Non Perwakilan Negara Asing belum dibuat - lihat
     * KunjunganPart2Seeder.
     *
     * PENTING - relasi ke mitra:
     * Migration tb_kunjungan tetap menggunakan SATU kolom foreign key
     * `id_mitra` (mengarah ke tb_mitra, tabel supertype generalisasi-spesialisasi
     * dari KedutaanBesar / MisiAsingAsean / MisiPermanenAsean). Agar seeder ini
     * tidak bergantung pada urutan insert tb_mitra, array $data di bawah TIDAK
     * menuliskan angka id_mitra secara hardcode - setiap baris menyimpan nama
     * resmi mitra sesuai kolom identitasnya masing-masing
     * (nama_kedutaan_besar_id / nama_misi_asing_asean_id /
     * nama_misi_permanen_asean_id), mengikuti ejaan resmi pada seeder mitra
     * terkait (bukan istilah bebas pada sheet acuan). Nama tersebut kemudian
     * di-lookup ke tabel anak terkait untuk mengambil `id_mitra` (kolom yang
     * sudah ada langsung di tabel anak). Baris yang mitra-nya tidak ditemukan
     * akan di-skip (continue) agar seeder tidak gagal total.
     *
     * Field yang sengaja dikosongkan sesuai arahan: file_dokumen, nama_pic,
     * nomor_pic. Kolom catatan diseragamkan menjadi placeholder instruksi
     * untuk operator, menggantikan catatan tindak lanjut asli pada sheet.
     * Kolom "Data" (kode referensi dokumen internal) dan "Kontak" pada sheet
     * tidak disimpan karena tidak ada padanan kolom pada skema tb_kunjungan.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar India',
                'perihal' => '<p>Kunjungan Duta Besar India ke Kepulauan Seribu</p>',
                'rangkuman' => '<p>Berdasarkan Surat Duta Besar India No. NV/JAK/AMB/05/2026 tanggal 18 Maret 2026 kepada Kepala Biro Kerja Sama Daerah, disampaikan bahwa Duta Besar India akan mengunjungi Kepulauan Seribu.</p><p>Kunjungan tersebut disertai oleh rombongan pengusaha dari India dan Indonesia berjumlah 20 (dua puluh) orang, sesuai daftar nama dan jadwal sebagaimana terlampir. Berdasarkan koordinasi lanjutan yang dilaksanakan dengan Direktorat Fasilitasi Diplomatik Kementerian Luar Negeri Republik Indonesia serta narahubung Kedutaan Besar India, disampaikan bahwa kegiatan tersebut bukan termasuk kunjungan dinas, dan merupakan pertama kalinya Duta Besar India untuk Indonesia melaksanakan kunjungan ke Kepulauan Seribu.</p><p>Biro Kerja Sama Daerah telah mengirimkan surat kepada Bupati Kepulauan Seribu, Kepala Satpol PP Provinsi DKI Jakarta, Dinas Perhubungan Provinsi DKI Jakarta, Dinas Oenanggulangan Kebakaran dan Penyelamatan DKI Jakarta, serta Dinas Kesehatan Provinsi DKI Jakarta untuk memantau kunjungan tersebut.</p><p>Kunjungan telah dilaksanakan pada 25 Maret 2026.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-19',
                'tanggal_selesai' => '2026-03-25',
                'triwulan_kunjungan' => 'TW I',
                'status_kunjungan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Vietnam',
                'perihal' => '<p>Rencana kunjungan Ho Chi MInh Nationak Academy of Politics dan Permohonan Pertemuan dengan OPD Terkait pada tanggal 28 September 2026</p>',
                'rangkuman' => '<p>Melalui Surat No 305/SQ/2026 tanggal 8 September 2026 kepada Sekretaris Daerah Provinsi DKI Jakarta, Kedutaan Besar Republik Sosialis Vietnam menyampaikan bahwa Ho Chi Minh National Academy of Politics berencana mengirimkan delegasi beranggotakan enam orang untuk melakukan kunjungan studi dan penelitian ke Indonesia pada 27–30 September 2026. Kunjungan ini berfokus pada promosi Partisipasi Warga dalam Tata Kelola Lingkungan di Vietnam dan diketuai Associate Professor Dr. Le Van Chien, Direktur Institute of Leadership and Public Policy.</p><p>Delegasi ingin mengadakan pertemuan dengan instansi terkait dari Pemerintah Daerah Khusus Ibukota Jakarta pada pagi hari tanggal 28 September 2026 untuk bertukar pandangan mengenai isu tersebut.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-09-09',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_kunjungan' => 'TW III',
                'status_kunjungan' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
        ];

        foreach ($data as $item) {
            $idMitra = null;

            if (array_key_exists('nama_kedutaan_besar_id', $item)) {
                $mitra = KedutaanBesar::where('nama_kedutaan_besar_id', $item['nama_kedutaan_besar_id'])->first();
                $idMitra = $mitra?->id_mitra;
                unset($item['nama_kedutaan_besar_id']);
            } elseif (array_key_exists('nama_misi_asing_asean_id', $item)) {
                $mitra = MisiAsingAsean::where('nama_misi_asing_asean_id', $item['nama_misi_asing_asean_id'])->first();
                $idMitra = $mitra?->id_mitra;
                unset($item['nama_misi_asing_asean_id']);
            } elseif (array_key_exists('nama_misi_permanen_asean_id', $item)) {
                $mitra = MisiPermanenAsean::where('nama_misi_permanen_asean_id', $item['nama_misi_permanen_asean_id'])->first();
                $idMitra = $mitra?->id_mitra;
                unset($item['nama_misi_permanen_asean_id']);
            }

            if (!$idMitra) {
                continue;
            }

            Kunjungan::create([
                'id_mitra' => $idMitra,
                ...$item,
                'is_active' => true,
            ]);
        }
    }
}
