<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AudiensiPart2Seeder extends Seeder
{
    /**
     * Sumber data: sheet "Audiensi (AU)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - KHUSUS baris dengan mitra Non Perwakilan Negara Asing
     * (KBRI Bern, Satria Putra/CEO Nusura Indonesia, Persatuan Guru Republik
     * Indonesia (PGRI), Menteri Luar Negeri Republik Indonesia, ITS Indonesia,
     * China Southwest Architecture, Biro Kepala Daerah, African Union
     * Commission).
     *
     * Modul/tabel Non Perwakilan Negara Asing BELUM DIBUAT pada skema saat ini
     * (lihat tabel Modul Mitra pada CLAUDE.md). Oleh karena itu, seeder ini
     * HANYA mendefinisikan $data sebagai draft/referensi mentah dan TIDAK
     * melakukan proses apa pun (tanpa foreach, tanpa lookup mitra, tanpa
     * insert ke database). Nama mitra dituliskan APA ADANYA sesuai kolom
     * "Mitra" pada sheet acuan (mis. tiga baris "Biro Kepala Daerah" tetap
     * dipertahankan sebagai nama mitra, bukan diganti dengan nama pihak yang
     * sesungguhnya disebut di topik/rangkuman).
     *
     * Setelah modul Non Perwakilan Negara Asing dibuat (tabel, model, dan
     * kolom identitas nama resminya), seeder ini perlu disesuaikan mengikuti
     * pola AudiensiPart1Seeder: lookup nama mitra -> id_mitra, lalu
     * Audiensi::create() di dalam foreach dengan pengaman continue jika
     * mitra tidak ditemukan.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_non_perwakilan_negara_asing' => 'KBRI Bern',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari KBRI Bern</p>',
                'rangkuman' => '<p>Melalui pemberitahuan dari Sekretariat Gubernur, KBRI Bern memohon Audiensi Kepada Gubernur DKI Jakarta</p><p>Audiensi dilaksanakan 4 Maret 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-03',
                'tanggal_selesai' => '2026-03-04',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Satria Putra, CEO Nusura Indonesia',
                'topik' => '<p>Permohonan Audiensi terkait Peluang Kerja Sama Strategis antara Pemerintah Provinsi DKI Jakarta dan Industri Republik Ceko</p>',
                'rangkuman' => '<p>Mealui Surat No. NUS/GOV/0002/07/28/2026 tanggal -- , Satria Putera, Chief Executive Officer Nusura Indonesia, menyampaikan permohonan untuk melaksanakan audiensi antara Gubernur DKI Jakarta dan delegasi Czech Indonesian Chamber of Industry and Trade (CICIT).</p><p>Permohonan dimaksud didisposisi kepada Asisten Perekonomian dan Keuangan, dan tidak dapat dilaksanakan karena keterbatasan waktu</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-06',
                'tanggal_selesai' => '2026-08-15',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Regret',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Persatuan Guru Republik Indonesia (PGRI)',
                'topik' => '<p>Permohonan audiensi, sekaligus undangan untuk menyampaikan Sambutan Selamat Datang, dan Permohonan Dukungan dan Tarian Pembukaan dan Penutupan pada The 10th Education International Asia Pacific (EIAP) Regional Conference</p>',
                'rangkuman' => '<p>Menindaklanjuti Surat Ketua Umum Pengurus Besar Persatuan Guru Republik Indonesia (PGRI) Nomor 586/Um/PB/XXIII/2026 tanggal 21 Juli 2026 kepada Gubernur DKI Jakarta serta menindaklanjuti audiensi antara Gubernur DKI Jakarta dengan Perwakilan Persatuan Guru Republik Indonesia (PGRI) pada tanggal 24 Juli 2026, disampaikan bahwa PGRI bermitra dengan Education International Asia Pacific (EIAP) untuk menyelenggarakan the 10th Education International Asia Pacific (EIAP) akan dilaksanakan pada tanggal 13–15 Oktober 2026.</p><p>Berkenaan dengan ini, Gubernur DKI Jakarta diharapkan dapat menyampaikan Sambutan Selamat Datang pada 19 Oktober, 09:00 WIB di Hotel Shangri-La Jakarta. Diharapkan juga agar Provinsi DKI Jakarta dapat memberikan dukungan berupa tarian pembukaan dan penutupan pada acara dimaksud.</p><p>Biro Kerja Sama Daerah telah melaksanakan rapat koordinasi pada tanggal 4 Agustus 2026, dengan hasil bahwa Dinas Kebudayaan akan mengupayakan dukungan tarian, Dinas PPKUKM akan mengupayakan dukungan booth UMKM, dan Dinas Pariwisata dan Ekonomi Kreatif akan mengupayakan dukungan City Tour.</p><p>Dukungan-dukungan dimaksud memerlukan surat permohonan dari PGRI.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-21',
                'tanggal_selesai' => '2026-07-24',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Menteri Luar Negeri Republik Indonesia',
                'topik' => '<p>Permohonan Audiensi Wakil Menteri Luar Negeri Bapak Anis Matta oleh Gubernur DKI Jakarta</p>',
                'rangkuman' => '<p>Melalui koordinasi dari Biro Kepala Daerah, Biro Kerja Sama Daerah dimohon untuk melaksanakan pendampingan terkait Permohonan Audiensi dari Wakil Menteri Luar Negeri RI, Anis Matta.</p><p>Di dalam diskusi, diketahui bahwa Kementerian Luar Negeri RI telah memberikan jawaban atas surat Pemerintah Provinsi DKI Jakarta No. 610/KR.03 tanggal 29 Oktober 2025 kepada Kementerian Luar Negeri RI, melalui Surat No. 783/BK/11/2025/04/01 dari Kementerian Luar Negeri Kepada Gubernur DKI Jakarta, yang pada dasarnya menyambut baik dan menyatakan dukungan berkenaan dengan rencana</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-20',
                'tanggal_selesai' => '2026-08-20',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'ITS Indonesia',
                'topik' => '<p>Permohonan audiensi Penyelenggara Indonesia International Transport Summit (IITS) 2026 kepada Gubernur DKI Jakarta, sekaligus undangan kepada Gubernur DKI Jakarta untuk hadir dan memberikan sambutan pada IITS 2026.</p>',
                'rangkuman' => '<p>President ITS Indonesia menyampaikan surat kepada Gubernur DKI Jakarta Nomor 145/SU/ITS-IND/PRES/VI/2026 tanggal 18 Juni 2026 perihal Permohonan Audiensi Penyelenggara Indonesia International Transport Summit (IITS) 2026, dan undangan kepada Gubernur DKI Jakarta untuk hadir dan memberikan sambutan.</p><p>Surat dimaksud telah didisposisi kepada Dinas Perhubungan, yang telah menyelenggarakan rapat Koordinasi tanggal 22 Juli 2026 Pukul 13:00 untuk menerima Audiensi President ITS Indonesia.</p><p>Acara telah dilaksanakan pada 26 s.d. 27 Agustus 2026.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-18',
                'tanggal_selesai' => '2026-08-27',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'China Southwest Architecture',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari China Southwest Architecture</p>',
                'rangkuman' => '<p>Melalui koordinasi kepada Biro Kepala Daerah, China Southwest Architecture memohon Audiensi kepada Gubernur DKI Jakarta untuk memaparkan konsep dan rencana proyek Pembangkit Listrik Tenaga Sampah.</p><p>Audiensi dilaksanakan 17 Juli 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-01',
                'tanggal_selesai' => '2026-07-17',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Biro Kepala Daerah',
                'topik' => '<p>Permohonan menerima audiensi Mr Alexander Feldman, Partner The Asia Group di Asia Tenggara, Ex President & CEO of the US-ASEAN Business Council</p>',
                'rangkuman' => '<p>Melalui koordinasi per WhatsApp, Biro Kepala Daerah menyampaikan kepada Biro Kerja Sama Daerah permohonan untuk mendampingi Gubernur DKI Jakarta dalam menerima Mr. Alexander Feldman (Partner The Asia Group di Asia Tenggara, Ex President & CEO of the US-ASEAN Business Council), yang akan diselenggarakan pada 30 Juni 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-29',
                'tanggal_selesai' => '2026-06-30',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Biro Kepala Daerah',
                'topik' => '<p>Permohonan menerima audiensi Mr. Ludy Suryantoro - Head of Unit for Multisectoral Engagement for Health Security WHO,</p>',
                'rangkuman' => '<p>Melalui Undangan No, 1182/HM.00.02 tanggal 12 Agustus 2026, Biro Kepala Daerah Mengundang Biro Kerja Sama Daerah untuk mendampingi Gubernur menerima Audiensi Mr. Ludy Suryantoro - Head of Unit for Multisectoral Engagement for Health Security WHO, pada hari Kamis, 13 Agustus 2026.</p><p>Audiensi telah dihadiri oleh Kepala Biro Kerja Sama Daerah.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-12',
                'tanggal_selesai' => '2026-08-13',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'African Union Commission',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari African Union Commission</p>',
                'rangkuman' => '<p>Melalui Surat No. 01635/BK/06/2026/04 tanggal 30 Juni 2026 kepada Biro Kerja Sama Daerah, Direktur Jenderal Asia Pasifik dan Afrika Kementerian Luar Negeri RI menyampaikan bahwa Delegasi Sekrettariat Uni Afrika/African Union Commission (AUC) bermaksud melakukan kunjungan resmi ke Jakarta pada tanggal 8 s.d. 10 Juli 2026, dan memohon agar delegasi dapat diterima oleh Gubernur DKI Jakarta.</p><p>Audiensi dilaksanalan pada 10 Juli 2026 dan diterima oleh Sekretaris Daerah Provinsi DKI Jakarta.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-30',
                'tanggal_selesai' => '2026-07-10',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Biro Kepala Daerah',
                'topik' => '<p>Audiensi Duta Besar Republik Indonesia untuk Kerajaan Swedia - KBRI Stockholm</p>',
                'rangkuman' => '<p>Melalui koordinasi lisan kepada Biro Kerja Sama Daerah, Biro Kepala Daerah memohon pendampingan untuk Audiensi Duta Besar RI di Swedia kepada Wakil Gubernur.</p><p>Pembahasan pada Audiensi meliputi:</p><p>1. Penjajakan Sister City Dki Jakarta Dengan Stockholm 2. Kemungkinan kerja sama Waste To Energy 3. Keikutsertaan Tim Seni Budaya DKI Jakarta Pada Indonesia Day 2027 di Stockholm</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-09-04',
                'tanggal_selesai' => '2026-09-07',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
        ];
    }
}
