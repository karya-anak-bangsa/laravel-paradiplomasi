<?php

namespace Database\Seeders;

use App\Models\NonPerwakilanNegaraAsing;
use Illuminate\Database\Seeder;

class NonPerwakilanNegaraAsingSeeder extends Seeder
{
    /**
     * Sumber data: spreadsheet Data Paradiplomasi Jakarta 2026 TIDAK memiliki
     * sheet tersendiri untuk Non Perwakilan Negara Asing ("Data belum tersedia"
     * pada CLAUDE.md Bagian 7). Daftar di bawah karena itu DITURUNKAN dari kolom
     * "Mitra" pada sheet Riwayat Diplomasi - yaitu seluruh nama mitra yang tidak
     * mengikuti pola penamaan "Kedutaan Besar ...", "Misi ... untuk ASEAN", atau
     * "Misi Permanen ... untuk ASEAN", sehingga tidak masuk ke tiga modul mitra
     * lainnya:
     *   - sheet "Kolaborasi (KL)"  -> lihat KolaborasiSeeder
     *   - sheet "Undangan (UD)"    -> lihat UndanganSeeder
     *   - sheet "Audiensi (AU)"    -> lihat AudiensiSeeder
     *   - sheet "Kunjungan (VI)"   -> lihat KunjunganSeeder
     *   - sheet "Acara DKI"        -> lihat AcaraDKISeeder (kolom "Mitra yang Hadir")
     *
     * Nama yang muncul di lebih dari satu sheet (mis. Persatuan Guru Republik
     * Indonesia (PGRI), ITS Indonesia, Biro Kepala Daerah) hanya ditulis SATU KALI
     * di sini - relasi ke tiap baris riwayat diplomasi dibentuk lewat lookup nama
     * pada seeder modul masing-masing, bukan lewat duplikasi record mitra.
     *
     * URUTAN EKSEKUSI: seeder ini WAJIB dijalankan SEBELUM seluruh seeder Riwayat
     * Diplomasi, karena seeder tersebut me-lookup `id_mitra` berdasarkan
     * `nama_non_perwakilan_negara_asing` di bawah. Baris mitra pada tb_mitra
     * (supertype) dibuat otomatis oleh trait BelongsToMitra, bukan di-seed manual.
     *
     * Berbeda dengan tiga modul mitra lainnya, tb_non_perwakilan_negara_asing
     * hanya punya dua kolom identitas: `nama_non_perwakilan_negara_asing` (nama
     * resmi bebas, bukan nama negara) dan `keterangan`. Kolom keterangan diisi
     * ringkasan singkat jati diri mitra yang disarikan dari kolom Rangkuman pada
     * sheet acuan, agar operator tetap punya konteks saat mitra ini muncul di
     * dropdown pemilihan mitra maupun di halaman profil mitra.
     *
     * Koreksi data terhadap sheet acuan:
     *   - Sheet "Kolaborasi (KL)" baris "Rencana pelaksanaan Jakarta-Mumbai (JAMU)
     *     2026" menuliskan nama mitra sebagai placeholder generik "Mitra Non-PNA".
     *     Perihal dan rangkuman baris tersebut secara eksplisit menyebut Konsulat
     *     Jenderal RI di Mumbai sebagai pihak pengaju, sehingga nama mitra
     *     dikoreksi menjadi "KJRI Mumbai" - placeholder generik tidak layak
     *     tersimpan sebagai record mitra karena akan muncul apa adanya di dropdown
     *     pemilihan mitra.
     *
     * Catatan: sebagian nama pada sheet acuan adalah instansi dalam negeri
     * (Kementerian Luar Negeri RI, Biro Kepala Daerah, Badan Kesatuan Bangsa dan
     * Politik) maupun perwakilan RI di luar negeri (KBRI Tokyo, KBRI Bern, KJRI
     * Mumbai). Keduanya tetap dicatat sebagai Non Perwakilan Negara Asing
     * mengikuti klasifikasi Biro KSD pada sheet - modul ini memang menampung
     * seluruh mitra diplomasi yang bukan perwakilan negara asing di Jakarta.
     */
    public function run(): void
    {
        $data = [
            // Organisasi internasional & multilateral
            [
                'nama_non_perwakilan_negara_asing' => 'United Nations Development Programme (UNDP)',
                'keterangan' => 'Badan PBB untuk program pembangunan. Berkoordinasi dengan Pemerintah Provinsi DKI Jakarta untuk pendampingan Duta Niat Baik (Goodwill Ambassador) UNDP selama agenda di Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'UN Resident Coordinator in Indonesia, United Nations',
                'keterangan' => 'Kantor Koordinator Residen PBB di Indonesia, wakil tertinggi Sistem PBB di tingkat nasional. Tercatat hadir pada Resepsi HUT ke-499 Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'African Union Commission',
                'keterangan' => 'Sekretariat Uni Afrika (AUC). Melaksanakan kunjungan resmi ke Jakarta dan diterima oleh Sekretaris Daerah Provinsi DKI Jakarta pada 2026 atas permohonan Direktorat Jenderal Asia Pasifik dan Afrika Kementerian Luar Negeri RI.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'World Economic Forum',
                'keterangan' => 'Organisasi internasional penyelenggara forum kerja sama ekonomi global. Mengundang Gubernur DKI Jakarta untuk berpartisipasi pada forum tahunannya di Dalian, Republik Rakyat Tiongkok.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'United Cities and Local Governments Asia Pacific (UCLG ASPAC)',
                'keterangan' => 'Organisasi jaringan pemerintah kota dan daerah se-Asia Pasifik yang berkantor pusat di Jakarta. Tercatat hadir pada Resepsi HUT ke-499 Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'ICLEI Indonesia',
                'keterangan' => 'Kantor Indonesia dari ICLEI - Local Governments for Sustainability, jaringan global pemerintah daerah untuk pembangunan berkelanjutan. Tercatat hadir pada Resepsi HUT ke-499 Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Breathe Cities, C40 Cities',
                'keterangan' => 'Program Breathe Cities di bawah jaringan kota C40 Cities, berfokus pada kualitas udara perkotaan. Tercatat hadir pada Resepsi HUT ke-499 Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => '5P Global Movement',
                'keterangan' => 'Gerakan global lintas sektor penyelenggara Harmony in Diversity (HID) Award. Memohon dukungan Pemerintah Provinsi DKI Jakarta untuk Welcoming Dinner HID Award 2026 di Balai Kota DKI Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'AIESEC Indonesia',
                'keterangan' => 'Cabang Indonesia dari AIESEC (Association Internationale des Etudiants en Sciences Economiques et Commerciales), organisasi kepemudaan internasional yang berdiri sejak 1948 dan hadir di Indonesia sejak 1984. Tuan rumah AIESEC International Congress 2026 di Jakarta.',
                'is_active' => true,
            ],

            // Kantor perwakilan non-kedutaan
            [
                'nama_non_perwakilan_negara_asing' => 'Taipei Economic and Trade Office (TETO)',
                'keterangan' => 'Kantor perwakilan ekonomi dan dagang Taipei di Jakarta. Penanganan undangan dari kantor ini memerlukan kehati-hatian berkenaan dengan kebijakan One China Policy.',
                'is_active' => true,
            ],

            // Perwakilan Republik Indonesia di luar negeri
            [
                'nama_non_perwakilan_negara_asing' => 'KBRI Tokyo',
                'keterangan' => 'Kedutaan Besar Republik Indonesia di Tokyo, Jepang. Mitra Biro Kerja Sama Daerah dalam penguatan kerja sama strategis Jakarta-Jepang di sektor investasi, infrastruktur, transportasi publik, dan pengelolaan lingkungan.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'KBRI Bern',
                'keterangan' => 'Kedutaan Besar Republik Indonesia di Bern, Swiss.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'KJRI Mumbai',
                'keterangan' => 'Konsulat Jenderal Republik Indonesia di Mumbai, India. Penggagas rangkaian Jakarta-Mumbai Update (JAMU) dan penjajakan hubungan Sister City antara Jakarta dan Mumbai.',
                'is_active' => true,
            ],

            // Instansi pemerintah Republik Indonesia
            [
                'nama_non_perwakilan_negara_asing' => 'Kementerian Luar Negeri RI',
                'keterangan' => 'Kementerian Luar Negeri Republik Indonesia, khususnya Direktorat Jenderal Protokol dan Konsuler. Mitra utama Biro Kerja Sama Daerah untuk fasilitasi diplomatik dan permohonan dukungan penyambutan tamu kenegaraan.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Menteri Luar Negeri Republik Indonesia',
                'keterangan' => 'Pimpinan Kementerian Luar Negeri Republik Indonesia beserta jajaran Wakil Menteri. Dicatat terpisah dari "Kementerian Luar Negeri RI" mengikuti penamaan pada sheet acuan, khusus untuk agenda audiensi setingkat menteri/wakil menteri.',
                'is_active' => true,
            ],

            // Perangkat daerah Pemerintah Provinsi DKI Jakarta
            [
                'nama_non_perwakilan_negara_asing' => 'Biro Kepala Daerah',
                'keterangan' => 'Biro Kepala Daerah Setda Provinsi DKI Jakarta. Kerap meneruskan permohonan audiensi kepada Gubernur/Wakil Gubernur dan meminta pendampingan Biro Kerja Sama Daerah untuk tamu asing.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Badan Kesatuan Bangsa dan Politik',
                'keterangan' => 'Badan Kesatuan Bangsa dan Politik Provinsi DKI Jakarta. Pelaksana kegiatan diplomasi hijau penanaman mangrove bersama Rumah Rusia di Jakarta.',
                'is_active' => true,
            ],

            // Pemerintah negara/daerah asing
            [
                'nama_non_perwakilan_negara_asing' => 'Pemerintah Singapura',
                'keterangan' => 'Pemerintah Republik Singapura pada tingkat kepala pemerintahan, di luar jalur Kedutaan Besar Singapura maupun Misi Permanen Republik Singapura untuk ASEAN.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Pemerintah India',
                'keterangan' => 'Pemerintah Republik India pada tingkat kepala pemerintahan, di luar jalur Kedutaan Besar India.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Hainan Provincial Department of Civil Affairs',
                'keterangan' => 'Dinas Sosial Provinsi Hainan, Republik Rakyat Tiongkok. Melaksanakan kunjungan ke Dinas Sosial Provinsi DKI Jakarta pada 2026.',
                'is_active' => true,
            ],

            // Organisasi profesi, kemasyarakatan, dan pendidikan
            [
                'nama_non_perwakilan_negara_asing' => 'Persatuan Insinyur Indonesia',
                'keterangan' => 'Organisasi profesi insinyur Indonesia (PII). Penyelenggara World Engineering Day for Sustainable Development 2026 di Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Persatuan Guru Republik Indonesia (PGRI)',
                'keterangan' => 'Organisasi profesi guru Indonesia. Bermitra dengan Education International Asia Pacific (EIAP) sebagai penyelenggara The 10th EIAP Regional Conference 2026 di Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'ITS Indonesia',
                'keterangan' => 'Intelligent Transport System Indonesia, asosiasi pemangku kepentingan sistem transportasi cerdas. Penyelenggara Indonesia International Transport Summit (IITS) 2026.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Keluarga Pelajar Jakarta (KPJ) Mesir',
                'keterangan' => 'Organisasi pelajar asal Jakarta yang menempuh pendidikan di Mesir. Penyelenggara Jakarta Event XII 2026 di Mesir bersama Indonesia Diaspora Network Egypt.',
                'is_active' => true,
            ],

            // Institusi seni & badan usaha
            [
                'nama_non_perwakilan_negara_asing' => 'Stuttgart Philharmonic Orchestra',
                'keterangan' => 'Orkestra filharmoni Kota Stuttgart, Republik Federal Jerman. Merencanakan tur ke Jakarta pada 2027 bertepatan dengan peringatan 75 tahun hubungan diplomatik Indonesia-Jerman.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'China Southwest Architecture',
                'keterangan' => 'Perusahaan arsitektur dan rekayasa asal Republik Rakyat Tiongkok. Memaparkan konsep dan rencana proyek Pembangkit Listrik Tenaga Sampah kepada Gubernur DKI Jakarta.',
                'is_active' => true,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Satria Putra, CEO Nusura Indonesia',
                'keterangan' => 'Chief Executive Officer Nusura Indonesia. Mengajukan permohonan audiensi bagi delegasi Czech Indonesian Chamber of Industry and Trade (CICIT) kepada Gubernur DKI Jakarta.',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            NonPerwakilanNegaraAsing::create($item);
        }
    }
}
