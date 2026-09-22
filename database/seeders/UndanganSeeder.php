<?php

namespace Database\Seeders;

use App\Models\Undangan;
use App\Models\KedutaanBesar;
use App\Models\MisiAsingAsean;
use App\Models\MisiPermanenAsean;
use Illuminate\Database\Seeder;

class UndanganPart1Seeder extends Seeder
{
    /**
     * Sumber data: sheet "Undangan (UD)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - KHUSUS baris dengan mitra Kedutaan Besar, Misi Asing untuk
     * ASEAN, dan Misi Permanen ASEAN (modul mitra yang sudah tersedia).
     *
     * Baris dengan mitra Non Perwakilan Negara Asing (mis. Persatuan Insinyur
     * Indonesia, World Economic Forum, ITS Indonesia, PGRI, Taipei Economic
     * and Trade Office/TETO) TIDAK disimpan di sini karena modul/tabel Non
     * Perwakilan Negara Asing belum dibuat - lihat UndanganPart2Seeder.
     *
     * PENTING - relasi ke mitra:
     * Migration tb_undangan tetap menggunakan SATU kolom foreign key
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
     * Penyesuaian ejaan dari sheet acuan ke seeder mitra (migration/seeder
     * mitra sebagai sumber kebenaran):
     *   - "Kedutaan Besar FInlandia" (sheet, typo kapitalisasi) -> "Kedutaan Besar Finlandia" (seeder mitra)
     *   - "Kedutaan Besar Polandia" (sheet) -> "Kedutaan Besar Republik Polandia" (seeder mitra)
     *   - "Delegasi Uni Eropa" (sheet) -> "Misi Uni Eropa untuk ASEAN" (seeder mitra, tabel Misi Asing ASEAN)
     *
     * Field yang sengaja dikosongkan sesuai arahan: file_dokumen, nama_pic,
     * nomor_pic. Kolom catatan diseragamkan menjadi placeholder instruksi
     * untuk operator, menggantikan catatan tindak lanjut asli pada sheet.
     * Kolom "Data" (kode referensi dokumen internal) dan "Kontak" pada sheet
     * tidak disimpan karena tidak ada padanan kolom pada skema tb_undangan.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Kerajaan Belanda',
                'acara' => '<p>Undangan dari Kedutaan Besar Kerajaan Belanda untuk Menghadiri Sesi Informasi Proyek Pengembangan Rumah Sakit.</p>',
                'rangkuman' => '<p>Kedutaan Besar Kerajaan Belanda menyampaikan Surat No. JAK-1289/2025 tanggal 24 September 2025 untuk mengundang Gubernur DKI Jakarta, Kepala Badan Perencanaan Pembangunan Daerah, dan Kepala Dinas Kesehatan untuk menghadiri sesi informasi pada tanggal 27 Januari 2026 di Auditorium Utama Erasmus Huis. Sesi ini bertujuan agar perusahaan-perusahaan Belanda dapat memahami proyek pengembangan rumah sakit di bawah Kementerian Kesehatan serta Kementerian Pendidikan Tinggi, Sains, dan Teknologi.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-05',
                'tanggal_selesai' => '2026-01-26',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Siprus',
                'acara' => '<p>Undangan Konser Piano dalam rangka merayakan presidensi Republik Siprus di Dewan Uni Eropa (European Union Council)</p>',
                'rangkuman' => '<p>Kedutaan Besar Republik Siprus mengundang Gubernur DKI Jakarta untuk mengadiri konser pianis muda asal Siprus, Ms. Anna Avramidou, pada tanggal 19 Januari 2026 di J.S. Bach Recital Hall. Konser ini dllaksanakan dalam rangka merayakan presidensi Republik Siprus di Dewan Uni Eropa (European Union Council)</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-11',
                'tanggal_selesai' => '2026-01-19',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Amerika Serikat',
                'acara' => '<p>Undangan dari The Minister Counselor for Public Diplomacy of the United States of America to the Republic of Indonesia Mr. Jason P. Rebholz.</p>',
                'rangkuman' => '<p>Kepala Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta diundang oleh The Minister Counselor for Public Diplomacy of the United States of America to the Republic of Indonesia, Mr. Jason P. Rebholz, untuk menghadiri Education Partnership Reception di the @america, 3rd floor Pacific Place Mall, Jakarta, pada Rabu, 21 Januari 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-20',
                'tanggal_selesai' => '2026-01-21',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Hungaria',
                'acara' => '<p>Undangan menghadiri acara konser Musik Rakyat Hungaria</p>',
                'rangkuman' => '<p>Melalui Surat No. KKM/8723/2026/Adm tanggal 6 Maret 2026, Duta Besar Hungaria kepada mengundang Gubernur DKI Jakarta untuk menghadiri acara Konser Musik Rakyat Hungaria (Hungarian Folklore Music Concert) yang diselenggarakan pada Apr 01, 2026. Kehadiran acara ini idisposisikan kepada Dinas Kebudayaan Provinsi DKI Jakarta</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-06',
                'tanggal_selesai' => '2026-04-01',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Perancis',
                'acara' => '<p>Undangan dari Dinas Kebudayaan untuk menghadiri rapat pertukaran pandangan terkait inisiatif dan potensi kerja sama antara Kedutaan Besar Perancis dan Dinas Kebudayaan</p>',
                'rangkuman' => '<p>Melalui undangan No. e-0083/KB.05.03 tanggal 9 April 2026, Dinas Kebudayaan mengundang sejumlah Perangkat Daerah untuk melaksanakan pertemuan dan diskusi dalam rangka kunjungan delegasi Perancis di bawah program ICC Immersion Indonesia.</p><p>Undangan telah dihadiri Biro Kerja Sama Daerah pada 13 April 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-09',
                'tanggal_selesai' => '2026-04-13',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Malaysia',
                'acara' => '<p>Undangan sekaligus permohonan Audiensi kepada Gubernur DKI Jakarta dari Kedutaan Malaysia, memohon Courtesy Call untuk Menteri Besar Negeri Kelantan dan hadir di acara Kelantan Day.</p>',
                'rangkuman' => '<p>Berdasarkan Nota Diplomatik Kedutaan Besar Malaysia Nomor AT220/2026 tanggal 23 April 2026 kepada Kementerian Luar Negeri RI dan Surat Kuasa Usaha Sementara Kedutaan Besar Malaysia Nomor SR (033) 686/2 Jld.2 tanggal 23 April 2026 kepada Biro Kerja Sama Daerah DKI Jakarta, Kedutaan Besar Malaysia menyampaikan permohonan kepada Bapak Gubernur DKI Jakarta untuk:</p><p>Menerima kunjungan kehormatan (courtesy call) Menteri Besar Negara Bagian Kelantan kepada Gubernur DKI Jakarta pada hari Rabu, 13 Mei 2026 pukul 10:00 WIB untuk mempererat hubungan silaturahmi, membahas perkembangan hubungan bilateral antara Kerajaan Malaysia dan Republik Indonesia, serta menjajaki potensi kerja sama khususnya antara Negara Bagian Kelantan dan Provinsi DKI Jakarta.</p><p>Menghadiri dan memberikan sambutan pada kegiatan program Kelantan Day pada hari Kamis, 14 Mei 2026 pukul 09:00 WIB di Hotel Four Points by Sheraton Jakarta, Thamrin. Program ini diselenggarakan bertepatan dengan peluncuran penerbangan langsung AirAsia rute Kota Bharu–Jakarta yang dijadwalkan mulai beroperasi pada Juni 2026, yang diharapkan dapat meningkatkan aktivitas pariwisata dan kunjungan masyarakat</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-23',
                'tanggal_selesai' => '2026-05-14',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_misi_asing_asean_id' => 'Misi Uni Eropa untuk ASEAN',
                'acara' => '<p>Undangan menghadiri Europe Day 2026</p>',
                'rangkuman' => '<p>Duta Besar Uni Eropa mengundang Gubernur DKI Jakarta untuk menghadiri Perayaan Europe Day 2026 pada tanggal 7 Mei 2026.</p><p>Acara telah dihadiri oleh Wakil Gubernur.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-26',
                'tanggal_selesai' => '2026-05-07',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Finlandia',
                'acara' => '<p>Undangan kepada Gubernur DKI Jakarta untuk menghadiri Nordic Night 2026</p>',
                'rangkuman' => '<p>Melalui surat tanggal 4 Mei 2026, Duta Besar Finlandia mengundang Gubernur DKI Jakarta untuk menghadiri Nordic Nights 2026. Undangan didisposisikan dan dihadiri oleh Wakil Gubernur DKI Jakarta.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-05-04',
                'tanggal_selesai' => '2026-05-06',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Polandia',
                'acara' => '<p>Undangan National Day Polandia</p>',
                'rangkuman' => '<p>Melalui undangan yang disampaikan tanggal 12 Mei 2026, Kedutaan Besar Polandia mengundang Gubernur DKI Jakarta untuk menghadiri National Day Polandia. Acara dihadiri oleh Kepala Bagian Kerja Sama Luar Negeri Biro Kerja Sama Daerah.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-05-11',
                'tanggal_selesai' => '2026-05-12',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Georgia',
                'acara' => '<p>Undangan menghadiri perayaan Hari Kemendekaan Georgia 2026</p>',
                'rangkuman' => '<p>Melalui undangan yang disampaikan tanggal 19 Mei 2026, Gubernur DKI Jakarta dan Kepala Biro Kerja Sama Daerah diundang oleh Kedutaan Besar Georgia untuk menghadiri perayaan Hari Kemerdekaan Georgia. Undangan didisposisi dan dihadiri oleh Sub-Kelompok Fasilitasi Korps Diplomatik.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-05-19',
                'tanggal_selesai' => '2026-05-26',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Hungaria',
                'acara' => '<p>Permohonan kolaborasi pameran Threads of Wax, sekaligus undangan kepada Gubernur DKI Jakarta untuk menghadiri pembukaan pameran.</p>',
                'rangkuman' => '<p>Melalui Surat No. KUM/18688/2026/ADM tanggal 9 Juni 2026 Kepada Gubernur DKI Jakarta, Kedutaan Besar Hungaria menyampaikan permohonan untuk meggunakan Museum Seni dan Keramik sebagai venue pameran Threads of Wax, yang merupakan pameran kolaborasi tekstil sulam Hungaria dan batik. Sehubungan dengan ini, Kedutaan Besar Hungaria memohon bantuan fasilitasi dari Biro Kerja Sama Daerah, dan saran terkait mengaitkan acara dimaksud dengan perayaan 499 tahun Ulang Tahun Jakarta.</p><p>Dukungan fasilitasi telah diberikan, dan pembukaan acara dihadiri oleh Gubernur DKI Jakarta pada 29 Juni 2026.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-10',
                'tanggal_selesai' => '2026-06-29',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Uruguay',
                'acara' => '<p>Undangan menghadiri pembukaan Panoramica, Eksibisi Seni Uruguay, pada 4 Juni 2026</p>',
                'rangkuman' => '<p>Melalui Undangan yang disampaikan melalui Koordinasi WhatsApp tanggal 25 Mei 2026, Kedutaan Besar Uruguay mengundang Ketua Sub-Kelompok Fasilitasi Korps Diplomatik untuk menghadiri pembukaan Panoramica, Eksibisi Seni Uruguay, pada tanggal 4 Juni 2026 di Galeri Nasional Indonesia. Eksibisi sendiri akan dilaksanakan dari tanggal 4 s.d. 28 Juni 2026 .</p><p>Undangan telah dihadiri oleh Ketua Sub-Kelompok Fasilitasi Korps Diplomatik, Biro Kerja Sama Daerah.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-04',
                'tanggal_selesai' => '2026-06-04',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Australia',
                'acara' => '<p>Undangan kepada Gubernur DKI Jakarta untuk melaksanakan kunjungan ke Sydney .</p>',
                'rangkuman' => '<p>Melalui surat tanggal 29 April 2026 kepada Gubernur DKI Jakarta, Duta Besar Australia menyampaikan undangan untuk berkunjung ke Sydney.</p><p>Pada tanggal 2 April 2026, Bapak Gubernur Provinsi DKI Jakarta menerima audiensi Duta Besar Australia untuk Indonesia di Balai Kota Provinsi DKI Jakarta. Sebagai tindak lanjut pertemuan tersebut, Duta Besar Australia mengundang Bapak Gubernur untuk melaksanakan kunjungan ke Sydney guna mempelajari pengembangan Sydney Metro, pengalaman Pemerintah New South Wales dalam pembangunan transportasi publik melalui skema Public Private Partnership (PPP), serta menjajaki peluang kerja sama di bidang infrastruktur.</p><p>Menindaklanjuti undangan tersebut, Biro Kerja Sama Daerah telah menyelenggarakan rapat koordinasi pada tanggal 11 Juni 2026 yang dihadiri oleh perwakilan Kedutaan Besar Australia, Investment NSW, Kemitraan Indonesia Australia untuk Infrastruktur (KIAT), Department of Foreign Affairs and Trade (DFAT), Badan Perencanaan Pembangunan Daerah Provinsi DKI Jakarta, PT MRT Jakarta, dan perangkat daerah terkait.</p><p>Hasil rapat telah disampaikan dalam Telaahan Staf No 6.2/KLN/VII/2026 tanggal 6 Juli 2026 dari Kepala Bagian Kerja Sama Luar Negeri ke Kepala Biro Kerja Sama Daerah, yang didisposisi tanggal 7 Juli 2026. Hasil disposisi telah diibuat dalam Nota Dinas telaahan kepada Gubernur DKI Jakarta, yang telah dilaporkan kepada Kepala Bagian Luar Negeri.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-29',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Swedia',
                'acara' => '<p>Permohonan audiensi dan undangan untuk menghadiri acara Sweden-Indonesia Sustainability Partnership, Resepsi Diplomatik dalam rangka kunjungan HRH Victoria Ingrid, Putri Mahkota Swedia, dan Eksibisi Tyra Kleen.</p>',
                'rangkuman' => '<p>Melalui Surat No 084/AMNB/VII/2026 tanggal 20 Juli 2026, Duta Besar Swedia memohon Audiensi kepada Gubernur DKI Jakarta untuk membahas pelaksanaan acara Sweden-Indonesia Sustainability Partnership (SISP) Conference on Business Delegation pada tanggal 8 s.d. 10 September 2026, yang dirangkaikan dengan Tyra Kleen Art Exhibition pada tanggal, 8 September 2026. Acara ini juga bertepatan dengan kunjungan HRH Victoria Ingrid, Putri Mahkota Swedia.</p><p>Undangan untuk menghadiri kedua acara tersebut juga telah disampaikan melalui Surat No. 113/AMB/VIII/2026 tanggal 13 Agustus 2026 kepada Gubernur DKI Jakarta, dengan rincian:</p><p>1. Menghadiri resepsi diplomatik yang dihadiri oleh HRH Victoria Ingrid, Putri Mahkota Swedia --- 7 September 2026, 19:00 - 21:00 WIB</p><p>2. Menghadiri pembukaan Tyra Kleen Art Exhibition --- 8 September 2026, 12:00 s.d. 13:00 WIB di UP, Thamrin Nine.</p><p>3. Menghadiri Closed-door Bilateral Meeting dengan Menteri Luar Negeri Swedia --- 8 September 2026, 13:30 s.d. 14:30 WIB di Park Hyatt Jakarta.</p><p>Audiensi telah dijadwalkan, tetapi tidak dapat dilaksanakan karena letusan gunung Anak Krakatau membuat penerbangan HRH Victoria dari Lombok ke Jakarta ditunda.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-22',
                'tanggal_selesai' => '2026-09-09',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Regret',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Singapura',
                'acara' => '<p>Menghadiri Perayaan Singapore Day, 19 Agustus 2026</p>',
                'rangkuman' => '<p>Melalui Undangan No. -- tanggal 5 Agustus 2026, Kedutaan Besar Singapura mengundang Gubernur DKI Jakarta untuk menghadiri ulang tahun ke-61 National Day Republik Singapura</p><p>Acara dihadiri oleh Kepala Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-05',
                'tanggal_selesai' => '2026-08-19',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Kerajaan Belanda',
                'acara' => '<p>Undangan untuk menghadiri upacara memperingati berakhirnya Perang Dunia Kedua di Asia dan Pasifik.</p>',
                'rangkuman' => '<p>Melalui Surat No. -- tanggal 17 Juli 2026, Kedutaan Besar Kerajaan Belanda di Indonesia hendak mengadakan upacara untuk memperingati berakhirnya Perang Dunia Kedua di Asia dan Pasifik. Undangan ditujukan kepada Gubernur DKI Jakarta dan Kepala Biro Kerjasama Daerah untuk menghadiri upacara dan meletakkan karangan bunga pada hari Sabtu, 15 Agustus 2026 pukul 16:30, di Makam Perang Belanda di Menteng Pulo, Jakarta.</p><p>Acara telah dihadiri oleh Kepala Bagian Kerja Sama Luar Negeri dan Ketua Sub-Kelompok Fasilitasi Korps Diplomatik</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-07',
                'tanggal_selesai' => '2026-08-15',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Ukraina',
                'acara' => '<p>Menghadiri Eksibisi Living The War: Children Dalam Kaitannya dengan Ulang Tahun Ke-35 Proklamasi Kemerdekaan Ukraina</p>',
                'rangkuman' => '<p>Melalui Undangan No. -- tanggal 21 Agustus 2026, Kedutaan Besar Ukraina mengundang Gubernur DKI Jakarta untuk menghadiri Eksibisi Living The War: Children Dalam Kaitannya dengan Ulang Tahun Ke-35 Proklamasi Kemerdekaan Ukraina, pada tanggal 24 Agustus 2026</p><p>Acara dihadiri oleh Kepala Bagian kerja Sama Luar Negeri, BIro KSD Setda Provinsi DKI Jakarta.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-21',
                'tanggal_selesai' => '2026-08-24',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Malaysia',
                'acara' => '<p>Undangan menghadiri resepsi Hari Nasional dan Malaysia Day 2026</p>',
                'rangkuman' => '<p>Melalui Undangan No. -- tanggal 24 Agustus 2026, Kedutaan Besar Malaysia mengundang Gubernur DKI Jakarta dan Wakil Gubernur DKI Jakarta untuk menghadiri esepsi Hari Nasional dan Malaysia Day 2026 tanggal 15 Septemberi 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-24',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Kerajaan Spanyol',
                'acara' => '<p>Permohonan undangan untuk menghadiri acara "Malangan: A Legacy That Refuses to Vanish."</p>',
                'rangkuman' => '<p>Melalui Surat No. -- tanggal 6 Agustus 2026, Duta Besar Kerajaan Spanyol mengundang Gubernur DKI Jakarta untuk menghadiri eksibisi "Malangan: A Legacy That Refuses to Vanish" pada tanggal 2 September 2026 di Museum Seni dan Keramik DKI Jakarta.</p><p>Acara telah dilaksanakan dan dihadiri oleh Kepala UP Museum Keramik.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen undangan',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-25',
                'tanggal_selesai' => '2026-09-02',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Selesai',
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

            Undangan::create([
                'id_mitra' => $idMitra,
                ...$item,
                'is_active' => true,
            ]);
        }
    }
}
