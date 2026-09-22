<?php

namespace Database\Seeders;

use App\Models\KedutaanBesar;
use App\Models\Kunjungan;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use App\Models\NonPerwakilanNegaraAsing;
use Illuminate\Database\Seeder;

class KunjunganSeeder extends Seeder
{
    /**
     * Sumber data: sheet "Kunjungan (VI)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - SELURUH baris, mencakup keempat jenis mitra.
     *
     * Seeder ini adalah hasil penggabungan KunjunganPart1Seeder (mitra Kedutaan
     * Besar, Misi Asing untuk ASEAN, Misi Permanen ASEAN) dan KunjunganPart2Seeder
     * (mitra Non Perwakilan Negara Asing). Pemisahan Part1/Part2 dahulu diperlukan
     * karena modul Non Perwakilan Negara Asing belum dibuat, sehingga data Part2
     * hanya berstatus draft dan tidak pernah di-insert. Modul tersebut kini sudah
     * tersedia beserta seeder mitranya (NonPerwakilanNegaraAsingSeeder), sehingga
     * kedua bagian digabung menjadi satu seeder per modul.
     *
     * PENTING - relasi ke mitra:
     * Migration tb_kunjungan tetap menggunakan SATU kolom foreign key
     * `id_mitra` (mengarah ke tb_mitra, tabel supertype generalisasi-spesialisasi
     * dari KedutaanBesar / MisiAsingAsean / MisiPermanenAsean /
     * NonPerwakilanNegaraAsing). Agar seeder ini tidak bergantung pada urutan
     * insert tb_mitra, array $data di bawah TIDAK menuliskan angka id_mitra secara
     * hardcode - setiap baris menyimpan nama resmi mitra sesuai kolom identitasnya
     * masing-masing (nama_kedutaan_besar_id / nama_misi_asing_asean_id /
     * nama_misi_permanen_asean_id / nama_non_perwakilan_negara_asing), mengikuti
     * ejaan resmi pada seeder mitra terkait (bukan istilah bebas pada sheet acuan).
     * Nama tersebut kemudian di-lookup ke tabel anak terkait untuk mengambil
     * `id_mitra` (kolom yang sudah ada langsung di tabel anak). Baris yang
     * mitra-nya tidak ditemukan akan di-skip (continue) agar seeder tidak gagal
     * total.
     *
     * Normalisasi data Part2 terhadap skema tb_kunjungan (data Part2 sebelumnya
     * berupa draft mentah dan belum pernah divalidasi ke kolom):
     *   - Baris KBRI Tokyo: tanggal_diterima pada sheet tertulis "12 Mei 2026"
     *     (format teks bebas) -> dinormalisasi menjadi '2026-05-12' agar dapat
     *     disimpan pada kolom bertipe date.
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
            [
                'nama_non_perwakilan_negara_asing' => 'Hainan Provincial Department of Civil Affairs',
                'perihal' => '<p>Permohonan fasilitasi dan koordinasi kunjungan Hainan Provincial Department of Civil Affairs dari Dinas Sosial</p>',
                'rangkuman' => '<p>Dinas Sosial menerima surat tanggal 12 April 2026 dari Hainan Provinsial Department of Civil Affairs yang memohon melaksanakan kunjungan ke Dinas Sosial pada tanggal 10 Juni 2026. Berkenaan dengan ini, Biro Kerja Sama Daerah dimohon untuk memfasilitasi kunjungan tersebut.</p><p>Kunjungan telah ditangani oleh Sub-Kelompok Kerja Sama Pemerintah Daerah Luar Negeri</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-12',
                'tanggal_selesai' => '2026-06-10',
                'triwulan_kunjungan' => 'TW II',
                'status_kunjungan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'KBRI Tokyo',
                'perihal' => '<p>Kunjungan Duta Besar Indonesia untuk Jepang ke Jakarta.</p>',
                'rangkuman' => '<p>Pemerintah Provinsi DKI Jakarta mengundang Duta Besar Indoesia untuk Jepang untuk berkunjung ke Jakarta sebagai bagian dari upaya penguatan kerja sama strategis Jakarta–Jepang di berbagai sektor prioritas.</p><p>Berdasarkan komunikasi dengan KBRI Tokyo, kegiatan direncanakan berupa kunjungan ke lokasi-lokasi proyek infrastruktur Jakarta yang potensial, baik dari sektor investasi, infrastruktur, transportasi publik, pengembangan kota, transformasi pemerintahan digital, pengelolaan lingkungan, dan ketahanan pesisir.</p><p>Persetujuan pelaksanaan kegiatan telah disampaikan melalui Nota Dinas Kepala Biro Kerja Sama Daerah kepada Sekretaris Daerah Provinsi DKI Jakarta No. 17/UD.02.02 tanggal 29 Mei 2026.</p><p>Rangkaian agenda yang diusulkan meliputi Pertemuan bilateral dengan Gubernur DKI Jakarta, Forum inovasi perkotaan dan kemitraan strategis, Kunjungan lapangan ke TPST Bantar Gebang terkait pengolahan sampah menjadi energi, serta Diskusi pengembangan Giant Sea Wall Jakarta.</p><p>Kegiatan telah dilaksanakan 4 s.d. 6 Juni 2026. Duta Besar RI untuk Jepang menyampaikan terima kasih melalui Surat No. 82/EKON/vI/2026 Tanggal 9 Juni 2026.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-05-12',  // sheet: "12 Mei 2026"
                'tanggal_selesai' => '2026-06-09',
                'triwulan_kunjungan' => 'TW II',
                'status_kunjungan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Kementerian Luar Negeri RI',
                'perihal' => '<p>Dukungan terhadap penyambutan Kunjungan Presiden Belarusia ke Jakarta</p>',
                'rangkuman' => '<p>Berdasarkan Surat surat Direktur Protokol Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri RI Nomor 07757/PK/06/2026/65 tanggal 22 Juni 2026 kepada Gubernur DKI Jakarta, dan disposisi Sekretaris Daerah Provinsi DKI Jakarta Nomor 004739/JKT/2026 tanggal 26 Juni 2026 atas Nota Dinas Kepala Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta Nomor e-0038/HM.03.00 tanggal 25 Juni 2026, Kementerian Luar Negeri RI memohon dukungan Terkait Kunjungan Kenegaraan Presiden Republik Belarus ke Indonesia pada tanggal 1 s. d. 2 Juli 2026.</p><p>Biro Kerja Sama Daerah telah membuat Surat Dukungan No e-0127 HM/03.00 tanggal 30 Juni 2026 kepada Dinas Komunikasi, Informatika, dan Statistik, No e-0122 HM/03.00 tanggal 30 Juni 2026 kepada Dinas Pendidikan, No e-0123 HM/03.00 tanggal 30 Juni 2026 kepada Walikota Jakarta Pusat, No e-0124 HM/03.00 tanggal 30 Juni 2026 kepada Dinas Pertamanan dan Hutan Kota, dan No e-0125 HM/03.00 tanggal 30 Juni 2026 kepada Dinas Kebudayaan, untuk memberikan dukungan sesuai permohonan.</p><p>Dukungan telah dilaksanakan.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-29',
                'tanggal_selesai' => '2026-07-02',
                'triwulan_kunjungan' => 'TW II',
                'status_kunjungan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Pemerintah Singapura',
                'perihal' => '<p>Kunjungan Kerja Perdana Menteri Singapura</p>',
                'rangkuman' => '<p>Melalui Koordinasi dengan Kementerian Luar Negeri RI, diketahui Perdana Menteri Singapura akan melaksanakan kunjungan kerja pada tanggal 5 s.d. 6 Juli 2026.</p><p>Kementerian Luar Negeri RI memohon dukungan penyambutan.</p><p>Biro Kerja Sama Daerah telah membuat Nota Dinas Kepada Sekretaris Daerah DKI Jakarta No. e-0054/HM.03.00 tanggal 4 Juli 2026.</p><p>Dukungan telah dilaksanakan 5 Juli 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-04',
                'tanggal_selesai' => '2026-07-05',
                'triwulan_kunjungan' => 'TW III',
                'status_kunjungan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Pemerintah India',
                'perihal' => '<p>Kunjungan Kenegaraan Perdana Menteri India</p>',
                'rangkuman' => '<p>08141/PK/06/2026/65, Jakarta, 29 Juni 2026 Kunjungan Kenegaraan Perdana Menteri Republik India ke Indonesia, 6-8 Juli 2026</p><p>Kementerian Luar Negeri RI memohon dukungan penyambutan.</p><p>Biro Kerja Sama Daerah telah membuat Nota Dinas Kepada Sekretaris Daerah DKI Jakarta No. e-0054/HM.03.00 tanggal 4 Juli 2026.</p><p>Dukungan telah dilaksanakan pada tanggal 6 Juli 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-04',
                'tanggal_selesai' => '2026-07-06',
                'triwulan_kunjungan' => 'TW III',
                'status_kunjungan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'United Nations Development Programme (UNDP)',
                'perihal' => '<p>Kunjungan oleh HRH Victoria, Putri Mahkota Swedia, ke Masjid Istiqllal dan Gereja Katedral.</p>',
                'rangkuman' => '<p>Melalui Surat No, Reference no.: PROG/IDN/024/08/2026 tanggal 14 Agustus 2026, United Nations Development Programme (UNDP) mengirimkan surat kepada Gubernur DKI Jakarta untuk memohon pendampinganterhadap HRH Victoria, Putri Mahkota Swedia, yang sedang menjalankan kapasitasnya sebagai Duta Niat Baik (Goodwill Ambassador) UNDP pada tanggal 4 September 2026 dari pukul 16:35 s.d. 17:45.</p><p>Pendampingan telah dilaksanakan oleh Bagian Kerja Sama Luar Negeri Biro Kerja Sama Daerah.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kunjungan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-09-03',
                'tanggal_selesai' => '2026-09-04',
                'triwulan_kunjungan' => 'TW III',
                'status_kunjungan' => 'Selesai',
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
            } elseif (array_key_exists('nama_non_perwakilan_negara_asing', $item)) {
                $mitra = NonPerwakilanNegaraAsing::where('nama_non_perwakilan_negara_asing', $item['nama_non_perwakilan_negara_asing'])->first();
                $idMitra = $mitra?->id_mitra;
                unset($item['nama_non_perwakilan_negara_asing']);
            }

            if (! $idMitra) {
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
