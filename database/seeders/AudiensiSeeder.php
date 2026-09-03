<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Audiensi;

class AudiensiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_kedutaan_besar' => 22, // Kedutaan Besar Republik Bulgaria
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Bulgaria</p>',
                'rangkuman' => '<p>Melalui Surat 238/2025 tanggal 1 Oktober 2025, Duta Besar Bulgaria melaksanakan permohonan untuk melaksanakan audiensi kepada Gubernur DKI Jakarta.</p><p>Permohonan belum terdisposisi.</p>',
                'catatan' => '<p>Jika diminta oleh kedutaan, dapat dibuat telaahan untuk mengajukan permohonan audiensi ini kepada Gubernur.</p>',
                'tanggal_diterima' => '2026-01-19',
                'tanggal_selesai' => null,
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => 'Kedutaan Besar Bulgaria',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 31, // Kedutaan Besar Georgia
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Georgia.</p>',
                'rangkuman' => '<p>Melalui Note Verbale No. 31/8638 tanggal 19 Maret 2026 kepada kementerian Luar Negeri RI, dan melalui surat tanggal 19 Maret 2026 kepada Gubernur DKI Jakarta, Duta Besar Georgia memohon audiensi kepada Gubernur DKI Jakarta.</p>',
                'catatan' => '<p>Pantau Nota Dinas telaahan</p>',
                'tanggal_diterima' => '2026-03-19',
                'tanggal_selesai' => null,
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => 'Ms. Ladia, Kedutaan Besar Georgia',
                'nomor_pic' => '+62 895-3267-26057',
            ],
            [
                'id_kedutaan_besar' => 52, // Kedutaan Besar Kuwait
                'topik' => '<p>Pwrmohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Kuwait</p>',
                'rangkuman' => '<p>Melalui Surat No. 602/2025 tanggal 28 November 2025 kepada Gubernur DKI Jakarta Kedutaan Besar Kuwait memohon Audiensi kepada Gubermur DKI Jakarta</p>',
                'catatan' => '<p>Jika diminta oleh kedutaan, dapat dibuat telaahan untuk mengajukan permohonan audiensi ini kepada Gubernur.</p>',
                'tanggal_diterima' => '2026-04-23',
                'tanggal_selesai' => null,
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => 'Kedutaan Besar Kuwait',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 107, // Kedutaan Besar Yaman
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Yaman</p>',
                'rangkuman' => '<p>Melalui Surat No, A.021/OE/VI/26 tanggal 4 Juni 2026 kepada Gubernur DKI Jakarta, Duta Besar Yaman memohon audiensi kepada Gubernur DKI Jakarta.</p><p>Berdasarkan koordinasi lanjutan, diperoleh informasi bahwa Duta Besar Yaman bermaksud bersilaturahmi dan melaksanakan perkenalan dengan Pak Gubernur, sebagai duta besar baru. Selain itu, Duta Besar Yaman bermaksud memperet hubungan bilateral Yaman - Indonesia dalam bidang perdagangan, pendidikan dan kebudayaan.</p>',
                'catatan' => '<p>Pantau dan ingatkan KDH soal jadwal, buat telaahan jika diperlukan</p>',
                'tanggal_diterima' => '2026-06-04',
                'tanggal_selesai' => null,
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => 'Cathrine Kedutaan Yaman',
                'nomor_pic' => '+62 812-8679-114',
            ],
            [
                'id_kedutaan_besar' => 93, // Kedutaan Besar Swedia
                'topik' => '<p>Permohonan audiensi dan undangan untuk menghadiri acara Sweden-Indonesia Sustainability Partnership, Resepsi Diplomatik dalam rangka kunjungan HRH Victoria Ingrid, Putri Mahkota Swedia, dan Eksibisi Tyra Kleen.</p>',
                'rangkuman' => '<p>Melalui Surat No 084/AMNB/VII/2026 tanggal 20 Juli 2026, Duta Besar Swedia memohon Audiensi kepada Gubernur DKI Jakarta untuk membahas pelaksanaan acara Sweden-Indonesia Sustainability Partnership (SISP) Conference on Business Delegation pada tanggal 8 s.d. 10 September 2026, yang dirangkaikan dengan Tyra Kleen Art Exhibition pada tanggal, 8 September 2026. Acara ini juga bertepatan dengan kunjungan HRH Victoria Ingrid, Putri Mahkota Swedia.</p><p>Undangan untuk menghadiri kedua acara tersebut juga telah disampaikan melalui Surat No. 113/AMB/VIII/2026 tanggal 13 Agustus 2026 kepada Gubernur DKI Jakarta, dengan rincian:</p><p>1. Menghadiri resepsi diplomatik yang dihadiri oleh HRH Victoria Ingrid, Putri Mahkota Swedia --- 7 September 2026, 19:00 - 21:00 WIB</p><p>2. Menghadiri pembukaan Tyra Kleen Art Exhibition --- 8 September 2026, 12:00 s.d. 13:00 WIB di UP, Thamrin Nine.</p><p>3. Menghadiri Closed-door Bilateral Meeting dengan Menteri Luar Negeri Swedia --- 8 September 2026, 13:30 s.d. 14:30 WIB di Park Hyatt Jakarta.</p>',
                'catatan' => '<p>Cek berkala, dan jika perlu, buatkan Nota Dinas.</p>',
                'tanggal_diterima' => '2026-07-22',
                'tanggal_selesai' => null,
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => 'Ms. Amreta Sidik, Kedutaan Swedia,  Ms. Aryusamalia, Business Sweden',
                'nomor_pic' => '+62 811-8860-147, +62 811-1262-148',
            ],
            [
                'id_kedutaan_besar' => 33, // Kedutaan Besar Hungaria
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Hungaria</p>',
                'rangkuman' => '<p>Melalui Surat No. 4/2026/HUEMB/JKT tanggal 12 Januari 2026, Duta Besar Republk Hungaria melaksanakan permohonan untuk melaksanakan audiensi kepada Gubernur DKI Jakarta. Permohonan ini mengulangi permohonan sebelumnya, melalui Surat No. KKM/8408/2025/Adm tanggal 6 Maret 2025, yang belum direspons.</p><p>Audiensi dilaksanakan 29 Januari 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-01-12',
                'tanggal_selesai' => '2026-01-29',
                'triwulan_audiensi' => 'TW I',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Hungaria',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 10, // Kedutaan Besar Australia
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Australia</p>',
                'rangkuman' => '<p>Melalui Surat Tanggal 25 Maret 2026, Duta Besar Australia memohon Audiensi kepada Gubenur DKI Jakarta</p><p>Audiensi dilaksanakan 2 April 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-03-25',
                'tanggal_selesai' => '2026-04-02',
                'triwulan_audiensi' => 'TW I',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Australia',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 76, // Kedutaan Besar Qatar
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Qatar</p>',
                'rangkuman' => '<p>Melalui Surat No Q-J-MISC/2045/III/2026 tanggal 27 Maret 2026, Duta Besar Qatar memohon audiensi kepada Gubernur DKI Jakarta.</p><p>Audiensi dilaksanakan 7 Mei 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-03-27',
                'tanggal_selesai' => '2026-05-07',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Qatar',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 56, // Kedutaan Besar Malaysia
                'topik' => '<p>Pwrmohonan audiensi sekaligus undangan kepada Gubernur DKI Jakarta dari Kedutaan Malaysia, memohon Courtesy Call untuk Menteri Besar Negeri Kelantan dan hadir di acara Kelantan Day.</p>',
                'rangkuman' => '<p>Berdasarkan Nota Diplomatik Kedutaan Besar Malaysia Nomor AT220/2026 tanggal 23 April 2026 kepada Kementerian Luar Negeri RI dan Surat Kuasa Usaha Sementara Kedutaan Besar Malaysia Nomor SR (033) 686/2 Jld.2 tanggal 23 April 2026 kepada Biro Kerja Sama Daerah DKI Jakarta, Kedutaan Besar Malaysia menyampaikan permohonan kepada Bapak Gubernur DKI Jakarta untuk:</p><p>Menerima kunjungan kehormatan (courtesy call) Menteri Besar Negara Bagian Kelantan kepada Gubernur DKI Jakarta pada hari Rabu, 13 Mei 2026 pukul 10:00 WIB untuk mempererat hubungan silaturahmi, membahas perkembangan hubungan bilateral antara Kerajaan Malaysia dan Republik Indonesia, serta menjajaki potensi kerja sama khususnya antara Negara Bagian Kelantan dan Provinsi DKI Jakarta.</p><p>Menghadiri dan memberikan sambutan pada kegiatan program Kelantan Day pada hari Kamis, 14 Mei 2026 pukul 09:00 WIB di Hotel Four Points by Sheraton Jakarta, Thamrin. Program ini diselenggarakan bertepatan dengan peluncuran penerbangan langsung AirAsia rute Kota Bharu–Jakarta yang dijadwalkan mulai beroperasi pada Juni 2026, yang diharapkan dapat meningkatkan aktivitas pariwisata dan kunjungan masyarakat</p>',
                'catatan' => '<p>Juga menyampaikan undangan.</p>',
                'tanggal_diterima' => '2026-04-23',
                'tanggal_selesai' => '2026-05-14',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Ms. Rosnita, Kedutaan Besar Malaysia',
                'nomor_pic' => '+62 811-8882-5335',
            ],
            [
                'id_kedutaan_besar' => 47, // Kedutaan Besar Republik Korea
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Republik Korea</p>',
                'rangkuman' => '<p>Melalui Surat No. ROKE - 2026 - 492 tanggal 24 April 2026, Kedutaan Besar Republik Korea (Korea Selatan) memohon Audiensi kepada Gubernur DKI Jakarta</p><p>Audiensi dilaksanakan 20 Mei 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-04-27',
                'tanggal_selesai' => '2026-05-20',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Republik Korea',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 49, // Kedutaan Besar Kosta Rika
                'topik' => '<p>Permohonan audiensi kepada Kepala Biro Kerja Sama Daerah dari Kedutaan Besar Kosta Rika</p>',
                'rangkuman' => '<p>Melalui Surat No. EMBCR-IDN-057-2026 tanggal 8 Juni 2026, Kedutaan Besar Kosta Rika memohon pertemuan dengan Kepala Biro Kerja Sama Daerah untuk mendiskusikan kesempatan kolaborasi dengan Kedutaan Besar Kosta Rika.</p>',
                'catatan' => '<p>Berikan informasi JITEX kepada Kedutaan Besar Kosta Rika</p>',
                'tanggal_diterima' => '2026-06-14',
                'tanggal_selesai' => '2026-07-21',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Christina, PA Kedubes Kosta Rika',
                'nomor_pic' => '+62 838-7888-5221',
            ],
            [
                'id_kedutaan_besar' => 79, // Kedutaan Besar Federasi Rusia
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Federasi Rusia</p>',
                'rangkuman' => '<p>Melalui koordinasi kepada Biro Kepala Daerah Gubernur, Kedutaan Besar Rusia memohon Audiensi Kepada Gubernur DKI Jakarta</p><p>Audiensi dilaksanakan 2 Juli 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-07-01',
                'tanggal_selesai' => '2026-07-02',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Federasi Rusia',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 57, // Kedutaan Besar Kerajaan Maroko
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Kerajaan Maroko, sekaligus penyampaikan permohonan untuk mengatasi permasalahan gangguan ketertiban karena iperasional 24 Jam Taman Mataram.</p>',
                'rangkuman' => '<p>Kedutaan Besar Kerajaan Maroko menyampaikan Surat No 706/2026 tanggal 4 Juni 2026 kepada Gubernur DKI Jakarta untuk memohon courtesy call.</p><p>Meski demikian, Kedutaan Besar Kerajaan Maroko juga telah mengirimkan Surat No 780/2026 tanggal 17 Juni 2026, berkenaan dengan keluhan terhadap jam operasional Taman Mataram selama 24 jam, yang menimbulkan gangguan di sekitar premis Kedutaan Besar.</p><p>Berkenaan dengan hal ini, Kelurahan Selong telah melaksanakan beberapa inisiatif yaitu:</p><p>1. Penertiban parkir dengan pemberlakuan larangan parkir bagi selain warga pada pukul 01.00–07.00 WIB disertai pemasangan rambu dan pemantauan oleh Dinas Perhubungan;</p><p>2. Penertiban pedagang, larangan merokok serta membawa minuman keras di kawasan taman yang diawasi Satpol PP;</p><p>3. Penguatan pengamanan kawasan melalui patroli FKDM, penambahan personel pendukung, usulan pembangunan pagar hidup, serta penambahan penerangan jalan;</p><p>4. Pengaturan akses Wi-Fi publik sehingga pada jam-jam rawan hanya digunakan untuk kebutuhan CCTV.</p><p>5. Sebagai upaya mitigasi tambahan, Kelurahan Selong akan memasang portal di sisi utara dan selatan akses Taman Mataram. Pemasangan ini akan dilaksanakan pada minggu pertama dan kedua bulan Juli 2026.</p><p>Penerimaan audiensi untuk Kedutaan Besar Kerajaan Maroko akan ditunda hingga penanganan permasalahan operasional di Taman Mataram diselesaikan.</p>',
                'catatan' => '<p>Perlu koordinasi terkait kemajuan penanganan masalah dan situasi di sekitar Kedutaan untuk saat ini.</p>',
                'tanggal_diterima' => '2026-07-02',
                'tanggal_selesai' => null,
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Kelurahan Selong, Kedutaan Besar Kerajaan Maroko',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 2, // Kedutaan Besar Afrika Selatan
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Afrika Selatan</p>',
                'rangkuman' => '<p>Melalui Surat No 08945/BK/07/2026 tanggal 10 Juli 2026, Direktur Jenderal Asia Pasifik dan Afrika Kementerian Luar Negeri RI menyampaikan kepada Gubernur DKI Jakarta bahwa Kedutaan Besar Afrika Selatan memohon audiensi pada Kamis, 30 Juli 2026.</p><p>Audiensi telah dilaksanakan, 30 Juli 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-07-10',
                'tanggal_selesai' => '2026-07-30',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Ms Sasa Budhijuwono, PA Kedubes Afrika Selatan',
                'nomor_pic' => '+62 812-9934-323',
            ],
            [
                'id_kedutaan_besar' => 86, // Kedutaan Besar Republik Slovakia
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Republik Slovakia</p>',
                'rangkuman' => '<p>Melalui Surat No. -- tanggal 19 Juni 2026 kepada Gubernur DKI Jakarta, Duta Besar Slovakia menyampaikan permohonan Audiensi kepada Gubernur DKI Jakarta.</p><p>Audiensi dilaksanakan pada 20 Juli 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-07-19',
                'tanggal_selesai' => '2026-07-20',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Ms Ita Mugizanti, Kedubes Slovakia',
                'nomor_pic' => '+62 858-5093-0572',
            ],
            [
                'id_kedutaan_besar' => 68, // Kedutaan Besar Palestina
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta sekaligus permohonan bantuan beautifikasi di sekitar Kedutaan Besar Palestina</p>',
                'rangkuman' => '<p>Kedutaan Besar Palestina menyampaikan permohonan audiensi kepada Gubernur DKI Jakarta melalui koordinasi langsung dengan Biro Kepala Daerah.</p><p>Audiensi dilaksanakan 8 Agustus 2026.</p><p>Selama audiensi dibahas beberapa hal, termasuk surat Direktur Fasilitas Diplomatik Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri Republik Indonesia Nomor 00954/PK/07/2026/67 tanggal 29 Juli 2026 perihal Permohonan Kedutaan Besar Palestina kepada Pemprov DKI Jakarta untuk melaksankan fasilitasi dan mendukung kegiatan Kedubes dalam rangka menyabut HUT RI ke-81, Kedutaan Besar Palestina bermaksud melaksanakan beautifikasi di sekitar wilayah Kedutaan dan memohon bantuan dari Pemerintah Provinsi DKI Jakarta.</p><p>Bantuan telah diberikan dan dilaksanakan pada 8 Agustus 2026.</p><p>Kedutaan Besar Palestina telah menyampaikan ucapan terima kasih No. EPJ/359/VIII/2026 tgl -- atas kerja sama yang diberikan Pemerintah Provinsi DKI Jakarta.</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-07-29',
                'tanggal_selesai' => '2026-08-08',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Prasetyo, Walikota Jakarta Pusat  Ms. Indri, Kedutaan Besar Palestina,  Febriansyah, Kedubes Palestina',
                'nomor_pic' => '+62 818-0745-5080, +62 878-0999-8303, +62 819-3077-7048',
            ],
            [
                'id_kedutaan_besar' => 1, // Kedutaan Besar Afghanistan
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Charge d\'Affaires Kedutaan Besar Afghanistan</p>',
                'rangkuman' => '<p>Melalui Surat No. 26121/AF.OLJ/VII/2026 tanggal 14 Juli 2026, kepada Gubernur DKI Jakarta, Kedutaan Besar Afghanistan memohon audiensi/pertemuan antara Mr. Mawlawi Sadullah Baloch dan Gubernur DKI Jakarta di Kedutaan Besar Afghanistan.</p><p>Permohonan pending, mempertimbangkan situasi dalam negeri Afghanistan, ketidaksetaraan protokoler, dan lokasi pertemuan.</p><p>Telaahan telah dibuat, dan disarankan untuk diwakilkan serta dilaksanakan di Balaikota DKI Jakarta.</p>',
                'catatan' => '<p>Sekiranya ada follow up dari Kedutaan Besar Afghanistan, buat Nota Dinas telaahan ke Gubernur, dengan saran agar pertemuan diwakilkan dan dilaksanakan di Balaikota DKI Jakarta.</p>',
                'tanggal_diterima' => '2026-07-14',
                'tanggal_selesai' => null,
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Batal',
                'nama_pic' => 'Ms. Firda, Kedutaan Besar Afghanistan, afghanembassy_indo@yahoo.com',
                'nomor_pic' => '+62 812-4962-4521',
            ],
            [
                'id_kedutaan_besar' => 76, // Kedutaan Besar Qatar
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Qatar</p>',
                'rangkuman' => '<p>Melalui Nota Diplomatik No -- tanggal 17 Juli 2027 dan No -- tanggal 23 Juli 2026 kepada Gubernur DKI Jakarta, Duta Besar Qatar menyampaikan permohonan Audiensi kepada Gubernur DKI Jakarta untuk mendiskuksikan kemungkinan pelaksanaan kerja sama Sister City Jakarta dan Doha. Kedutaan Besar Qatar telah melampirkan Draft Nota Kesepahaman dalam Bahasa Inggris.</p><p>Sebelumnya, Qatar telah melaksanakan audiensi kepada Gubernur DKI Jakarta pada tanggal 7 Mei 2026</p><p>Mengingat pembahasan masalah telah spesifik menjajaki kemungkinan membuat Sister City, dan bahwa Qatar telah melaksanakan audiensi kepada Gubernur sebelumnya untuk tahun 2026, audiensi akan diterima oleh Kepala Biro KSD.</p><p>Audiensi ditunda ke September atas permohonan Kedutaan Besar Qatar.</p>',
                'catatan' => '<p>Perlu dibuatkan draft LoI Qatar, dan pointers untuk menjelaskan prosedur penjajakan dan pelaksanaan sister city berdasarkan Peraturan Menteri Dalam Negeri No 25 Tahun 2020. Libatkan Sub-kelompok Kerja Sama Pemerintah Daerah Luar Negeri</p>',
                'tanggal_diterima' => '2026-07-26',
                'tanggal_selesai' => null,
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Batal',
                'nama_pic' => 'Ms. Arini, Kedutaan Besar Qatar',
                'nomor_pic' => '+62 819-1110-6988',
            ],
            [
                'id_kedutaan_besar' => 7, // Kedutaan Besar Arab Saudi
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta, berkenaan dengan rencana kolaborasi dengan Jakarta, secara khusus hibah Kedutaan Besar Arab Saudi bantuan Kedutaan Besar Kerajaan Arab Saudi untuk renovasi Jakarta Islamic Center dan Pembangunan King Salman Islamic Center.</p>',
                'rangkuman' => '<p>Kedutaan Besar Arab Saudi menyatakan dukungan terhadap rekonstruksi Jakarta Islamic Center (JIC) dan pembangunan King Salman Islamic Center di Jakarta.</p><p>Rekonstruksi JIC dinilai sangat krusial. penting, mengingat lokasi memerlukan pemulihan perhatian pasca kebakaran pada tahun 2022.</p><p>Selain itu, Kedutaan Besar Arab Saudi juga berencana melaksankanan rencana pembangunan King Salman Islamic Center. Kedutaan Besar Arab Saudi memilh kosong di Cengkareng Barat, sisi Jakan Tol Lingkar Luar Barat, Kelurahan Cengkareng Barat, Kecamatan Cengkareng, Kota Administrasi Jakarta Barat.</p><p>Pemerintah Provinsi DKI Jakarta telah mengirimkan Surat No. 610/KR.03 tanggal 29 Oktober 2025 kepada Kementerian Luar Negeri RI untuk memohon fasilitasi terkait hal ini, dan telah dijawab melalui Surat No. 783/BK/11/2025/04/01 dari Kementerian Luar Negeri Kepada Gubernur DKI Jakarta, yang pada dasarnya menyambut baik dan menyatakan dukungan</p><p>Terkait hal ini juga, pada tanggal 31 Juli 2026 telah dilaksanakan pertemuan antara Duta Besar Saudi Arabia dan tim Pemerintah Provinsi DKI Jakarta yang terdiri dari:</p><p>1. Kerajaan Saudi Arabia memlih pembangunan lokasi King Salman Islamic Center di Cengkareng. dan bersedia membiaya renovasi pembangunan JIC Koja, dengan surat konfirmasi masih berproses.</p><p>2. Meski demikian, Kedutaan Besar Arab Saudi mengharapkan bahwa tanah di Cengkareng dapat diserahkan dalam keadaan clean and clear, sementara keadaan eksisting, lahan tersebut dimiliki oleh Dinas Ketahanan Pangan, Kelautan, dan Perikanan dan masih berada dalam sengketa.</p><p>3. Selain itu, Kedutaan Besar Arab Saudi berharap agar skema hibah dapat dilaksanakan secara G to G, yang harus tunduk pada ketentuan PP No. 10 tahun 2011. Berkenaan dengan ini, masih perlu dibahas mekanisme bantuan dari Pemerintah Arab Saudi, apakah dalam bentuk dana, barang, pembangunan langsung, atau melalui mekanisme/lembaga tertentu, dan bahwa beberapa contoh kerja sama bantuan luar negeri, antara lain bantuan Pemerintah Uni Emirat Arab di Solo dan bantuan Pemerintah Arab Saudi di Aceh, sebagai bahan perbandingan untuk mencari mekanisme yang efektif dan sesuai ketentuan.</p><p>Akan dilaksanakan rapat terbatas berdasarkan hasil-hasil pembahasan ini, yang akan ditindaklanjuti oleh Biro Kerja Sama Daerah melalui Nota Dinas kepada Gubernur DKI Jakarta.</p>',
                'catatan' => '<p>Audiensi selesai, tetapi kolaborasi masih berlanjut. Pantau hasil rapat terbatas dan nota dinaskan</p>',
                'tanggal_diterima' => '2026-08-23',
                'tanggal_selesai' => '2026-08-24',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Arab Saudi Kementerian Luar Negeri Biro Pembangunan dan Lingkungan Hidup',
                'nomor_pic' => null,
            ],
        ];

        foreach ($data as $item) {
            Audiensi::create($item);
        }
    }
}
