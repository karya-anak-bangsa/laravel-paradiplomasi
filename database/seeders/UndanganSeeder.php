<?php

namespace Database\Seeders;

use App\Models\Undangan;
use Illuminate\Database\Seeder;

class UndanganSeeder extends Seeder
{

    // id_kedutaan_besar di bawah ini mengikuti urutan insert KedutaanBesarPart1-6Seeder
    // JANGAN ubah urutan/isi seeder Kedutaan Besar tanpa menyesuaikan id di sini
    // Sumber data: Google Sheet Kasubag, tab Undangan (hanya undangan dari Kedutaan Besar, mitra non-kedutaan di-skip)
    // acara/rangkuman/catatan WYSIWYG: tiap baris baru di cell sheet jadi <p> terpisah

    public function run(): void
    {
        $data = [
            [
                'id_kedutaan_besar' => 15, // Kedutaan Besar Kerajaan Belanda
                'acara' => '<p>Undangan dari Kedutaan Besar Kerajaan Belanda untuk Menghadiri Sesi Informasi Proyek Pengembangan Rumah Sakit.</p>',
                'rangkuman' => '<p>Kedutaan Besar Kerajaan Belanda menyampaikan Surat No. JAK-1289/2025 tanggal 24 September 2025 untuk mengundang Gubernur DKI Jakarta, Kepala Badan Perencanaan Pembangunan Daerah, dan Kepala Dinas Kesehatan untuk menghadiri sesi informasi pada tanggal 27 Januari 2026 di Auditorium Utama Erasmus Huis. Sesi ini bertujuan agar perusahaan-perusahaan Belanda dapat memahami proyek pengembangan rumah sakit di bawah Kementerian Kesehatan serta Kementerian Pendidikan Tinggi, Sains, dan Teknologi.</p>',
                'catatan' => '<p>Biro Kerja Sama Daerah dapat berkoordinasi dengan Badan Perencanaan Pembangunan Daerah dan Dinas Kesehatan untuk mengetahui hasil kehadiran.</p>',
                'tanggal_diterima' => '2026-01-05',
                'tanggal_selesai' => '2026-01-26',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Badan Perencanaan Pembangunan Daerah Dinas Kesehatan',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 5, // Kedutaan Besar Amerika Serikat
                'acara' => '<p>Undangan dari The Minister Counselor for Public Diplomacy of the United States of America to the Republic of Indonesia Mr. Jason P. Rebholz.</p>',
                'rangkuman' => '<p>Kepala Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta diundang oleh The Minister Counselor for Public Diplomacy of the United States of America to the Republic of Indonesia, Mr. Jason P. Rebholz, untuk menghadiri Education Partnership Reception di the @america, 3rd floor Pacific Place Mall, Jakarta, pada Rabu, 21 Januari 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-01-20',
                'tanggal_selesai' => '2026-01-21',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'IqbalM2@state.gov',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 85, // Kedutaan Besar Republik Siprus
                'acara' => '<p>Undangan Konser Piano dalam rangka merayakan presidensi Republik Siprus di Dewan Uni Eropa (European Union Council)</p>',
                'rangkuman' => '<p>Kedutaan Besar Republik Siprus mengundang Gubernur DKI Jakarta untuk mengadiri konser pianis muda asal Siprus, Ms. Anna Avramidou, pada tanggal 19 Januari 2026 di J.S. Bach Recital Hall. Konser ini dllaksanakan dalam rangka merayakan presidensi Republik Siprus di Dewan Uni Eropa (European Union Council)</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-01-11',
                'tanggal_selesai' => '2026-01-19',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Ms. Karina Isvari, Kedutaan Besar Republik Siprus, secretariatjakarta@mfa.gov.cy',
                'nomor_pic' => '021-25546251, +62 811-8484-483',
            ],
            [
                'id_kedutaan_besar' => 33, // Kedutaan Besar Hungaria
                'acara' => '<p>Undangan menghadiri acara konser Musik Rakyat Hungaria</p>',
                'rangkuman' => '<p>Melalui Surat No. KKM/8723/2026/Adm tanggal 6 Maret 2026, Duta Besar Hungaria kepada mengundang Gubernur DKI Jakarta untuk menghadiri acara Konser Musik Rakyat Hungaria (Hungarian Folklore Music Concert) yang diselenggarakan pada Apr 01, 2026. Kehadiran acara ini idisposisikan kepada Dinas Kebudayaan Provinsi DKI Jakarta</p>',
                'catatan' => '<p>Follow-up dari audiensi Kedutaan Besar Hungaria 29 Januari 2026</p>',
                'tanggal_diterima' => '2026-03-06',
                'tanggal_selesai' => '2026-04-01',
                'triwulan_undangan' => 'TW I',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Hungaria',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 101, // Delegasi Uni Eropa
                'acara' => '<p>Undangan menghadiri Europe Day 2026</p>',
                'rangkuman' => '<p>Duta Besar Uni Eropa mengundang Gubernur DKI Jakarta untuk menghadiri Perayaan Europe Day 2026 pada tanggal 7 Mei 2026.</p><p>Acara telah dihadiri oleh Wakil Gubernur.</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-04-26',
                'tanggal_selesai' => '2026-05-07',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Delegasi Uni Eropa',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 71, // Kedutaan Besar Perancis
                'acara' => '<p>Undangan dari Dinas Kebudayaan untuk menghadiri rapat pertukaran pandangan terkait inisiatif dan potensi kerja sama antara Kedutaan Besar Perancis dan Dinas Kebudayaan</p>',
                'rangkuman' => '<p>Melalui undangan No. e-0083/KB.05.03 tanggal 9 April 2026, Dinas Kebudayaan mengundang sejumlah Perangkat Daerah untuk melaksanakan pertemuan dan diskusi dalam rangka kunjungan delegasi Perancis di bawah program ICC Immersion Indonesia.</p><p>Undangan telah dihadiri Biro Kerja Sama Daerah pada 13 April 2026</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-04-09',
                'tanggal_selesai' => '2026-04-13',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Dinas Kebudayaan',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 56, // Kedutaan Besar Malaysia
                'acara' => '<p>Undangan sekaligus permohonan Audiensi kepada Gubernur DKI Jakarta dari Kedutaan Malaysia, memohon Courtesy Call untuk Menteri Besar Negeri Kelantan dan hadir di acara Kelantan Day.</p>',
                'rangkuman' => '<p>Berdasarkan Nota Diplomatik Kedutaan Besar Malaysia Nomor AT220/2026 tanggal 23 April 2026 kepada Kementerian Luar Negeri RI dan Surat Kuasa Usaha Sementara Kedutaan Besar Malaysia Nomor SR (033) 686/2 Jld.2 tanggal 23 April 2026 kepada Biro Kerja Sama Daerah DKI Jakarta, Kedutaan Besar Malaysia menyampaikan permohonan kepada Bapak Gubernur DKI Jakarta untuk:</p><p>Menerima kunjungan kehormatan (courtesy call) Menteri Besar Negara Bagian Kelantan kepada Gubernur DKI Jakarta pada hari Rabu, 13 Mei 2026 pukul 10:00 WIB untuk mempererat hubungan silaturahmi, membahas perkembangan hubungan bilateral antara Kerajaan Malaysia dan Republik Indonesia, serta menjajaki potensi kerja sama khususnya antara Negara Bagian Kelantan dan Provinsi DKI Jakarta.</p><p>Menghadiri dan memberikan sambutan pada kegiatan program Kelantan Day pada hari Kamis, 14 Mei 2026 pukul 09:00 WIB di Hotel Four Points by Sheraton Jakarta, Thamrin. Program ini diselenggarakan bertepatan dengan peluncuran penerbangan langsung AirAsia rute Kota Bharu–Jakarta yang dijadwalkan mulai beroperasi pada Juni 2026, yang diharapkan dapat meningkatkan aktivitas pariwisata dan kunjungan masyarakat</p>',
                'catatan' => '<p>Sekaligus juga menyampaikan permohonan audiensi.</p>',
                'tanggal_diterima' => '2026-04-23',
                'tanggal_selesai' => '2026-05-14',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Malaysia',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 10, // Kedutaan Besar Australia
                'acara' => '<p>Undangan kepada Gubernur DKI Jakarta untuk melaksanakan kunjungan ke Sydney .</p>',
                'rangkuman' => '<p>Melalui surat tanggal 29 April 2026 kepada Gubernur DKI Jakarta, Duta Besar Australia menyampaikan undangan untuk berkunjung ke Sydney.</p><p>Pada tanggal 2 April 2026, Bapak Gubernur Provinsi DKI Jakarta menerima audiensi Duta Besar Australia untuk Indonesia di Balai Kota Provinsi DKI Jakarta. Sebagai tindak lanjut pertemuan tersebut, Duta Besar Australia mengundang Bapak Gubernur untuk melaksanakan kunjungan ke Sydney guna mempelajari pengembangan Sydney Metro, pengalaman Pemerintah New South Wales dalam pembangunan transportasi publik melalui skema Public Private Partnership (PPP), serta menjajaki peluang kerja sama di bidang infrastruktur.</p><p>Menindaklanjuti undangan tersebut, Biro Kerja Sama Daerah telah menyelenggarakan rapat koordinasi pada tanggal 11 Juni 2026 yang dihadiri oleh perwakilan Kedutaan Besar Australia, Investment NSW, Kemitraan Indonesia Australia untuk Infrastruktur (KIAT), Department of Foreign Affairs and Trade (DFAT), Badan Perencanaan Pembangunan Daerah Provinsi DKI Jakarta, PT MRT Jakarta, dan perangkat daerah terkait.</p><p>Hasil rapat telah disampaikan dalam Telaahan Staf No 6.2/KLN/VII/2026 tanggal 6 Juli 2026 dari Kepala Bagian Kerja Sama Luar Negeri ke Kepala Biro Kerja Sama Daerah, yang didisposisi tanggal 7 Juli 2026. Hasil disposisi telah diibuat dalam Nota Dinas telaahan kepada Gubernur DKI Jakarta, yang telah dilaporkan kepada Kepala Bagian Luar Negeri.</p>',
                'catatan' => '<p>Cek ulang status surat, apakah sudah diajukan, batal, atau tunda.</p>',
                'tanggal_diterima' => '2026-04-29',
                'tanggal_selesai' => null,
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Berjalan',
                'nama_pic' => 'Kedutaan Besar Australia.',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 30, // Kedutaan Besar FInlandia
                'acara' => '<p>Undangan kepada Gubernur DKI Jakarta untuk menghadiri Nordic Night 2026</p>',
                'rangkuman' => '<p>Melalui surat tanggal 4 Mei 2026, Duta Besar Finlandia mengundang Gubernur DKI Jakarta untuk menghadiri Nordic Nights 2026. Undangan didisposisikan dan dihadiri oleh Wakil Gubernur DKI Jakarta.</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-05-04',
                'tanggal_selesai' => '2026-05-06',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Finlandia',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 31, // Kedutaan Besar Georgoa
                'acara' => '<p>Undangan menghadiri perayaan Hari Kemendekaan Georgia 2026</p>',
                'rangkuman' => '<p>Melalui undangan yang disampaikan tanggal 19 Mei 2026, Gubernur DKI Jakarta dan Kepala Biro Kerja Sama Daerah diundang oleh Kedutaan Besar Georgia untuk menghadiri perayaan Hari Kemerdekaan Georgia. Undangan didisposisi dan dihadiri oleh Sub-Kelompok Fasilitasi Korps Diplomatik.</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-05-19',
                'tanggal_selesai' => '2026-05-26',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Ms. Ladia, Kedutaan Besar Georgia',
                'nomor_pic' => '+62 895-3267-26057',
            ],
            [
                'id_kedutaan_besar' => 74, // Kedutaan Besar Polandia
                'acara' => '<p>Undangan National Day Polandia</p>',
                'rangkuman' => '<p>Melalui undangan yang disampaikan tanggal 12 Mei 2026, Kedutaan Besar Polandia mengundang Gubernur DKI Jakarta untuk menghadiri National Day Polandia. Acara dihadiri oleh Kepala Bagian Kerja Sama Luar Negeri Biro Kerja Sama Daerah.</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-05-11',
                'tanggal_selesai' => '2026-05-12',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Polandia',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 33, // Kedutaan Besar Hungaria
                'acara' => '<p>Permohonan kolaborasi pameran Threads of Wax, sekaligus undangan kepada Gubernur DKI Jakarta untuk menghadiri pembukaan pameran.</p>',
                'rangkuman' => '<p>Melalui Surat No. KUM/18688/2026/ADM tanggal 9 Juni 2026 Kepada Gubernur DKI Jakarta, Kedutaan Besar Hungaria menyampaikan permohonan untuk meggunakan Museum Seni dan Keramik sebagai venue pameran Threads of Wax, yang merupakan pameran kolaborasi tekstil sulam Hungaria dan batik. Sehubungan dengan ini, Kedutaan Besar Hungaria memohon bantuan fasilitasi dari Biro Kerja Sama Daerah, dan saran terkait mengaitkan acara dimaksud dengan perayaan 499 tahun Ulang Tahun Jakarta.</p><p>Dukungan fasilitasi telah diberikan, dan pembukaan acara dihadiri oleh Gubernur DKI Jakarta pada 29 Juni 2026.</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-06-10',
                'tanggal_selesai' => '2026-06-29',
                'triwulan_undangan' => 'TW II',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Kedutaan Besar Hungaria',
                'nomor_pic' => null,
            ],
            [
                'id_kedutaan_besar' => 15, // Kedutaan Besar Kerajaan Belanda
                'acara' => '<p>Undangan untuk menghadiri upacara memperingati berakhirnya Perang Dunia Kedua di Asia dan Pasifik.</p>',
                'rangkuman' => '<p>Melalui Surat No. -- tanggal 17 Juli 2026, Kedutaan Besar Kerajaan Belanda di Indonesia hendak mengadakan upacara untuk memperingati berakhirnya Perang Dunia Kedua di Asia dan Pasifik. Undangan ditujukan kepada Gubernur DKI Jakarta dan Kepala Biro Kerjasama Daerah untuk tuk menghadiri upacara dan meletakkan karangan bunga pada hari Sabtu, 15 Agustus 2026 pukul 16:30, di Makam Perang Belanda di Menteng Pulo, Jakarta.</p><p>Acara telah dihadiri oleh Kepala Bagian Kerja Sama Luar Negeri dan Ketua Sub-Kelompok Fasilitasi Korps Diplomatik</p>',
                'catatan' => null,
                'tanggal_diterima' => '2026-08-07',
                'tanggal_selesai' => '2026-08-15',
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Selesai',
                'nama_pic' => 'Ms Wita Hana Pertiwi, Staf Atase Pertahanan Belanda',
                'nomor_pic' => '+62 811-1301-0449',
            ],
            [
                'id_kedutaan_besar' => 93, // Kedutaan Besar Swedia
                'acara' => '<p>Permohonan audiensi dan undangan untuk menghadiri acara Sweden-Indonesia Sustainability Partnership, Resepsi Diplomatik dalam rangka kunjungan HRH Victoria Ingrid, Putri Mahkota Swedia, dan Eksibisi Tyra Kleen.</p>',
                'rangkuman' => '<p>Melalui Surat No 084/AMNB/VII/2026 tanggal 20 Juli 2026, Duta Besar Swedia memohon Audiensi kepada Gubernur DKI Jakarta untuk membahas pelaksanaan acara Sweden-Indonesia Sustainability Partnership (SISP) Conference on Business Delegation pada tanggal 8 s.d. 10 September 2026, yang dirangkaikan dengan Tyra Kleen Art Exhibition pada tanggal, 8 September 2026. Acara ini juga bertepatan dengan kunjungan HRH Victoria Ingrid, Putri Mahkota Swedia.</p><p>Undangan untuk menghadiri kedua acara tersebut juga telah disampaikan melalui Surat No. 113/AMB/VIII/2026 tanggal 13 Agustus 2026 kepada Gubernur DKI Jakarta, dengan rincian:</p><p>1. Menghadiri resepsi diplomatik yang dihadiri oleh HRH Victoria Ingrid, Putri Mahkota Swedia --- 7 September 2026, 19:00 - 21:00 WIB</p><p>2. Menghadiri pembukaan Tyra Kleen Art Exhibition --- 8 September 2026, 12:00 s.d. 13:00 WIB di UP, Thamrin Nine.</p><p>3. Menghadiri Closed-door Bilateral Meeting dengan Menteri Luar Negeri Swedia --- 8 September 2026, 13:30 s.d. 14:30 WIB di Park Hyatt Jakarta.</p>',
                'catatan' => '<p>Cek berkala, dan jika perlu, buatkan Nota Dinas.</p>',
                'tanggal_diterima' => '2026-07-22',
                'tanggal_selesai' => null,
                'triwulan_undangan' => 'TW III',
                'status_undangan' => 'Berjalan',
                'nama_pic' => 'Ms. Amreta Sidik, Kedutaan Swedia,  Ms. Aryusamalia, Business Sweden',
                'nomor_pic' => '+62 811-8860-147, +62 811-1262-148',
            ],
        ];

        foreach ($data as $item) {
            Undangan::create($item);
        }
    }
}
