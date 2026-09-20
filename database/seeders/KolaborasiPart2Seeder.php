<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KolaborasiPart2Seeder extends Seeder
{
    /**
     * Sumber data: sheet "Kolaborasi (KL)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - KHUSUS baris dengan mitra Non Perwakilan Negara Asing
     * (mis. Stuttgart Philharmonic Orchestra, Persatuan Guru Republik Indonesia
     * (PGRI), Keluarga Pelajar Jakarta (KPJ) Mesir, 5P Global Movement, AIESEC
     * Indonesia, dan nama mitra lain yang tidak mengikuti pola penamaan
     * "Kedutaan ...", "Misi Asing ...", atau "Misi Permanen ...").
     *
     * Modul/tabel Non Perwakilan Negara Asing BELUM DIBUAT pada skema saat ini
     * (lihat tabel Modul Mitra pada CLAUDE.md). Oleh karena itu, seeder ini
     * HANYA mendefinisikan $data sebagai draft/referensi mentah dan TIDAK
     * melakukan proses apa pun (tanpa foreach, tanpa lookup mitra, tanpa
     * insert ke database). Nama mitra dituliskan APA ADANYA sesuai kolom
     * "Mitra" pada sheet acuan, tanpa dikoreksi terhadap isi rangkuman
     * (mis. baris "Mitra Non-PNA" dan "Badan Kesatuan Bangsa dan Politik"
     * tetap dipertahankan sebagai nama mitra, bukan diganti dengan nama pihak
     * yang disebut di rangkuman, seperti KJRI Mumbai atau Rumah Rusia di
     * Jakarta).
     *
     * Setelah modul Non Perwakilan Negara Asing dibuat (tabel, model, dan
     * kolom identitas nama resminya), seeder ini perlu disesuaikan mengikuti
     * pola KolaborasiPart1Seeder: lookup nama mitra -> id_mitra, lalu
     * Kolaborasi::create() di dalam foreach dengan pengaman continue jika
     * mitra tidak ditemukan.
     *
     * Beberapa baris memiliki nilai tanggal_selesai bukan berupa tanggal
     * (mis. "Berjalan", "Batal", "Dialihkan ke Sub-Kelompok Kerjasama
     * Pemerintah Daerah Dalam Negeri") - nilai tersebut dipertahankan apa
     * adanya sesuai sheet karena array ini belum divalidasi/dipetakan ke
     * skema kolom tb_kolaborasi.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_non_perwakilan_negara_asing' => 'Stuttgart Philharmonic Orchestra',
                'kolaborasi' => 'Rencana Kolaborasi Stuttgart Philharmonic Orchestra',
                'rangkuman' => 'The Stuttgart Philharmonic Orchestra berencana untuk melaksanakan tur ke Jakarta pada tahun 2027, bertepatan dengan perayaan ulang tahun diplomatik ke-75 RI dan Republik Federal Jerman\'. Stuttgart Philharmonic mengharapkan kontribusi dari Pemerintah Provinsi DKI Jakarta untuk membantu pendanaan tur tersebut.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-19',
                'tanggal_selesai' => 'Batal',
                'triwulan_kolaborasi' => 'TW I',
                'status_kolaborasi' => 'Batal',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Persatuan Guru Republik Indonesia (PGRI)',
                'kolaborasi' => 'Permohonan audiensi, sekaligus undangan untuk menyampaikan Sambutan Selamat Datang, dan Permohonan Dukungan dan Tarian Pembukaan dan Penutupan pada The 10th Education<br>International Asia Pacific (EIAP) Regional Conference',
                'rangkuman' => 'Menindaklanjuti Surat Ketua Umum Pengurus Besar Persatuan Guru Republik Indonesia (PGRI) Nomor 586/Um/PB/XXIII/2026 tanggal 21 Juli 2026 kepada Gubernur DKI Jakarta serta menindaklanjuti audiensi antara Gubernur DKI Jakarta dengan Perwakilan Persatuan Guru Republik Indonesia (PGRI) pada tanggal 24 Juli 2026, disampaikan bahwa PGRI bermitra dengan Education International Asia Pacific (EIAP) untuk menyelenggarakan the 10th Education International Asia Pacific (EIAP) akan dilaksanakan pada tanggal 13–15 Oktober 2026.<br>Berkenaan dengan ini, Gubernur DKI Jakarta diharapkan dapat menyampaikan Sambutan Selamat Datang pada 19 Oktober, 09:00 WIB di Hotel Shangri-La Jakarta. Diharapkan juga agar Provinsi DKI Jakarta dapat memberikan dukungan berupa tarian pembukaan dan penutupan pada acara dimaksud.<br>Biro Kerja Sama Daerah telah melaksanakan rapat koordinasi pada tanggal 4 Agustus 2026, dengan hasil bahwa Dinas Kebudayaan akan mengupayakan dukungan tarian, Dinas PPKUKM akan mengupayakan dukungan booth UMKM, dan Dinas Pariwisata dan Ekonomi Kreatif akan mengupayakan dukungan City Tour.<br>Dukungan-dukungan dimaksud memerlukan surat permohonan dari PGRI.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-21',
                'tanggal_selesai' => 'Berjalan',
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Keluarga Pelajar Jakarta (KPJ) Mesir',
                'kolaborasi' => 'Permohonan kolaborasi dalam Jakarta Event XII',
                'rangkuman' => 'Melalui surat No. 043/B6/JEXII/KPJ/II/2026 kepada Gubernur DKI Jakarta yang telah didisposisikan kepada Biro Kerja Sama Daerah, Panitia Jakarta Event XII 2026 dan Keluarga Pelajar Jakarta Mesir memohon bantuan sponsorship dan dukungan video message untuk pelaksanaan acara Jakarta Event XII di Mesir.<br>Surat ini diperkuat dengan Surat No. 010-A7/IDN-EGYPT/I/IV/1447-2026 tanggal 2 April 2026 dari Indonesia Diaspora Network Egypt kepada Gubernur DKI Jakarta.<br>Berdasarkan hal ini, Biro Kerja Sama Daerah telah melaksanakan rapat koordinasi dan membuat Nota Dinas No. 32/HM.00.02 tanggal 26 Mei 2026 untuk memohon video messaging kepada Gubernur DKI Jakarta, dan surat permohonan tanggal 95/HM03.02 tanggal 26 Mei 2026 berkenaan dengan permohonan sponsorship kepada Bank Jakarta.<br>Respons terhadap kedua surat dimaksud mengalami kendala.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-09',
                'tanggal_selesai' => '2026-07-29',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Regret',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Mitra Non-PNA',
                'kolaborasi' => 'KJRI Mumbai - Rencana pelaksanaan Jakarta-Mumbai (JAMU) 2026',
                'rangkuman' => 'Melalui Surat No --/SOS/UM/I/2026 tanggal 26 Januari 2026, Konsul Jenderal RI di Mumbai mengajukan permohonan pertemuan dengan Kepala Biro Kerja Sama Daerah. Pertemuan diharapkan dapat terlaksana pada rentang tanggal 10-13 Februari 2026, bertepatan dengan agenda kegiatan kedinasan Konjen RI di Jakarta pada 9-13 Februari 2026.<br>Pertemuan bertujuan untuk membahas penguatan kolaborasi ekonomi, perdagangan, pariwisata, kuliner, sosial-budaya, dan pendidikan melalui hubungan "Sister City" antara Jakarta dan Mumbai.<br>Pengembangan hubungan ini merupakan kelanjutan dari acara the 1st Jakarta Mumbai Update (JAMU) yang dilaksanakan pada 20-21 Agustus 2025.<br>KJRI Mumbai berencana menyelenggarakan the 2nd Jakarta - Mumbai Update (JAMU) 2026 pada 26-28 Juni 2026 di Mumbai.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-02-12',
                'tanggal_selesai' => 'Dialihkan ke Sub-Kelompok Kerjasama Pemerintah Daerah Dalam Negeri',
                'triwulan_kolaborasi' => 'TW I',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Badan Kesatuan Bangsa dan Politik',
                'kolaborasi' => 'Penanaman Mangrove sebagai Diplomasi Hijau Rumah Rusia di Jakarta',
                'rangkuman' => 'Badan Kesatuan Bangsa dan Politik bekerja sama dengan Rumah Rusia di Jakarta untuk melaksanakan kegiatan diplomasi hijau berupa penanaman bibit Mangrove di Kawasan Ekowisata Mangrove Pantai Indah Kapuk. Usulan ini disampaikan kepada Badan Kesatuan Bangsa dan Politik melalui surat No. 96/RCSC/JKT/2026 tanggal 16 April 2026 oleh Rumah Rusia di Jakarta.<br>Biro Kerja Sama Daerah hadir di sejumlah rapat koordinasi terkait acara dimaksud, sekaligus memfasilitasi dan mengkoordinasikan bantuan keprotokolan , bersama dengan Biro Kepala Daerah.<br>Acara telah dilaksanakan 10 Mei 2026',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-21',
                'tanggal_selesai' => '2026-05-10',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => '5P Global Movement',
                'kolaborasi' => 'Permohonan dukungan Harmony in Diversity (HID) Award 2026',
                'rangkuman' => 'Berdasarkan surat Chair 5P Global Movement Indonesia nomor 5P/38/L/IV/2026 tanggal 13 April 2026 kepada Kepala Biro Kerja Sama Daerah, disampaikan permohonan kepada Pemerintah Provinsi DKI Jakarta untuk mendukung pelaksanaan Harmony in Diversity Award (HID) 2026.<br>Pemerintah Provinsi DKI Jakarta mendukung diharapkan dapat mendukung pelaksanaan Welcoming Dinner yang direncanakan pada tanggal 14 Juli 2026 di Balai Kota DKI Jakarta.<br>Acara telah dilaksanakan pada 14 Juli 2026.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-21',
                'tanggal_selesai' => '2026-07-14',
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'AIESEC Indonesia',
                'kolaborasi' => 'Permohonan dukungan pelaksanaan AIESEC International Congress 2026',
                'rangkuman' => 'Melalui surat nomor 015/ID/PR/III/2026 tanggal 16 Maret 2026 kepada Pemerintah Provinsi DKI Jakarta, AIESEC Indonesia memohon bantuan untuk pelaksanaan AIESEC Congress 2026.<br>Association Internationale des Étudiants en Sciences Économiques et Commerciales (AIESEC) Indonesia adalah organisasi kepemudaan internasional yang memiliki fokus pada pengembangan kepemimpinan generasi muda melalui pengalaman lintas budaya dan pembelajaran global, AIESEC didirikan pada tahun 1948 dan telah hadir di lebih dari 100 negara, termasuk Indonesia. Di Indonesia, AIESEC mulai mulai beroperasi sejak tahun 1984 dengan cabang pertama di Universitas Indonesia. AIESEC Indonesia aktif menyelenggarakan program yang mempertemukan pemuda dari berbagai negara untuk belajar, berkolaborasi, dan mengenal Indonesia melalui pengalaman lintas budaya.<br>Di tahun 2026, AIESEC Indonesia dipercaya menjadi tuan rumah International Congress (IC) 2026. Konferensi ini diselenggarakan pada tanggal 5 s.d. 13 Juli mendatang di Jakarta, dan dihadiri lebih dari 350 pemuda global dari lebih 100 negara dan kawasan.<br>Berdasarkan hal ini, Biro Kerja Sama Daerah menerbitkan Nota Dinas No e-0043/HM.03.00 tanggal 26 Juni 2026 kepada Sekretaris Daerah; Surat e-0135 HM.03.00 tanggal 1 Juli 2026 kepada Dinas Perhubungan; Surat No e-0133 HM.03.00 tanggal 1 Juli 2026 kepada Dinas Kebudayaan; dan Surat No. e-0134 HM.03.00 tanggal 1 Juli 2026.<br>Semua dukungan telah dilaksanakan pada tanggal 5 s.d. 13 Juli 2026.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-05-26',
                'tanggal_selesai' => '2026-07-13',
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
        ];
    }
}
