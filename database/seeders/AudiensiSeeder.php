<?php

namespace Database\Seeders;

use App\Models\Audiensi;
use Database\Seeders\Concerns\ResolvesMitra;
use Illuminate\Database\Seeder;

class AudiensiSeeder extends Seeder
{
    use ResolvesMitra;

    /**
     * Sumber data: sheet "Audiensi (AU)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - SELURUH baris, mencakup keempat jenis mitra.
     *
     * Seeder ini adalah hasil penggabungan AudiensiPart1Seeder (mitra Kedutaan
     * Besar, Misi Asing untuk ASEAN, Misi Permanen ASEAN) dan AudiensiPart2Seeder
     * (mitra Non Perwakilan Negara Asing). Pemisahan Part1/Part2 dahulu diperlukan
     * karena modul Non Perwakilan Negara Asing belum dibuat, sehingga data Part2
     * hanya berstatus draft dan tidak pernah di-insert. Modul tersebut kini sudah
     * tersedia beserta seeder mitranya (NonPerwakilanNegaraAsingSeeder), sehingga
     * kedua bagian digabung menjadi satu seeder per modul.
     *
     * PENTING - relasi ke mitra:
     * Migration tb_audiensi tetap menggunakan SATU kolom foreign key
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
     * Tiga baris Non Perwakilan Negara Asing memakai mitra yang sama, yaitu "Biro
     * Kepala Daerah" - sesuai kolom Mitra pada sheet acuan, yang mencatat unit
     * pengaju permohonan pendampingan, bukan tamu asing yang diterima. Ketiganya
     * menunjuk ke SATU record mitra yang sama (bukan tiga record berbeda).
     *
     * Penyesuaian data dari sheet acuan:
     *   - "Kedutaan Besar Kosta Rika" (sheet) -> "Kedutaan Besar Republik Kosta Rika" (seeder mitra)
     *   - Baris Kedutaan Besar Kerajaan Maroko: kolom Status pada sheet tertulis
     *     "Selesai" namun kolom Tanggal Selesai berisi teks "Tunda" dan
     *     rangkuman menyebutkan audiensi "akan ditunda" - status_audiensi
     *     dikoreksi menjadi "Tunda" agar konsisten dengan isi rangkuman.
     *
     * Field yang sengaja dikosongkan sesuai arahan: file_dokumen, nama_pic,
     * nomor_pic. Kolom catatan diseragamkan menjadi placeholder instruksi
     * untuk operator, menggantikan catatan tindak lanjut asli pada sheet.
     * Kolom "Data" (kode referensi dokumen internal) dan "Kontak" pada sheet
     * tidak disimpan karena tidak ada padanan kolom pada skema tb_audiensi.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Hungaria',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Hungaria</p>',
                'rangkuman' => '<p>Melalui Surat No. 4/2026/HUEMB/JKT tanggal 12 Januari 2026, Duta Besar Republk Hungaria melaksanakan permohonan untuk melaksanakan audiensi kepada Gubernur DKI Jakarta. Permohonan ini mengulangi permohonan sebelumnya, melalui Surat No. KKM/8408/2025/Adm tanggal 6 Maret 2025, yang belum direspons.</p><p>Audiensi dilaksanakan 29 Januari 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-12',
                'tanggal_selesai' => '2026-01-29',
                'triwulan_audiensi' => 'TW I',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Australia',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Australia</p>',
                'rangkuman' => '<p>Melalui Surat Tanggal 25 Maret 2026, Duta Besar Australia memohon Audiensi kepada Gubenur DKI Jakarta</p><p>Audiensi dilaksanakan 2 April 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-25',
                'tanggal_selesai' => '2026-04-02',
                'triwulan_audiensi' => 'TW I',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Korea',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Republik Korea</p>',
                'rangkuman' => '<p>Melalui Surat No. ROKE - 2026 - 492 tanggal 24 April 2026, Kedutaan Besar Republik Korea (Korea Selatan) memohon Audiensi kepada Gubernur DKI Jakarta</p><p>Audiensi dilaksanakan 20 Mei 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-27',
                'tanggal_selesai' => '2026-05-20',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Qatar',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Qatar</p>',
                'rangkuman' => '<p>Melalui Surat No Q-J-MISC/2045/III/2026 tanggal 27 Maret 2026, Duta Besar Qatar memohon audiensi kepada Gubernur DKI Jakarta.</p><p>Audiensi dilaksanakan 7 Mei 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-27',
                'tanggal_selesai' => '2026-05-07',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Malaysia',
                'topik' => '<p>Permohonan audiensi sekaligus undangan kepada Gubernur DKI Jakarta dari Kedutaan Malaysia, memohon Courtesy Call untuk Menteri Besar Negeri Kelantan dan hadir di acara Kelantan Day.</p>',
                'rangkuman' => '<p>Berdasarkan Nota Diplomatik Kedutaan Besar Malaysia Nomor AT220/2026 tanggal 23 April 2026 kepada Kementerian Luar Negeri RI dan Surat Kuasa Usaha Sementara Kedutaan Besar Malaysia Nomor SR (033) 686/2 Jld.2 tanggal 23 April 2026 kepada Biro Kerja Sama Daerah DKI Jakarta, Kedutaan Besar Malaysia menyampaikan permohonan kepada Bapak Gubernur DKI Jakarta untuk:</p><p>Menerima kunjungan kehormatan (courtesy call) Menteri Besar Negara Bagian Kelantan kepada Gubernur DKI Jakarta pada hari Rabu, 13 Mei 2026 pukul 10:00 WIB untuk mempererat hubungan silaturahmi, membahas perkembangan hubungan bilateral antara Kerajaan Malaysia dan Republik Indonesia, serta menjajaki potensi kerja sama khususnya antara Negara Bagian Kelantan dan Provinsi DKI Jakarta.</p><p>Menghadiri dan memberikan sambutan pada kegiatan program Kelantan Day pada hari Kamis, 14 Mei 2026 pukul 09:00 WIB di Hotel Four Points by Sheraton Jakarta, Thamrin. Program ini diselenggarakan bertepatan dengan peluncuran penerbangan langsung AirAsia rute Kota Bharu–Jakarta yang dijadwalkan mulai beroperasi pada Juni 2026, yang diharapkan dapat meningkatkan aktivitas pariwisata dan kunjungan masyarakat</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-23',
                'tanggal_selesai' => '2025-05-14',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Federasi Rusia',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Federasi Rusia</p>',
                'rangkuman' => '<p>Melalui koordinasi kepada Biro Kepala Daerah Gubernur, Kedutaan Besar Rusia memohon Audiensi Kepada Gubernur DKI Jakarta</p><p>Audiensi dilaksanakan 2 Juli 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-01',
                'tanggal_selesai' => '2026-07-02',
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Afghanistan',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Charge d\'Affaires Kedutaan Besar Afghanistan</p>',
                'rangkuman' => '<p>Melalui Surat No. 26121/AF.OLJ/VII/2026 tanggal 14 Juli 2026, kepada Gubernur DKI Jakarta, Kedutaan Besar Afghanistan memohon audiensi/pertemuan antara Mr. Mawlawi Sadullah Baloch dan Gubernur DKI Jakarta di Kedutaan Besar Afghanistan.</p><p>Permohonan pending, mempertimbangkan situasi dalam negeri Afghanistan, ketidaksetaraan protokoler, dan lokasi pertemuan.</p><p>Telaahan telah dibuat, dan disarankan untuk diwakilkan serta dilaksanakan di Balaikota DKI Jakarta.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-14',
                'tanggal_selesai' => null,  // Tunda
                'triwulan_audiensi' => 'TW II',
                'status_audiensi' => 'Tunda',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Yaman',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Yaman</p>',
                'rangkuman' => '<p>Melalui Surat No, A.021/OE/VI/26 tanggal 4 Juni 2026 kepada Gubernur DKI Jakarta, Duta Besar Yaman memohon audiensi kepada Gubernur DKI Jakarta.</p><p>Berdasarkan koordinasi lanjutan, diperoleh informasi bahwa Duta Besar Yaman bermaksud bersilaturahmi dan melaksanakan perkenalan dengan Pak Gubernur, sebagai duta besar baru. Selain itu, Duta Besar Yaman bermaksud memperet hubungan bilateral Yaman - Indonesia dalam bidang perdagangan, pendidikan dan kebudayaan.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-04',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Swedia',
                'topik' => '<p>Permohonan audiensi dan undangan untuk menghadiri acara Sweden-Indonesia Sustainability Partnership, Resepsi Diplomatik dalam rangka kunjungan HRH Victoria Ingrid, Putri Mahkota Swedia, dan Eksibisi Tyra Kleen.</p>',
                'rangkuman' => '<p>Melalui Surat No 084/AMNB/VII/2026 tanggal 20 Juli 2026, Duta Besar Swedia memohon Audiensi kepada Gubernur DKI Jakarta untuk membahas pelaksanaan acara Sweden-Indonesia Sustainability Partnership (SISP) Conference on Business Delegation pada tanggal 8 s.d. 10 September 2026, yang dirangkaikan dengan Tyra Kleen Art Exhibition pada tanggal, 8 September 2026. Acara ini juga bertepatan dengan kunjungan HRH Victoria Ingrid, Putri Mahkota Swedia.</p><p>Undangan untuk menghadiri kedua acara tersebut juga telah disampaikan melalui Surat No. 113/AMB/VIII/2026 tanggal 13 Agustus 2026 kepada Gubernur DKI Jakarta, dengan rincian:</p><p>1. Menghadiri resepsi diplomatik yang dihadiri oleh HRH Victoria Ingrid, Putri Mahkota Swedia --- 7 September 2026, 19:00 - 21:00 WIB</p><p>2. Menghadiri pembukaan Tyra Kleen Art Exhibition --- 8 September 2026, 12:00 s.d. 13:00 WIB di UP, Thamrin Nine.</p><p>3. Menghadiri Closed-door Bilateral Meeting dengan Menteri Luar Negeri Swedia --- 8 September 2026, 13:30 s.d. 14:30 WIB di Park Hyatt Jakarta.</p><p>Audiensi telah dijadwalkan, tetapi tidak dapat dilaksanakan karena letusan gunung Anak Krakatau membuat penerbangan HRH Victoria dari Lombok ke Jakarta ditunda.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-22',
                'tanggal_selesai' => '2026-09-09',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Regret',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Slovakia',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Republik Slovakia</p>',
                'rangkuman' => '<p>Melalui Surat No. -- tanggal 19 Juni 2026 kepada Gubernur DKI Jakarta, Duta Besar Slovakia menyampaikan permohonan Audiensi kepada Gubernur DKI Jakarta.</p><p>Audiensi dilaksanakan pada 20 Juli 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-19',
                'tanggal_selesai' => '2026-07-20',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Bulgaria',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Bulgaria</p>',
                'rangkuman' => '<p>Melalui Surat 238/2025 tanggal 1 Oktober 2025, Duta Besar Bulgaria melaksanakan permohonan untuk melaksanakan audiensi kepada Gubernur DKI Jakarta.</p><p>Permohonan belum terdisposisi.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-19',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Belarus',
                'topik' => '<p>Permohonan Audiensi Duta Besar Belarus kepada Gubernur DKI Jakarta</p>',
                'rangkuman' => '<p>Melalui Surat No. -- tanggal 20 Agustus 2026, Kedutaan Besar Belarusia memohon audiensi kepada Gubernur DKI Jakarta.</p><p>Kopi telah didisposisikan oleh Kepala Biro Kerja Sama Daerah, dan surat masih berada dalam proses penjadwalan oleh Biro Kepala Daerah.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-21',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Qatar',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Qatar</p>',
                'rangkuman' => '<p>Melalui Nota Diplomatik No -- tanggal 17 Juli 2027 dan No -- tanggal 23 Juli 2026 kepada Gubernur DKI Jakarta, Duta Besar Qatar menyampaikan permohonan Audiensi kepada Gubernur DKI Jakarta untuk mendiskuksikan kemungkinan pelaksanaan kerja sama Sister City Jakarta dan Doha. Kedutaan Besar Qatar telah melampirkan Draft Nota Kesepahaman dalam Bahasa Inggris.</p><p>Sebelumnya, Qatar telah melaksanakan audiensi kepada Gubernur DKI Jakarta pada tanggal 7 Mei 2026</p><p>Mengingat pembahasan masalah telah spesifik menjajaki kemungkinan membuat Sister City, dan bahwa Qatar telah melaksanakan audiensi kepada Gubernur sebelumnya untuk tahun 2026, audiensi akan diterima oleh Kepala Biro KSD.</p><p>Audiensi ditunda ke September atas permohonan Kedutaan Besar Qatar.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-26',
                'tanggal_selesai' => null,  // Tunda
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Tunda',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Palestina',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta sekaligus permohonan kerja sama bantuan beautifikasi di sekitar Kedutaan Besar Palestina</p>',
                'rangkuman' => '<p>Kedutaan Besar Palestina menyampaikan permohonan audiensi kepada Gubernur DKI Jakarta melalui koordinasi langsung dengan Biro Kepala Daerah.</p><p>Audiensi dilaksanakan 8 Agustus 2026.</p><p>Selama audiensi dibahas beberapa hal, termasuk surat Direktur Fasilitas Diplomatik Direktorat Jenderal Protokol dan Konsuler Kementerian Luar Negeri Republik Indonesia Nomor 00954/PK/07/2026/67 tanggal 29 Juli 2026 perihal Permohonan Kedutaan Besar Palestina kepada Pemprov DKI Jakarta untuk melaksankan fasilitasi dan mendukung kegiatan Kedubes dalam rangka menyabut HUT RI ke-81, Kedutaan Besar Palestina bermaksud melaksanakan beautifikasi di sekitar wilayah Kedutaan dan memohon bantuan dari Pemerintah Provinsi DKI Jakarta.</p><p>Bantuan telah diberikan dan dilaksanakan pada 8 Agustus 2026.</p><p>Kedutaan Besar Palestina telah menyampaikan ucapan terima kasih No. EPJ/359/VIII/2026 tgl -- atas kerja sama yang diberikan Pemerintah Provinsi DKI Jakarta.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-29',
                'tanggal_selesai' => '2026-08-08',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Kuwait',
                'topik' => '<p>Pwrmohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Kuwait</p>',
                'rangkuman' => '<p>Melalui Surat No. 602/2025 tanggal 28 November 2025 kepada Gubernur DKI Jakarta Kedutaan Besar Kuwait memohon Audiensi kepada Gubermur DKI Jakarta</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-23',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Kosta Rika',
                'topik' => '<p>Permohonan audiensi kepada Kepala Biro Kerja Sama Daerah dari Kedutaan Besar Kosta Rika</p>',
                'rangkuman' => '<p>Melalui Surat No. EMBCR-IDN-057-2026 tanggal 8 Juni 2026, Kedutaan Besar Kosta Rika memohon pertemuan dengan Kepala Biro Kerja Sama Daerah untuk mendiskusikan kesempatan kolaborasi dengan Kedutaan Besar Kosta Rika.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-14',
                'tanggal_selesai' => '2026-07-21',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Kerajaan Maroko',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Kerajaan Maroko, sekaligus penyampaikan permohonan untuk mengatasi permasalahan gangguan ketertiban karena iperasional 24 Jam Taman Mataram.</p>',
                'rangkuman' => '<p>Kedutaan Besar Kerajaan Maroko menyampaikan Surat No 706/2026 tanggal 4 Juni 2026 kepada Gubernur DKI Jakarta untuk memohon courtesy call.</p><p>Meski demikian, Kedutaan Besar Kerajaan Maroko juga telah mengirimkan Surat No 780/2026 tanggal 17 Juni 2026, berkenaan dengan keluhan terhadap jam operasional Taman Mataram selama 24 jam, yang menimbulkan gangguan di sekitar premis Kedutaan Besar.</p><p>Berkenaan dengan hal ini, Kelurahan Selong telah melaksanakan beberapa inisiatif yaitu:</p><p>1. Penertiban parkir dengan pemberlakuan larangan parkir bagi selain warga pada pukul 01.00–07.00 WIB disertai pemasangan rambu dan pemantauan oleh Dinas Perhubungan;</p><p>2. Penertiban pedagang, larangan merokok serta membawa minuman keras di kawasan taman yang diawasi Satpol PP;</p><p>3. Penguatan pengamanan kawasan melalui patroli FKDM, penambahan personel pendukung, usulan pembangunan pagar hidup, serta penambahan penerangan jalan;</p><p>4. Pengaturan akses Wi-Fi publik sehingga pada jam-jam rawan hanya digunakan untuk kebutuhan CCTV.</p><p>5. Sebagai upaya mitigasi tambahan, Kelurahan Selong akan memasang portal di sisi utara dan selatan akses Taman Mataram. Pemasangan ini akan dilaksanakan pada minggu pertama dan kedua bulan Juli 2026.</p><p>Penerimaan audiensi untuk Kedutaan Besar Kerajaan Maroko akan ditunda hingga penanganan permasalahan operasional di Taman Mataram diselesaikan.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-02',
                'tanggal_selesai' => null,  // Tunda
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Tunda',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Georgia',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Georgia.</p>',
                'rangkuman' => '<p>Melalui Note Verbale No. 31/8638 tanggal 19 Maret 2026 kepada kementerian Luar Negeri RI, dan melalui surat tanggal 19 Maret 2026 kepada Gubernur DKI Jakarta, Duta Besar Georgia memohon audiensi kepada Gubernur DKI Jakarta.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-19',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Arab Saudi',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta, berkenaan dengan rencana kolaborasi dengan Jakarta, secara khusus hibah Kedutaan Besar Arab Saudi bantuan Kedutaan Besar Kerajaan Arab Saudi untuk renovasi Jakarta Islamic Center dan Pembangunan King Salman Islamic Center.</p>',
                'rangkuman' => '<p>Kedutaan Besar Arab Saudi menyatakan dukungan terhadap rekonstruksi Jakarta Islamic Center (JIC) dan pembangunan King Salman Islamic Center di Jakarta.</p><p>Rekonstruksi JIC dinilai sangat krusial. penting, mengingat lokasi memerlukan pemulihan perhatian pasca kebakaran pada tahun 2022.</p><p>Selain itu, Kedutaan Besar Arab Saudi juga berencana melaksankanan rencana pembangunan King Salman Islamic Center. Kedutaan Besar Arab Saudi memilh kosong di Cengkareng Barat, sisi Jakan Tol Lingkar Luar Barat, Kelurahan Cengkareng Barat, Kecamatan Cengkareng, Kota Administrasi Jakarta Barat.</p><p>Pemerintah Provinsi DKI Jakarta telah mengirimkan Surat No. 610/KR.03 tanggal 29 Oktober 2025 kepada Kementerian Luar Negeri RI untuk memohon fasilitasi terkait hal ini, dan telah dijawab melalui Surat No. 783/BK/11/2025/04/01 dari Kementerian Luar Negeri Kepada Gubernur DKI Jakarta, yang pada dasarnya menyambut baik dan menyatakan dukungan</p><p>Terkait hal ini juga, pada tanggal 31 Juli 2026 telah dilaksanakan pertemuan antara Duta Besar Saudi Arabia dan tim Pemerintah Provinsi DKI Jakarta yang terdiri dari:</p><p>1. Kerajaan Saudi Arabia memlih pembangunan lokasi King Salman Islamic Center di Cengkareng. dan bersedia membiaya renovasi pembangunan JIC Koja, dengan surat konfirmasi masih berproses.</p><p>2. Meski demikian, Kedutaan Besar Arab Saudi mengharapkan bahwa tanah di Cengkareng dapat diserahkan dalam keadaan clean and clear, sementara keadaan eksisting, lahan tersebut dimiliki oleh Dinas Ketahanan Pangan, Kelautan, dan Perikanan dan masih berada dalam sengketa.</p><p>3. Selain itu, Kedutaan Besar Arab Saudi berharap agar skema hibah dapat dilaksanakan secara G to G, yang harus tunduk pada ketentuan PP No. 10 tahun 2011. Berkenaan dengan ini, masih perlu dibahas mekanisme bantuan dari Pemerintah Arab Saudi, apakah dalam bentuk dana, barang, pembangunan langsung, atau melalui mekanisme/lembaga tertentu, dan bahwa beberapa contoh kerja sama bantuan luar negeri, antara lain bantuan Pemerintah Uni Emirat Arab di Solo dan bantuan Pemerintah Arab Saudi di Aceh, sebagai bahan perbandingan untuk mencari mekanisme yang efektif dan sesuai ketentuan.</p><p>Akan dilaksanakan rapat terbatas berdasarkan hasil-hasil pembahasan ini, yang akan ditindaklanjuti oleh Biro Kerja Sama Daerah melalui Nota Dinas kepada Gubernur DKI Jakarta.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-23',
                'tanggal_selesai' => '2026-08-24',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Afrika Selatan',
                'topik' => '<p>Permohonan audiensi kepada Gubernur DKI Jakarta dari Kedutaan Besar Afrika Selatan</p>',
                'rangkuman' => '<p>Melalui Surat No 08945/BK/07/2026 tanggal 10 Juli 2026, Direktur Jenderal Asia Pasifik dan Afrika Kementerian Luar Negeri RI menyampaikan kepada Gubernur DKI Jakarta bahwa Kedutaan Besar Afrika Selatan memohon audiensi pada Kamis, 30 Juli 2026.</p><p>Audiensi telah dilaksanakan, 30 Juli 2026</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-10',
                'tanggal_selesai' => '2026-07-30',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Polandia',
                'topik' => '<p>Permohonan audiensi kepada Bagian Kerja Sama Luar Negeri dari Kedutaan Besar Republik Polandia</p>',
                'rangkuman' => '<p>Melalui koordinasi via WhatsApp kepada Bagian Kerja Sama Luar Negeri, Kedutaan Besar Polandia menyampaikan keinginan untuk berdiskusi dengan Bagian Kerja Sama Luar Negeri Biro Kerja Sama Daerah.</p><p>Pertemuan dihadiri oleh Kepala Biro Kerja Sama Daerah.</p><p>Kedutaan Besar Polandia berencana melaksanakan kegiatan Poland Festival di Jakarta pada November 2026.</p><p>Berkenaan dengan ini, Wakil Duta Besar Republik Polandia, Mr. Maciej Tumulec dan Kepala Kantor Dagang dan Investasi Polandia di Indonesia Mr. Cezary Filipek, memohon waktu pertemuan guna membahas dan mengoordinasikan rencana pelaksanaan kegiatan dimaksud serta peluang kerja sama dengan Pemerintah Provinsi DKI Jakarta</p><p>Pada pertemuan, dilaksanakan diskusi berkenaan dengan rencana pelaksanaan rangkaian Poland Festival di Jakarta pada November 2026. Biro Kerja Sama Daerah memohon kepada Kedutaan Besar Polandia untuk menyampaikan proposal dan perkiraan peserta, sehingga perkiraan dukungan dapat diperhitungkan dan dikoordinasikan segera.</p>',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen audiensi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-09-04',
                'tanggal_selesai' => '2026-09-10',
                'triwulan_audiensi' => 'TW III',
                'status_audiensi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kbri' => 'KBRI Bern',
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
                'nama_pemprov_dki' => 'Biro Kepala Daerah',
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
                'nama_pemprov_dki' => 'Biro Kepala Daerah',
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
                'nama_pemprov_dki' => 'Biro Kepala Daerah',
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

        foreach ($data as $item) {
            $idMitra = $this->ambilIdMitra($item);

            if (! $idMitra) {
                continue;
            }

            Audiensi::create([
                'id_mitra' => $idMitra,
                ...$item,
                'is_active' => true,
            ]);
        }
    }
}
