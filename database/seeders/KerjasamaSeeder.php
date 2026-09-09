<?php

namespace Database\Seeders;

use App\Models\Kerjasama;
use Illuminate\Database\Seeder;

class KerjasamaSeeder extends Seeder
{

    // id_kedutaan_besar di bawah ini mengikuti urutan insert
    // KedutaanBesarPart1Seeder s.d. KedutaanBesarPart6Seeder (auto-increment 1-110).
    // Pastikan seeder ini dijalankan SETELAH keenam seeder Kedutaan Besar tsb,
    // pada tb_kedutaan_besar yang masih fresh (belum ada insert/delete lain),
    // supaya id_kedutaan_besar berikut tetap valid.

    public function run(): void
    {
        $data = [
            [
                'id_kedutaan_besar' => 10, // Kedutaan Besar Australia
                'kerjasama' => '<p>Permohonan perbaikan kabel serat optik yang krusial bagi operasional Kedutaan Besar Australia.</p>',
                'rangkuman' => '<p>Kementerian Luar Negeri RI telah menyampaikan Surat No. 10639/PK/07/2025/65 tanggal 7 Juli 2026. Berdasarkan hal ini, Biro Kerja Sama Daerah telah melaksanakan Rapat Koordinasi tanggal</p><p>29 April 2026</p><p>Di dalam rapat, disampaikan bahwa Kedutaan Besar Australia sebelumnya telah menyampaikan kebutuhan perbaikan jaringan serat optik yang mengalami gangguan akibat aktivitas konstruksi di sekitar lokasi.Disampaikan bahwa pelaksanaan perbaikan oleh PT Telkom memerlukan persetujuan dari Pemerintah Provinsi DKI Jakarta melalui pengajuan permohonan resmi sesuai prosedur yang berlaku. Permohonan resmi dari pihak PT Telkom belum dapat dikonfirmasi, sehingga diperlukan koordinasi lanjutan untuk memastikan proses pengajuan perizinan.</p><p>Dinas Bina Marga menyampaikan bahwa pelaksanaan perbaikan perlu mempertimbangkan aspek teknis di lapangan, termasuk kemungkinan perbaikan hanya pada titik kerusakan tanpa dilakukan penggalian sepanjang jalur. untuk itu akan dilakukan pengecekan lapangan bersama antara PT Telkom, Dinas Bina Marga, dan Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu untuk menentukan kebutuhan perbaikan secara teknis serta mekanisme pelaksanaannya.</p><p>Hasil rapat koordinasi telah disampaikan kepada Kementerian Luar Negeri RI melalui Surat Biro Kerja Sama Daerah No. 13/RR.01.02 tanggal 7 Mei 2026</p>',
                'catatan' => '<p>Perlu koordinasi lanjutan dengan Dinas Bina Marga.</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2025-07-07',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 36, // Kedutaan Besar Republik Islam Iran
                'kerjasama' => '<p>Permohonan Penurunan Trotoar di depan Kedutaan Besar Iran.</p>',
                'rangkuman' => '<p>Kedutaan Besar Iran menyampaikan Surat No. 200-1-0315/1404 tanggal 4 November 2025 Kepada Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri RI hal permohonan penurunan trotoar di depan Kedutaan Besar Iran.</p><p>Direktorat Jendral Protokol dan Konsuler Kementerian Luar Negeri RI menyampaikan Surat No. 17875/PK/11/2025/67 tanggal 7 November 2025 kepada Biro Kerja Sama Daerah hal Permohonan dari Kedutaan Besar Republik Islam Iran untuk mengembalikan trotoar di depan pintu Kedubes seperti sedia kala, di jalan HOS Cokroaminoto No. 110 Jakarta Pusat.</p><p>Berdasarkan Koordinasi antara Biro Kerja Sama Daerah dan Dinas Bina Marga, aset trotoar sebagaimana disampaikan tercatat di KIB A Suku Dinas Bina Marga Kota Administrasi Jakarta Pusat, dengan standar ketinggian untuk jalur pedestarian (kelengkapan jalan/trotoar) adalah 15 cm dari aspal.</p><p>Suku Dinas Bina Marga Kota Administrasi Jakarta Pusat telah melaksanakan survei lokasi pada 25 November 2025 dan pertemuan langsung dengan perwakilan Kedutaan Besar Iran pada 27 November 2025.</p><p>Per rapat koordinasi tanggal 16 Desember 2025, disepakati bahwa tindak lanjut permasalahan akan diproses dengan penurunan trotar ke ketinggian semula, per rapat. Meski demikian, pengerjaan akan menunggu pemeriksaan BPK atas lokasi tersebut selesai.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2025-11-04',
                'tanggal_selesai' => '2026-02-19', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 4, // Kedutaan Besar Republik Demokratik Aljazair
                'kerjasama' => '<p>Permohonan Pengawasan Pekerjaan Umum di Trotoar di depan Kedutaan Besar Aljazair.</p>',
                'rangkuman' => '<p>Kedutaan Besar Republik Demokratik Rakyat Aljazair menyampaikan Nota Diplomatik No. 138/JKT/25 tanggal 14 April 2025 kepada Direktorat Fasilitas Diplomatik Kementerian Luar Negeri RI menyampaikan perihal pekerjaan umum yang dilangsungkan PT. Pragata di trotoar depan premis Kedutaan Besar Aljazair, di Jalan H.R. Rasuna Said Kav. 10-1, Kuningan, Jakarta Selatan, yang belum terselesaikan sejak tahun 2023.</p><p>Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri RI menyampaikan surat No. 06312/PK/04/2025/65 tanggal 25 April 2025 kepada Biro Kerja Sama Daerah, hal Permintaan Penyelesaian Pekerjaan Umum di depan Kedutaan Besar Republik Demokratik Rakyat Aljazair</p><p>Biro Kerja Sama Daerah mengirimkan Surat No. 2/KR.04.00 tanggal 30 April 2025 kepada Dinas Bina Marga, yang telah ditindaklanjuti dengan survei lapangan pada tanggal 19 Desember 2025.</p><p>Dinas Bina Marga menginstruksikan penghentian pekerjaan kepada PT Pragata pada tanggal 29 Januari 2026, berkenaan dengan izin pelaksanaan pekerjaan PT Pragata yang telah habis masa berlakunya pada tanggal 12 Januari 2026. Menindaklanjuti instruksi tersebut, PT Pragata telah melasanakan pemulihan kondisi trotoar/pedestrian di lokasi pekerjaan.</p><p>Berdasarkan koordinasi lanjutan dengan Biro Kerja Sama Daerah, Kedutaan Besar Aljazair berharap agar kondisi trotoar/pedestrian di lokasi pekerjaan dapat ditingkatkan. Biro Kerja Sama Daerah telah mengirimkan Surat No. 1/KR.04.00 tanggal 2 Februari 2026 kepada Dinas Bina Marga hal Permohonan Prioritas Peningkatan Kondisi Trotoar di depan Kedutaan Besar Aljazair terkait hal ini</p><p>Dinas Bina Marga juga telah menyampaikan bahwa rencana revitalisasi kondisi trotoar/pedestrian di area Jalan H. R. Rasuna Said yang akan dilaksanakan pada tahun 2026, telah mencakup area di depan Kedutaan Besar Aljazair.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2025-11-05',
                'tanggal_selesai' => '2026-02-02', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 38, // Kedutaan Besar Italia
                'kerjasama' => '<p>Pengaduan melalui Instagram terkait kondisi Guiding Block di trotoar di depan Kedutaan Besar Italia.</p>',
                'rangkuman' => '<p>Akun Instagram @kumparancom menayangkan post tanggal 21 November 2025 liputan berkenaan dengan kondisi guiding block pada trotoar di depan Kedutaan Besar Italia.</p><p>Dinas Bina Marga menyampaikan Surat No. 5025/KR.02.00 tanggal 18 Desember 2025 kepada Biro Kerja Sama Daerah, hal Permohonan Bantuan Koordinasi Perbaikan Trotoar di Sekitar Kedutaan Besar Italia.</p><p>Biro Kerja Sama Daerah melaksanakan koordinasi dengan Kedutaan Besar Italia dan Direktorat Fasilitas Diplomatik, untuk membantu mengontak Kedutaan Besar Italia.</p><p>Perbaikan telah dilaksanakan oleh Dinas Bina Marga pada tanggal 13 Januari 2026, di lokasi Jaan Pangeran Diponegoro, Kecamatan Menteng, setelah mendapatkan izin dan dengan berkoordinasi dengan Kedutaan Besar Italia.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2025-11-21',
                'tanggal_selesai' => '2026-01-13', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 56, // Kedutaan Besar Malaysia
                'kerjasama' => '<p>Permohonan Penuntasan Permasalahan Tanah Kedutaan Besar Malaysia di Jalan Jalan Kemang Raya No 48.</p>',
                'rangkuman' => '<p>Duta Besar Malaysia melaksanakan audiensi kepada Gubernur DKI Jakarta pada tanggal 12 Desember 2025, yang ditindaklanjuti dengan Surat dari Duta Besar Malaysia Nomor SR (033) 4-6/2/1 tanggal 12 Desember 2025 kepada Gubernur DKI Jakarta, untuk memohon bantuan penyelesaian sengketa tanah di Jalan Kemang Raya No 48.</p><p>Sengketa tanah dimaksud telah berlangsung sejak tahun 1965 dan melibatkan tanah di Jalan Kemang Raya No 48 seluas 4.950 m2. Dari keseluruhan luas tanah tersebut, seluas 3.185 m2 telah terselesaikan dengan status hukum, sementara sisanya seluas 1.765 m2 masih berada dalam sengketa, dan bidang tanah inilah yang menjadi objek permohonan dari Surat Duta Besar Malaysia sebagaimana disebutkan.</p><p>Biro Kerja Sama Daerah telah melaksanakan rapat koordinasi dengan Perangkat Daerah serta Kementerian/Lembaga terkait sebagai upaya percepatan penyelesaian permasalahan pada tanggal 16 Desember 2025 dan 29 Desember 2025, dan telah menyelenggarakan survei lapangan pada tanggal 30 Desember 2025.</p><p>Pada kunjungan lapangan tanggal 30 Desember 2025, diperoleh informasi dari Bagian Hukum Walikota Jakarta Selatan bahwa status hukum berkenaan dengan tanah sengketa seluas 1.765 m2 dimaksud telah diupayakan pada tahun 2010, bersamaan dengan penyelesaian tanah 3.185 m2 yang kemudian mendapatkan status hukum tetap berdasarkan Sertifikat Hak Pakai No. 92/Kel Bangka pada 10 Desember 2010. Namun, Pemerintah Kerajaan Malaysia memprioritaskan penyelesaian bidang tanah seluas 3.185 m2 terlebih dahulu, sehingga penyelesaian tanah sengketa seluas 1.765 m2 belum dilaksanakan.</p><p>Kondisi tanah sengketa pada saat kunjungan lapangan diketahui dikuasai oleh pihak ketiga dan dimanfaatkan untuk lahan parkir kendaraan roda 2 dan 4 bagi karyawan yang bekerja di sekitar lokasi.</p><p>Sehubungan dengan hal-hal tersebut Biro Kerja Sama Daerah menyampaikan Nota Dinas No. 2/RR.01.02 tanggal 13 Januari 2026 kepada Sekretaris Daerah Provinsi DKI Jakarta hal Telaahan atas permasalahan aset tanah Kedutaan Besar Malaysia di Jl. Kemang Raya No. 48, Jakarta Selatan, dengan saran agar Kedutaan Besar Malaysia melaksanakan gugatan ulang dengan melibatkan seluruh ahli waris dan pihak terkait dan Kementerian Luar Negeri RI; atau melaksanakan musyawarah dengan pihak ahli waris dan pihak yang menguasai tanah untuk mendapatkan kepastian hukum atas tanah dimaksud, melalui bantuan mediasi dari Pemerintah Provinsi DKI Jakarta dan Kementerian Luar Negeri RI.</p>',
                'catatan' => '<p>Biro Kerja Sama Daerah perlu berkoordinasi dengan Kementerian Luar Negeri RI berkenaan dengan langkah lanjutan penanganan masalah Kedutaan Besar Malaysia di Jalan Kemang Raya No, 48</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2025-12-15',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 49, // Kedutaan Besar Republik Kosta Rika
                'kerjasama' => '<p>Permohonan Bantuan Pengaturan Lalu Lintas berkenaan dengan Pemilu Kosta Rika.</p>',
                'rangkuman' => '<p>Kedutaan Besar Kosta Rika menyampaikan Surat No. EMBCR-IDN 057-2025 tanggal 11 September 2025 kepada Gubernur DKI Jakarta tentang rencana pelaksanaan Pemilihan Umum (Pemilu) Kosta Rika dan permohonan pengaturan. Hal ini dilaksanakan mengingat Pemilu Kosta Rika jatuh pada 1 Februari 2026, yang merupakan Hari Bebas Kendaraan Bermotor/HBKB/Car Free Day. Penyelenggaraan HBKB diikhawatirkan akan mengganggu akses ke lokasi pelaksanaan Pemilu di Kedutaan Besar Kosta Rika di Wisma KEIAI.</p><p>Rapat koordinasi dilaksanakan oleh Biro Kerja Sama Daerah pada tanggal 13 Januari 2026. DInas Perhubungan menindaklanjuti dengan Nota Dinas No. e-0013/PH.04.00 tanggal Jakarta, 14 Januari 2026 kepada Gubernur DKI Jakarta hal Permohonan Akses Sementara Jalan Karet Pasar Baru Timur Menuju Wisma KEIAI, yang memuat pengaturan akses untuk warga Kosta Rika selama pelaksanaan pemilu pada 1 Februari 2026.</p><p>Biro Kerja Sama Daerah menyampaikan pengaturan dimaksud kepada Kedutaan Besar Kosta Rika melalui Surat No. 11/HM.00.01 tanggal 20 Januari 2026.</p><p>Pemilu telah dilaksanakan pada tanggal 1 Februari 2026 dengan hasil pantauan yang dilaporkan oleh Badan Kesatuan Bangsa dan Politik melalui Nota Dinas No. e-0042/PU.13.01 tanggal 5 Februari 2026 kepada Gubernur DKI Jakarta.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-01-05',
                'tanggal_selesai' => '2026-02-05', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 10, // Kedutaan Besar Australia
                'kerjasama' => '<p>Kemajuan Pemenuhan Kewajiban Kedubes Australia terkait SIPPT, Marka Jalan, dan Pendirian Sekolah di Marunda</p>',
                'rangkuman' => '<p>Berdasarkan Surat Izin Penunjukan Penggunaan Tanah No 2158/-1.711.534 tanggal 17 Oktober 2011 kepada Kedutaan Besar Australia, diketahui bahwa Kedutaan Besar Australa</p><p>telah melaksanakan pembebasan lahan tanpa persetujuan Gubernur DKI Jakarta, dan harus melaksanakan sejumlah sanksi berkenaan dengan hal tersebut.</p><p>Sanksi dimaksud termasuk kewajiban fasos fasum berupa penyerahan Marga Jalan (Mjl) seluas ± 262 m2dan pendirian proyek infrastruktur berupa gedung sekolah SMP di kawasan Marunda.</p><p>Pembangunan sekolah masih berada dalam kajian Pemerintah Australia.</p>',
                'catatan' => '<p>Perlu Koordinasi dengan Biro Pembangunan dan Lingkungan Hidup untuk mengetahui status terakhir</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-01-07',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 39, // Kedutaan Besar Jepang
                'kerjasama' => '<p>Permohonan untuk melaksanakan pemantauan, pemberitahuan, dan pengawasan atas Proyek Pembangunan Menara Indonesia Satu</p>',
                'rangkuman' => '<p>Kedutaan Besar Jepang menyampaikan Note Verbale No 64 A tanggal 27 Januari 2026 kepada Kementerian Luar Negeri RI, yang diteruskan kepada Pemerintah Provinsi DKI Jakarta melalui Surat No. 01307/PK/01/2026/67 tanggal 29 Januari 2026</p><p>Kedutaan Besar Jepang menyampaikan keluhan terkait proses pembangunan Proyek Gedung Indonesia Satu (Menara Indonesia Satu) yang berlokasi tepat di sebelah premis Kedutaan Besar Jepang.</p><p>Berdasarkan catatan pihak Kedutaan, sejak tahun 2019 hingga 2026 telah berulang kali terjadi insiden jatuhnya material pembangunan dari Proyek Gedung Indonesia Satu ke dalam area Kedutaan yang mengancam keselamatan staf, pengunjung, serta operasional Kedutaan</p><p>Hal ini telah dibahas dalam rapat koordinasi pada 6 Februari 2026 bersama perwakilan Kedutaan Besar Jepang, Kementerian Luar Negeri RI, Biro Kerja Sama Daerah, dan Perangkat Daerah terkait. Pembahasan kemudian dilanjutkan dengan rapat koordinasi tanggal 11 Maret 2026 serta kunjungan lapangan pada tanggal 12 Maret 2026 (notulen terlampir), yang telah ditindaklanjuti oleh Dinas Tenaga Kerja, Transmigrasi dan Energi melalui Nota Dinas e-0317/KT.04.02 tanggal 30 Maret 2026, dan disampaikan oleh Biro Kerja Sama Daerah kepada Direktur Fasilitas Diplimatik, Direktorat Jenderal Protokol dan Konsuler, Kementerian Luar Negeri RI melalui Surat No. 8/RR.01.02 tanggal 20 April 2026.</p><p>Pada tanggal 3 Agustus 2026, Kedutaan Besar Jepang melaporkan bahwa pada hari Jumat, 31 Juli 2026 pukul 21:10 WIB, terjadi insiden jatuhnya material bangunan di area belakang Kedutaan Besar Jepang pada jalur masuk menuju basement. Berdasarkan laporan Kedutaan Besar Jepang, material yang ditemukan berupa balok besi berukuran sekitar 20 cm x 17 cm x 1 cm dengan berat sekitar 3,6 kg serta pecahan kaca. Kejadian tersebut tidak menimbulkan korban luka maupun jiwa, namun menyebabkan kerusakan pada konblok jalan.</p><p>Menimbang terjadinya pengulangan insiden dimaksud, Biro Kerja Sama Daerah telah membuat draft surat kepada Dinas Tenaga Kerja, Transmigrasi, dan Energi, Dinas Cipta Karya, Tata Ruang, dan Pertanahan, Serta Walikota Jakarta Pusat untuk melaksanakan pemantauan rutin terhadap Proyek Indonesia Satu, dan membuat draft surat untuk menegaskan kepada PT Surya Indonesia Satu Properti dan PT China State Construction Overseas Development Shanghai, masing-masing pemilik dan kontraktor Proyek Menara Indonesia Satu, untuk memastikan tidak ada pengulangan insiden.</p>',
                'catatan' => '<p>Pantau surat-surat yang sedang berproses</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-01-29',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 5, // Kedutaan Besar Amerika Serikat
                'kerjasama' => '<p>Permohonan Inspeksi dan penanganan pohon oleh Kedutaan Besar Amerika Serikat</p>',
                'rangkuman' => '<p>Kedutaan Besar Amerika Serikat telah menyampaikan Nota Diplomatik Nomor 000262 tertanggal 3 Februari 2026 kepada Direktorat Fasilitas Diplomatik Kementerian Luar Negeri RI, yang memohon pemeriksaan terhadap pohon di depan Premis Diplomatik di Jalan Brawijaya IV No. 19, Jakarta Selatan, untuk mencegah potensi bahaya</p><p>Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta telah menerima surat dari Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri RI nomor 01707/PK/02/2026/67 tanggal 5 Februari 2026 perihal Permohonan Pemeriksaan Pohon di depan Premis Diplomatik Amerika Serikat di Jalan Brawijaya IV No. 19, Jakarta Selatan</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-02-18',
                'tanggal_selesai' => '2026-03-19', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 79, // Kedutaan Besar Federasi Rusia
                'kerjasama' => '<p>Permohonan Masyarakat dari CRM berkenaan dengan pemangkasan pohon di dekat Wisma Kedutaan Besar Federasi Rusia</p>',
                'rangkuman' => '<p>Sehubungan dengan penerimaan aduan masyarakat melalui sistem CRM (Cepat Respon Masyarakat) Provinsi DKI Jakarta terkait kondisi pohon yang rimbun dan berpotensi membahayakan pengguna jalan, Biro Kerja Sama Daerah akan memohon pihak terkait untuk melaksanakan pemangkasan pohon antara tanggal 24 s.d 27 Februari 2026 atau waktu yang sesuai pada area luar Wisma Kedutaan Besar Federasi Rusia yang berlokasi di Jl. Denpasar No. 18, RT.6/RW.7, Kelurahan Karet Kuningan, Kecamatan Setiabudi, Kota Administrasi Jakarta Selatan.</p><p>Rencana pemangkasan tersebut dilakukan sebagai langkah antisipatif guna mencegah potensi gangguan keselamatan akibat cuaca ekstrem seperti angin kencang dan hujan deras.</p><p>Rencana ini telah diberitahukan oleh Biro Kerja Sama Daerah kepada Direktorat Fasilitas Diplomatik Kementerian Luar Negeri RI melalui Surat No. 5/TM/10.15 tanggal 23 Februari 2026; dan kepada Kedutaan Besar Rusia melalui Surat No. 3/TM.10/15 tanggal 23 Februari 2026.</p><p>Permohonan pemangkasan disampaikan melalui Surat Biro Kerja Sama Daerah No. 4/TM.10.15 tanggal 23 Februari 2026 kepada</p><p>Dinas Pertamanan dan Hutan Kota.</p><p>Pemangkasan telah dilaksanakan 26 Februari 2026.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-02-22',
                'tanggal_selesai' => '2026-02-26', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 79, // Kedutaan Besar Federasi Rusia
                'kerjasama' => '<p>Permohonan informasi berkenaan dengan rencana renovasi di properti Kedutaan Besar Rusia</p>',
                'rangkuman' => '<p>Direktorat Fasilitas Diplomatik telah menerima nota diplomatik dari Kedutaan Besar Federasi Rusia di Jakarta nomor 452/I tanggal 19 Februari 2026 yang menyampaikan bahwa pihaknya hendak melakukan renovasi salah satu properti Kedutaan Besar Federasi Rusia yang terletak di Jl. Daksa V Blok 1/3, Kelurahan Selong, Kecamatan Kebayoran Baru, Kota Jakarta Selatan, DKI Jakarta (12110).</p><p>Biro Kerja Sama Daerah Setda telah menerima surat dari Direktorat Jenderal Protokol dan Konsuler nomor 02504/PK/02/2026/67 tanggal 24 Februari 2026, hal Permohonan Informasi Perizinan untuk Rencana Renovasi Kedutaan Besar Federasi Rusia.</p><p>Biro Kerja Sama Daerah menindaklanjuti dengan Surat No. 7/RR.01.01 tanggal 25 Februari 2026 kepada Dinas Cipta Karya, Tata Ruang, dan Pertanahan hal permohonan infomasi perizinan terkait rencana renovasi peroperti Kedutaan Besar Federasi Rusia seperti disampaikan.</p><p>Dinas Cipta Karya, Tata Ruang dan Pertanahan Provinsi DKI Jakarta telah menyampaikan surat kepada Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta Nomor e-0363/KR.04.00 tanggal 16 Maret 2026, yang memberikan informasi renovasi bangunan, dan memberikan nomor kontak informasi untuk bantuan langsung.</p><p>Biro Kerja Sama Daerah telah menyampaikan informasi dari Dinas Cipta Karya, Tata Ruang, dan Pertanahan melalui surat No. 2/KR.04.00 tanggal 8 April 2026 kepada Direktorat Fasilitas Diplomatik Direktorat Jenderal Protokol dan Konsuler, Kementerian Luar Negeri RI.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-02-24',
                'tanggal_selesai' => '2026-04-08', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW I',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 87, // Kedutaan Besar Republik Federal Somalia
                'kerjasama' => '<p>Permohonan izin pengibaran bendera Somalia di kantor Kedutaan Besar Somalia di Office 88, Kota Kasablanka</p>',
                'rangkuman' => '<p>Kedutaan Besar Somalia menyampaikan surat No 0340/BM-88/TH/III26 tanggal 17 Maret 2026 Kepada Badan Kesatuan Bangsa dan Politik hal permohonan izin pengibaran Bendera Somalia di Kota Kasablanka, sebagai lokasi baru Kedutaan Besar Republik Somalia.</p><p>Sebelumnya, Kedutaan Besar telah memiliki izin dari Kementerian Luar Negeri RI melalui Surat No. D/03643/11/2025 tanggal 18 Novermber 2025 untuk menempati Lantai 27, Unit G, Office 88, Jalan Casablanca Raya No. Kav. 88, Menteng Dalam, Tebet, Jakarta Selatan.</p><p>Izin ini didasarkan dari Surat Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta Nomor 6/KR.00.00 tanggal 17 November 2026 kepada Diraktur Fasilitas Diplomatik, Direktorat Jenderal Protokol dan Konsuler, Kementerian Luar Negeri RI hal informasi zonasi calon lokasi Kedutaan Besar Republik Somalia, dan surat Dinas Cipta Karya, Tata Ruang, dan Pertanahan No. e-1352/KR.00.00 tanggal 20 Oktober 2026 kepada Biro Kerja Sama Daerah hal tanggapan atas permohonan persetujuan zonasi.</p><p>Terkait hal ini, Biro Kerja Sama Daerah telah melaksanakan koordinasi dengan Office 88 dan Kementerian Luar Negeri RI berkenaan dengan pemasangan bendera.</p>',
                'catatan' => '<p>Pengibaran bendera sudah dilaksanakan pada tanggal 20 Juli 2026. Perlu koordinasi lanjutan dengan Office 88 dan Kedutaan Besar Somalia untuk mengatur kunjungan Badan Kesatuan Bangsa dan Politik dan/atau Kementerian Luar Negeri RI untuk melaksanakan kunjungan ke Kedutaan Besar Somalia</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-03-08',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 86, // Kedutaan Besar Republik Slovakia
                'kerjasama' => '<p>Permohonan penebangan pohon di sekitar kompleks hunian Kedutaan Besar Slovakia</p>',
                'rangkuman' => '<p>Kedutaan Besar Slovakia telah menyampaikan Nota Diplomatik Nomor 031407/2026-IDVV-1 tanggal 8 April 2026 kepada Direktorat Fasilitas Diplomatik Kementerian Luar Negeri RI cc. Kepala Biro Kerja Sama Daerah yang memohon bantuan untuk melakukan penebangan pohon-pohon yang sudah tua dan rapuh di sekitar Kompleks Hunian Diplomatik Slovakia, Jalan Daksa III No. 11, Kelurahan Selong, Kecamatan Kebayoran Baru, Jakarta Selatan. Surat ini disusul dengan Surat dari Kementerian Luar Negeri Republik Indonesia No. 04446/PK/04/2025/67 tanggal 10 April 2026.</p><p>Biro Kerja Sama Daerah mengirimkan surat No 6/TM/10.15 tanggal 10 April 2026 lepada Dinas Pertamanan dan Hutan Kota, dengan melakukan koordinasi awal untuk melaksanakan penyelidikan dan penanganan mengingat risiko di lokasi.</p><p>Permohonan telah dilaksanakan pada 8 April 2026.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-04-08',
                'tanggal_selesai' => '2026-04-10', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW II',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 78, // Kedutaan Besar Rumania
                'kerjasama' => '<p>Permohonan percepatan proses perizinan renovasi bangunan konsuler Kedutaan Besar Rumania di Jakarta</p>',
                'rangkuman' => '<p>Berdasarkan surat No. B-00037/Bucharest/260313 tanggal -- Maret 2026, dari Kedutaan Besar Republik Indonesia di Bucharest, disampaikan permohonan percepatan izin renovasi bangunan Kedutaan Besar Romania di Jakarta.</p><p>Koordinasi Biro Kerja Sama Daerah dengan Kementerian Luar Negeri RI pada tanggal 02 April 2026 menyampaikan bahwa izin terebut sudah diberikan oleh Dinas Cipta Karya, Tata Ruang, dan Pertanahan, melalui Persetujuan Bangunan Gedung -PBG No. SK-PBG-317107-09032026-010</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-04-14',
                'tanggal_selesai' => '2026-04-14', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW II',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 22, // Kedutaan Besar Republik Bulgaria
                'kerjasama' => '<p>Pernohonan izin pendirian kapel dan musala di Kedutaan Besar Bulgaria</p>',
                'rangkuman' => '<p>Direktorat Fasilitas Diplomatik telah menerima nota diplomatik Kedubes Republik Bulgaria No. 94/2026 tanggal 6 April 2026 yang menyampaikan permohonan Kedubes Republik Bulgaria untuk izin pendirian rumah ibadah (kapel & musala) di dalam premisnya.</p><p>Pada 15 April 2026, Biro KErja Sama Daerah telah menysampaikan persyratan peroleh Persetujuan Bangunan Gedung (PBG) dan narahubung serta alur perizinannya untuk bangunan dengan fungsi di atas melalui koordinasi via WhatsApp.</p><p>Kementerian Luar Negeri RI telah menyampaikan secara resmi persyaratan tersebut kepada Kedutaan Besar Republik Bulgaria melalui Surat No. D/01323/04.2026 tanggal 27 April 2026</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-04-15',
                'tanggal_selesai' => '2026-04-30', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW II',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 79, // Kedutaan Besar Federasi Rusia
                'kerjasama' => '<p>Permohonan penyelidikan atas kunjungan orang tak dikenal di properti Kedutaan Besar Rusia di Kelurahan Selong</p>',
                'rangkuman' => '<p>Berdasarkan Nota Diplomatik Kedubes Rusia nomor 882/И tanggal 31 Maret 2026 kepada Kementerian Luar Negeri, dan Surat Direktorat Fasilitasi Diplomatik Kementerian Luar Negeri RI ke Biro Kerja Sama Daerah nomor 0448/PK/04/2026/67 tanggal 10 April 2026, menyampaikan bahwa properti Kedutaan Besar Rusia di Jl. Adityawarman No. 33, Selong, Jakarta Selatan, telah didatangi oleh orang tak dikenal (OTK) yang mengaku sebagai pemilik properti.</p><p>Biro Kerja Sama Daerah telah mengirimkan Surat No. 70/HM.03.00 tanggal 22 April 2026 kepada Walikota Administrasi Jakarta Selatan dan telah melaksanakan Rapat Koordinasi tanggal 29 April 2026. Dalam rapat dimaksud telah dilakukan penelusuran oleh Kelurahan Selong dan diketahui bahwa pihak dimaksud telah menyampaikan pertanyaan secara tertulis kepada Kelurahan Selong, tanpa menyampaikan klaim kepemilikan. Berkenaan dengan hal tersebut, status kepemilikan Kedutaan Besar Federasi Rusia di Jl. Adityawarman No. 33 tidak dipermasalahkan. Meski demikian, Kelurahan Selong menyampaikan permohonan agar Kementerian Luar Negeri dapat menyampaikan, melalui Biro KSD, salinan dokumen kepemilikan atau keterangan resmi berkenaan dengan kepemilikan Kedutaan Besar Federasi Rusia terhadap properti tersebut. Hal ini akan diperlukan untuk pemutakhiran pencatatan atas properti Kedutaan Besar Federasi Rusia di Kelurahan Selong.</p><p>Hasil rapat koordinasi telah disampaikan kepada Kementerian Luar Negeri RI melalui Surat Biro Kerja Sama Daerah No. 13/RR.01.02 tanggal 7 Mei 2026</p>',
                'catatan' => '<p>Perlu koordinasi lanjutan dan update dari Kementerian Luar Negeri RI dan Kelurahan Selong.</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-04-20',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 22, // Kedutaan Besar Republik Bulgaria
                'kerjasama' => '<p>Permohonan izin pemasangan relief</p>',
                'rangkuman' => '<p>Berdasarkan Nota Diplomatik Kedubes Republik Bulgaria No. 73/2026 tanggal 11 Maret 2026 kepada Kementerian Luar Negeri RI dan Surat Kementerian Luar Negeri RI No 14956/PK/04-/2026/67 tanggal 21 April 2026 kepada Biro Kerja Sama Daerah, disampaikan bahwa Kedutaan Besar Bulgaria bermaksud memasang Relief Pahlawan Nasional Bulgaria pada bagian luar tembok gedung Kedutaan Besar.</p><p>Biro Kerja Sama Daerah menyampaikan Surat No 0/RR.01.02 tanggal 22 April 2026 kepada Dinas Cipta Karya, Tata Ruang, dan Pertanahan untuk memohon informasi pemasangan relief.</p><p>Dinas Cipta Karya, Tata Ruang, dan Pertanahan menyampaikan Surat No. e-0738/KR.04.00 tanggal 4 Juni 2026 kepada Biro Kerja Sama Daerah untuk menyampaikan bahwa izin tidak diperlukan.</p><p>Biro Kerja Sama Daerah menyampaikan surat kepada Kementerian Luar Negeri RI No. e-0214/HM.03.00 tanggal 5 Agustus 2026 untuk menyampaikan informasi Dinas Cipta Karya, Tata Ruang, dan Pertanahan.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-04-22',
                'tanggal_selesai' => '2026-08-05', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 27, // Kedutaan Besar Republik Demokratik Federal Ethiopia
                'kerjasama' => '<p>Permohonan pengecekan zonasi premis baru Kedutaan Besar Ethiopia</p>',
                'rangkuman' => '<p>Nota Diplomatik Kedutaan Besar Republik Demokratik Federal Ethiopia nomor EEJ/02/305/26 tanggal 24 April 2026 kepada Kementerian Luar Negeri RI menyampaikan rencana relokasi kanselerai (kantor kedutaan besar) Ethiopia ke alamat sebagai berikut: Jl. Patra Kuningan VIII No. 9, Kelurahan Kuningan Timur, Kecamatan Setiabudi, Kota Jakarta Selatan.</p><p>Rencana dimaksud disampaikan melalui surat dari Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri RI nomor 05177/PK/04/2026/67 tanggal 27 April 2026 kepada Biro Kerja Sama Daerah hal Permohonan informasi zonasi calon lokasi baru Kedutaan Besar Republik Demokratik Federal Ethiopia</p><p>Biro Kerja Sama Daerah mengirimkan Surat No 12/RR.01.02 tanggal 28 April 2026 kepada Dinas Cipta Karya, Tata Ruang, dan Pertanahan, yang dibalas dengan Surat Dinas Cipta Karya, Tata Ruang, dan Pertanahan No. e-0757/KR.00.00 tanggal 8 Juni 2026 yang menyampaikan bahwa kegiatan kanselerai pada lokasi baru dimaksud dapat dilaksanakan.</p><p>Melalui Surat No. e-0139/HM.03.00 tanggal 9 Juli 2026, Biro Kerja Sama Daerah menyampaikan jawaban Dinas Cipta Karya, Tata Ruang dan Pertanahan kepada Direktur Fasilitas Diplomatik, Direktorat Jenderal Protokol dan Konsuler, Kementerian Luar Negeri RI.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-04-27',
                'tanggal_selesai' => '2026-07-09', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 23, // Kedutaan Besar Republik Ceko
                'kerjasama' => '<p>Permohonan penataan instalasi kabel dan pembersihan sisa serpihan pohon tumbang di luar kompleks kediaman Kedutaan Besar Republik Ceko.</p>',
                'rangkuman' => '<p>Melalui</p><p>surat Kedutaan Besar Republik Ceko kepada Kemebnterian Luar Negeri RI No. 1180-1/2026-MZV/JAKA tanggal 6 Mei 2026, yang disampaikan kepada Biro Kerja Sama Daerah melalui Surat Direktur Fasilitas Diplomatik, Direktorat Jenderal Protokol dan Konsuler, No, 05985/PK/05/2026/67 tanggal 12 Mei 2026, disampaikan bahwa Kedutaan Besar Republik Ceko di Jakarta menyampaikan pengaduan terkait masalah kabel listrik, kabel telematika, dan serpihan pohon sisa perapihan di sekitar premis mereka di Jalan Gunawarman pada lokasi sekitar Jalan Daksa III dan Jalan Daksa IV No.2, Selong, Jakarta Selatan.</p><p>Pada rapat koordinasi tanggal 12 Mei 2026 yang dilaksanakan oleh Biro Kerja Sama Daerah, didapati bahwa:</p><p>Dinas Tenaga Kerja, Transmigrasi dan Energi Provinsi DKI Jakarta telah melaksanakan koordinasi awal dengan pihak Perusahaan Listrik Negara UID Jakarta Raya untuk menindaklanjuti pengaduan tersebut dan bahwa PLN UP 3 Bulungan telah melaksanakan survei untuk melaksanakan penindaklanjutan terhadap kabel.</p><p>Meski demikian, didapati bahwa di lokasi terdapat juga kabel telematika selain kabel listrik, dan kewenangan untuk penanganan dan/atau perapihan kabel telematika yang berada di atas tanah terletak di Dinas Bina Marga.</p><p>Kedutaan Besar Republik Ceko juga menyampaikan adanya sisa pohon/ranting yang jatuh di sekitar Kompleks Hunian Diplomatik. Berdasarkan informasi yang disampaikan, sisa pohon/ranting tersebut merupakan akibat kejadian pohon/ranting jatuh pada 15 Desember 2025 dan hingga saat ini belum dilakukan pembersihan.</p><p>Biro Kerja Sama Daerah telah mengirimkan permohonan penanganan melalui Surat No. 14/RR.01.01 tanggal 12 Mei 2026 kepada Dinas Bina Marga, Surat No. 7/RR.01.01 tanggal 12 Mei 2026 kepada Dinas Pertamanan dan Hutan Kota, dan No. 5/RR.01.01 tanggal 12 Mei 2026 kepada Dinas Tenaga Kerja, Transmigrasi, dan Energi.</p><p>Masalah kabel dilaporkan selesai pada 11-12 Mei 2026 oleh Dinas Tenaga Kerja, Transmigrasi, dan Energi, dan permasalahan pohon dilaporkan selesai ditangani pada 19 Mei 2026 oleh Dinas Pertamanan dan Hutan Kota.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-05-10',
                'tanggal_selesai' => '2026-05-19', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW II',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 57, // Kedutaan Besar Kerajaan Maroko
                'kerjasama' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Kerajaan Maroko, sekaligus penyampaikan permohonan untuk mengatasi permasalahan gangguan ketertiban karena iperasional 24 Jam Taman Mataram.</p>',
                'rangkuman' => '<p>Kedutaan Besar Kerajaan Maroko menyampaikan Surat No 706/2026 tanggal 4 Juni 2026 kepada Gubernur DKI Jakarta untuk memohon courtesy call.</p><p>Meski demikian, Kedutaan Besar Kerajaan Maroko juga telah mengirimkan Surat No 780/2026 tanggal 17 Juni 2026, berkenaan dengan keluhan terhadap jam operasional Taman Mataram selama 24 jam, yang menimbulkan gangguan di sekitar premis Kedutaan Besar.</p><p>Berkenaan dengan hal ini, Kelurahan Selong telah melaksanakan beberapa inisiatif yaitu:</p><p>1. Penertiban parkir dengan pemberlakuan larangan parkir bagi selain warga pada pukul 01.00–07.00 WIB disertai pemasangan rambu dan pemantauan oleh Dinas Perhubungan;</p><p>2. Penertiban pedagang, larangan merokok serta membawa minuman keras di kawasan taman yang diawasi Satpol PP;</p><p>3. Penguatan pengamanan kawasan melalui patroli FKDM, penambahan personel pendukung, usulan pembangunan pagar hidup, serta penambahan penerangan jalan;</p><p>4. Pengaturan akses Wi-Fi publik sehingga pada jam-jam rawan hanya digunakan untuk kebutuhan CCTV.</p><p>5. Sebagai upaya mitigasi tambahan, Kelurahan Selong akan memasang portal di sisi utara dan selatan akses Taman Mataram. Pemasangan ini akan dilaksanakan pada minggu pertama dan kedua bulan Juli 2026.</p><p>Penerimaan audiensi untuk Kedutaan Besar Kerajaan Maroko akan ditunda hingga penanganan permasalahan operasional di Taman Mataram diselesaikan.</p>',
                'catatan' => '<p>Perlu koordinasi terkait kemajuan penanganan masalah dan situasi di sekitar Kedutaan untuk saat ini.</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-07-02',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 5, // Kedutaan Besar Amerika Serikat
                'kerjasama' => '<p>Permohonan Pemangkasan Pohon di depan premis Kedutaan Besar Amerika Serikat di Jalan Wijaya II No. 36, Jakarta Selatan</p>',
                'rangkuman' => '<p>Surat Nomor 08618/PK/07/2026/67 tanggal 6 Juli 2026 dari Direktorat Fasilitas Diplomatik Kementerian Luar Negeri RI kepada Biro Kerja Sama Daerah, dan Nota Diplomatik dari Kedutaan Besar Amerika Serikat di Jakarta Nomor 001349 tanggal 30 Juni 2026, kepada Direktorat Fasilitas Diplomatik Kementerian Luar Negeri RI, menyampaikan permohonan pemangkasan pohon di depan premis diplomatik yang berlokasi di Jalan Wijaya II No. 36, Jakarta Selatan.</p><p>Permohonan tersebut diajukan guna mencegah potensi bahaya mengingat dahan pohon tersebut tumbuh masuk ke arah halaman premis diplomatik.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-07-06',
                'tanggal_selesai' => '2026-08-02', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 5, // Kedutaan Besar Amerika Serikat
                'kerjasama' => '<p>Permohonan Kedutaan Besar Amerika Serikat untuk Penanganan Pohon-Pohon di sekitar Premis Kedutaan Besar, Jl. Medan Merdeka Selatan No. 5, Jakarta Pusat.</p>',
                'rangkuman' => '<p>Surat Direktur Fasilitas Diplomatik Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri Republik Indonesia Nomor 09190/PK/07/2026/67 tanggal 15 Juli 2026 kepada Biro Kerja Sama Daerah, dan Nota Diplomatik dari Kedutaan Besar Amerika Serikat di Jakarta nomor 001457 tanggal 13 Juli 2026 kepada Kementerian Luar Negeri c.q. Direktorat Fasilitas Diplomatik, menyampaikan permohonan penanganan pohon-pohon di lingkungan sekitar premis Kedutaan Besar Amerika Serikat yaitu di bawah viaduk rel kereta api dan di jalan yang berdekatan dengan Kedutaan Besar Amerika Serikat di Jl, Medan Merdeka Selatan No. 5, Jakarta Pusat.</p><p>Terdapat pohon kering yang telah tumbang dan merusak pagar kawat Kedutaan Besar. Kedutaan Besar Amerika Serikat berharap kiranya unit terkait di Pemerintah Provinsi DKI Jakarta dapat melakukan inspeksi rutin atas kondisi pohon-pohon dimaksud dan melakukan langkah-langkah yang diperlukan untuk mengantisipasi potensi bahaya yang dapat muncul</p>',
                'catatan' => '<p>Cek dengan Dinas Pertamanan dan Hutan Kota, kapan selesai TL</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-07-19',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 5, // Kedutaan Besar Amerika Serikat
                'kerjasama' => '<p>Permohonan Informasi terkait Pekerjaan Peningkatan Jalan di Jalan Kebon Sirih, Jakarta Pusat</p>',
                'rangkuman' => '<p>Surat dari Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri RI nomor 09469/PK/07/2026/67 tanggal 21 Juli 2026 kepada Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta, dan Nota Diplomatik dari Kedutaan Besar Amerika Serikat (Kedubes AS) di Jakarta nomor 001521 kepada Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri RI tanggal 20 Juli 2026 menyampaikan bahwa Kedutaan Besar Amerika Serikat memohon infotmasi terkait Pemberitahuan Konstruksi yang berlangsung di Jalan Kebon Sirih, Jakarta Pusat.</p><p>Terkait hal tersebut, Biro Kerja Sama Daerah menyampaikan Surat No. e-0207/HM.03.00 tanggal 30 Juli 2026 kepada Direktur Fasilitas Diplomatik, Direktorat Jenderal Protokol dan Konsuler, Kementerian Luar Negeri RI, sebagai berikut:</p><p>1. Dinas Bina Marga Provinsi DKI Jakarta saat ini sedang melaksanakan pekerjaan peningkatan Jalan Kebon Sirih, Jakarta Pusat, yang berlangsung mulai tanggal 9 Juli hingga September 2026;</p><p>2. Pekerjaan dilaksanakan pada ruas Jalan Kebon Sirih sepanjang 345 meter, yaitu mulai dari Wisma Penta hingga Gedung Badan Nasional Pengelola Perbatasan Republik Indonesia (BNPP RI). Ruas jalan di luar segmen tersebut tidak termasuk dalam lingkup pekerjaan karena merupakan bagian dari rencana pembangunan kawasan Stasiun MRT.</p><p>3. Pekerjaan peningkatan jalan dilakukan dengan mengganti konstruksi perkerasan dari aspal menjadi beton (rigid pavement). Pemilihan metode tersebut didasarkan pada pertimbangan teknis, mengingat kondisi pondasi jalan yang sudah labil dan sering mengalami kerusakan berulang. Dengan penggunaan perkerasan beton diharapkan struktur jalan menjadi lebih kuat, memiliki umur layanan yang lebih panjang, serta meningkatkan keselamatan dan kenyamanan pengguna jalan.</p><p>4. Sebelum pelaksanaan pekerjaan dimulai, Dinas Bina Marga telah melaksanakan sosialisasi kepada masyarakat, pelaku usaha, dan perangkat daerah terkait pada awal Juli 2026, dan Dinas Perhubungan telah memohon penyebaran press release rekayasa lalu lintas kepada Dinas Komunikasi, Informatika, dan Statistik Pemerintah Provinsi DKI Jakarta melalui</p><p>Surat No. e-1151/PH.04.00 tanggal 6 Juli 2026. Pemberitahuan juga telah dimuat di situs Dinas Bina Marga pada tautan https://bit.ly/4fw95fU dan melalui media sosial Instagram Dinas Bina Marga pada tautan https://bit.ly/4fClPl9.</p><p>Pemberitahuan tidak secara spesifik diberikan kepada Kedutaan besar Amerika Serikat, adalah karena area pekerjaan tidak mencakup area di sekitar Kedutaan Besar Amerika Serikat.</p><p>5. Pelaksanaan pekerjaan dimaksud dilakukan secara bertahap per lajur, guna meminimalkan dampak terhadap lalu lintas. Berdasarkan masukan dari Kedutaan Besar Amerika Serikat yang telah disampaikan melalui Kementerian Luar Negeri RI sebagaimana diuraikan, Dinas Bina Marga akan melaksanakan percepatan terhadap kegiatan dimaksud dengan target penyelesaian pada September 2026.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-07-20',
                'tanggal_selesai' => '2026-07-30', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 56, // Kedutaan Besar Malaysia
                'kerjasama' => '<p>Permohonan peningkatan keamanan dan patroli di sekitar area Kedutaan Besar Malaysia</p>',
                'rangkuman' => '<p>Surat Kuasa Usaha Sementara Kedutaan Besar Malaysia di Jakarta Nomor SR (033) 151/14 tanggal 23 Juli 2026 kepada Kepala Kepolisian Polsek Metro Setiabudi menyampaikan Permohonan Peningkatan Pengamanan dan Patroli di Sekitar Area Kedutaan Besar Malaysia.</p><p>Hal ini disampaikan berkenaan dengan laporan Kedutaan Besar Malaysia kepada Kepolisian Sektor Metropolitan Setiabudi Resor Metropolitan Jakarta Selatan Polisi Daerah Metropolitan Jakarta Raya melalui Laporan Polisi Nomor LP/B/248/VII/2026/SKPT/Sek.Budi/Res.Jaksel/PMJ tanggal 4 Juli 2026 terkait dengan pencurian Jata Negara yang merupakan simbol resmi Pemerintah Malaysia.</p><p>Biro Kerja Sama Daerah telah menyampaikan Surat No. e-0201/HM.03.00 tanggal 28 Juli 2026 kepada Camat Setiabudi dan Lurah Karet Kuningan cc ke Walikota Kota Administrasi Jakarta Selatan hal Permohonan Peningkatan Pengamanan dan Patroli di Sekitar Area Kedutaan Besar Malaysia.</p><p>Peningkatan pengamanan telah dilaksanakan dan dilaporkan oleh Kelurahan Karet Kuningan melalui Surat No. 713/HM.03.00 tanggal 3 Agustus 2026 kepada Walikota Kota Administrasi Jakarta Selatan.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-07-23',
                'tanggal_selesai' => '2026-08-02', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 68, // Kedutaan Besar Palestina
                'kerjasama' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta sekaligus permohonan bantuan beautifikasi di sekitar Kedutaan Besar Palestina</p>',
                'rangkuman' => '<p>Kedutaan Besar Palestina menyampaikan permohonan audiensi kepada Gubernur DKI Jakarta melalui koordinasi langsung dengan Biro Kepala Daerah.</p><p>Audiensi dilaksanakan 8 Agustus 2026.</p><p>Selama audiensi dibahas beberapa hal, termasuk surat Direktur Fasilitas Diplomatik Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri Republik Indonesia Nomor 00954/PK/07/2026/67 tanggal 29 Juli 2026 perihal Permohonan Kedutaan Besar Palestina kepada Pemprov DKI Jakarta untuk melaksankan fasilitasi dan mendukung kegiatan Kedubes dalam rangka menyabut HUT RI ke-81, Kedutaan Besar Palestina bermaksud melaksanakan beautifikasi di sekitar wilayah Kedutaan dan memohon bantuan dari Pemerintah Provinsi DKI Jakarta.</p><p>Bantuan telah diberikan dan dilaksanakan pada 8 Agustus 2026.</p><p>Kedutaan Besar Palestina telah menyampaikan ucapan terima kasih No. EPJ/359/VIII/2026 tgl -- atas kerja sama yang diberikan Pemerintah Provinsi DKI Jakarta.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-07-29',
                'tanggal_selesai' => '2026-08-08', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 99, // Kedutaan Besar Turki
                'kerjasama' => '<p>Permohonan tindak lanjut pekerjaan trotoar di depan Kedutaan Besar Turkiye</p>',
                'rangkuman' => '<p>Melalui surat Plh. Direktur Fasilitas Diplomatik Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri Republik Indonesia Nomor 10713/PK/08/2025/67 tanggal 12 Agustus 2026 kepada Biro Kerja Sama Daerah dan Nota Diplomatik dari Kedutaan Besar (Kedubes) Türkiye di Jakarta No. Z-2026/1144727/42421827 – URGENT tanggal 12 Agustus 2026 kepada Kementerian Luar Negeri c.q. Direktorat Fasilitas Diplomatik, Kedutaan besar Turkiye memohon penyelesaian pekerjaan jalan di depan kantor Kedutaan Besar Turkiye.</p><p>Pekerjaan jalan telah berlangsung sejak April 2026, namun saat ini belum terselesaikan. Terdapat bekas kotoran pada dinding luar Kedubes serta billboard promosi milik Kedubes,</p><p>Berdasarkan hasil koordinasi Biro Kerja Sama Daerah Provinsi DKI Jakarta dengan Kedubes Türkiye, pihak Kedubes telah beberapa kali melakukan pengaduan ke pihak kontraktor, yaitu Jaya Konstruksi, namun permasalahan belum terselesaikan.</p><p>Biro Kerja Sama Daerah telah mengirimkan surat No. e-025/HM.03.00 tanggal 14 Agustus 2026 kepada Dinas Bina Marga Provinsi DKI Jakarta.</p><p>Penyelesaian pekerjaan telah dilaksanakan oleh Dinas Bina Marga pada 15 s.d. 18 Agustus 2026.</p>',
                'catatan' => null,
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-08-11',
                'tanggal_selesai' => '2026-08-18', // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Selesai',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
            [
                'id_kedutaan_besar' => 15, // Kedutaan Besar Kerajaan Belanda
                'kerjasama' => '<p>Permohonan Kedutaan Besar Belanda terkait perbaikan kondisi area pedestrian di Jl. Besakih dan Jl. Denpasar Raya, Jakarta Selatan.</p>',
                'rangkuman' => '<p>Berdasarkan Nota Diplomatik Kedutaan Besar Kerajaan Belanda No. JAK-0826/2026 tanggal 19 Agustus 2026 kepada Kementerian Luar Negeri RI, yang disampaikan kepada Biro Kerja Sama Daerah Melalui Surat Kementerian Luar Negeri RI Np. 10998/PK/08/2026/67 tanggal 20 Agustus 2026, Kedutaan Besar Kerajaan Belanda memohon agar dilakukan penebangan pohon dan perbaikan trotoar di dekat Jl. Besakih dan Jl. Denpasar Raya, Jakarta Selatan, sesuai dengan dokumentasi yang disampaikan.</p><p>Sesuai permohonan tersebut, Biro Kerja Sama Daerah melaksanakan rapat koordinasi pada tanggal 27 Agustus 2026.</p>',
                'catatan' => '<p>1. Kedutaan Besar Belanda akan diarahkan untuk memasukkan permohonan melalui Jakevo, dan Kelurahan Kuningan Timur serta Dinas Pertamanan dan Hutan Kota akan disurati untuk membantu fasilitasi Kedutaan Besar Belanda dalam memasukkan permohonan via Jakevo</p><p>2. Akan dijadwalkan survei lapangan mengundang Dinas Bina Marga, Dinas SDA, Dinas PTSP, Lurah. Camat, dan Walikota, untuk mengecek sejauh mana peningkatan kondisi trotoar dapat mungkin dilaksanakan dengan pasukan PPSU.</p><p>3. Minta kontak ke Kedutaan Besar Belanda.</p><p>Titik kumpul survei:</p><p>https://maps.app.goo.gl/esvXnBXrcpPhoSBz8</p><p>4. Akan dibuatkan surat lanjutan ke Dinas Bina Marga dan Dinas DSDA dan untuk peningkatan kondisi dengan PPSU.</p><p>5. Bagian yang tidak bisa ditangani PPSU berdasarkan hasil survei akan dinotadinaskan, agar tahun depan bisa dipertimbangkan untuk dianggarkan perapihan jalan melalui pemborongan di sekitar Jalan Denpasar dan Jalan Besakih.</p>',
                'file_dokumen' => null, // dikosongkan sesuai arahan
                'tanggal_diterima' => '2026-08-19',
                'tanggal_selesai' => null, // null jika sheet berisi "Berjalan"
                'triwulan_kerjasama' => 'TW III',
                'status_kerjasama' => 'Berjalan',
                'nama_pic' => null, // dikosongkan sesuai arahan
                'nomor_pic' => null, // dikosongkan sesuai arahan
                'is_active' => true, // kosong di sheet, di-default true
            ],
        ];

        foreach ($data as $item) {
            Kerjasama::create($item);
        }
    }
}
