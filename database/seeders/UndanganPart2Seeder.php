<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UndanganPart2Seeder extends Seeder
{
    /**
     * Sumber data: sheet "Undangan (UD)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - KHUSUS baris dengan mitra Non Perwakilan Negara Asing
     * (Persatuan Insinyur Indonesia, World Economic Forum, ITS Indonesia,
     * Persatuan Guru Republik Indonesia (PGRI), Taipei Economic and Trade
     * Office (TETO)).
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
     * pola UndanganPart1Seeder: lookup nama mitra -> id_mitra, lalu
     * Undangan::create() di dalam foreach dengan pengaman continue jika
     * mitra tidak ditemukan.
     *
     * Beberapa baris memiliki nilai tanggal_selesai bukan berupa tanggal
     * (mis. "Berjalan") - nilai tersebut dipertahankan apa adanya sesuai
     * sheet karena array ini belum divalidasi/dipetakan ke skema kolom
     * tb_undangan.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_non_perwakilan_negara_asing' => 'Persatuan Insinyur Indonesia',
                'acara' => '<p>Undangan Persatuan Insinyur Indonesia untuk menghadiri Stakeholders Networking World Engineering Day</p>',
                'rangkuman' => '<p>Melalui Surat No. 126/WED-PII/II/2026 tanggal 3 Februari 2026, Persatuan Insinyur Indonesia (PII) mengundang Gubernur untuk menghadiri Stakeholders Networking World Engineering Day 2026 Pada tanggal 04 Februari 2026</p><p>Acara ini dilaksanakan dalam rangka penyelenggaraan World Engineering Day for Sustainable Development 2026 (WED 2026) yang dilaksanakan pada tanggal 3–5 Maret 2026 di Jakarta dengan Persatuan Insinyur Indonesia (PII) sebagai penyelenggara, yang sekaligus merupakan Peluncuran (Launching) WED 2026 bersama Ketua Umum PII Dr.-Ing. Ir. Ilham Akbar Habibie, MBA, IPU., ASEAN Eng.</p><p>Acara telah dihadiri oleh Biro Kerja Sama Daerah.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-02-03',
                'tanggal_selesai' => '2026-02-04',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'World Economic Forum',
                'acara' => '<p>Undangan menghadiri World Economic Forum di Dalian, RRT</p>',
                'rangkuman' => '<p>Melalui surat tanggal 17 Maret 2026, Mr. Alois Zwingli, Presiden dan CEO World Economic Forum, beserta Mr. Maroun Kairouz, Managing Director World Economic Forum mengundang Gubernur DKI Jakarta untuk berpartisipasi dalam World Economic Forum tanggal 23 s.d. 25 Juni 2026 di Dalian, RRT.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-25',
                'tanggal_selesai' => '2026-03-25',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Regret',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'ITS Indonesia',
                'acara' => '<p>Permohonan audiensi Penyelenggara Indonesia International Transport Summit (IITS) 2026 kepada Gubernur DKI Jakarta, sekaligus undangan kepada Gubernur DKI Jakarta untuk hadir dan memberikan sambutan pada IITS 2026.</p>',
                'rangkuman' => '<p>President ITS Indonesia menyampaikan surat kepada Gubernur DKI Jakarta Nomor 145/SU/ITS-IND/PRES/VI/2026 tanggal 18 Juni 2026 perihal Permohonan Audiensi Penyelenggara Indonesia International Transport Summit (IITS) 2026, dan undangan kepada Gubernur DKI Jakarta untuk hadir dan memberikan sambutan.</p><p>Surat dimaksud telah didisposisi kepada Dinas Perhubungan, yang telah menyelenggarakan rapat Koordinasi tanggal 22 Juli 2026 Pukul 13:00 untuk menerima Audiensi President ITS Indonesia.</p><p>Acara telah dilaksanakan pada 26 s.d. 27 Agustus 2026.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-18',
                'tanggal_selesai' => '2026-08-27',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Persatuan Guru Republik Indonesia (PGRI)',
                'acara' => '<p>Permohonan audiensi, sekaligus undangan untuk menyampaikan Sambutan Selamat Datang, dan Permohonan Dukungan dan Tarian Pembukaan dan Penutupan pada The 10th Education International Asia Pacific (EIAP) Regional Conference</p>',
                'rangkuman' => '<p>Menindaklanjuti Surat Ketua Umum Pengurus Besar Persatuan Guru Republik Indonesia (PGRI) Nomor 586/Um/PB/XXIII/2026 tanggal 21 Juli 2026 kepada Gubernur DKI Jakarta serta menindaklanjuti audiensi antara Gubernur DKI Jakarta dengan Perwakilan Persatuan Guru Republik Indonesia (PGRI) pada tanggal 24 Juli 2026, disampaikan bahwa PGRI bermitra dengan Education International Asia Pacific (EIAP) untuk menyelenggarakan the 10th Education International Asia Pacific (EIAP) akan dilaksanakan pada tanggal 13–15 Oktober 2026.</p><p>Berkenaan dengan ini, Gubernur DKI Jakarta diharapkan dapat menyampaikan Sambutan Selamat Datang pada 19 Oktober, 09:00 WIB di Hotel Shangri-La Jakarta. Diharapkan juga agar Provinsi DKI Jakarta dapat memberikan dukungan berupa tarian pembukaan dan penutupan pada acara dimaksud.</p><p>Biro Kerja Sama Daerah telah melaksanakan rapat koordinasi pada tanggal 4 Agustus 2026, dengan hasil bahwa Dinas Kebudayaan akan mengupayakan dukungan tarian, Dinas PPKUKM akan mengupayakan dukungan booth UMKM, dan Dinas Pariwisata dan Ekonomi Kreatif akan mengupayakan dukungan City Tour.</p><p>Dukungan-dukungan dimaksud memerlukan surat permohonan dari PGRI.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-21',
                'tanggal_selesai' => 'Berjalan',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Taipei Economic and Trade Office (TETO)',
                'acara' => '<p>Undangan untuk menghadiri acara Double Tenth Day di Hotel Borobudur, Jakarta</p>',
                'rangkuman' => '<p>Taipei Economic and Trade Office (TETO) mengirimkan undangan untuk menghadiri Double Tenth Day pada tanggal 7 Oktober 2026 di Hotel Borobudur, Jakarta.</p><p>Double Tenth Day (10 Oktober) adalah Hari Nasional Taiwan yang memperingati Pemberontakan Wuchang tahun 1911. Peristiwa ini memicu Revolusi Xinhai yang menggulingkan Dinasti Qing dan melahirkan Republik Tiongkok. Hari libur ini dirayakan dengan upacara bendera, pidato kenegaraan, parade militer, pertunjukan budaya, dan pesta kembang api.</p><p>Berkenaan dengan kebijakan One China Policy, diperlukan kehati-hatian dalam menghadiri acara ini.</p><p>Gubernur Provinsi DKI Jakarta dikonfirmasi tidak hadir dan mengirimkan karangan bunga per 14 September 2026.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-09-04',
                'tanggal_selesai' => 'Berjalan',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
        ];
    }
}
