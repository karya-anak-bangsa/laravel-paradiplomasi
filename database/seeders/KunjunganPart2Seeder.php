<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KunjunganPart2Seeder extends Seeder
{
    /**
     * Sumber data: sheet "Kunjungan (VI)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - KHUSUS baris dengan mitra Non Perwakilan Negara Asing
     * (Hainan Provincial Department of Civil Affairs, KBRI Tokyo, Kementerian
     * Luar Negeri RI, Pemerintah Singapura, Pemerintah India, United Nations
     * Development Programme/UNDP).
     *
     * Modul/tabel Non Perwakilan Negara Asing BELUM DIBUAT pada skema saat ini
     * (lihat tabel Modul Mitra pada CLAUDE.md). Oleh karena itu, seeder ini
     * HANYA mendefinisikan $data sebagai draft/referensi mentah dan TIDAK
     * melakukan proses apa pun (tanpa foreach, tanpa lookup mitra, tanpa
     * insert ke database). Nama mitra dituliskan APA ADANYA sesuai kolom
     * "Mitra" pada sheet acuan.
     *
     * Setelah modul Non Perwakilan Negara Asing dibuat (tabel, model, dan
     * kolom identitas nama resminya), seeder ini perlu disesuaikan mengikuti
     * pola KunjunganPart1Seeder: lookup nama mitra -> id_mitra, lalu
     * Kunjungan::create() di dalam foreach dengan pengaman continue jika
     * mitra tidak ditemukan.
     */
    public function run(): void
    {
        $data = [
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
                'tanggal_diterima' => '12 Mei 2026',
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
    }
}
