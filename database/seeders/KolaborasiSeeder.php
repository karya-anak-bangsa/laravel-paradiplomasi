<?php

namespace Database\Seeders;

use App\Models\Kolaborasi;
use Database\Seeders\Concerns\ResolvesMitra;
use Illuminate\Database\Seeder;

class KolaborasiSeeder extends Seeder
{
    use ResolvesMitra;

    /**
     * Sumber data: sheet "Kolaborasi (KL)" pada spreadsheet Data Paradiplomasi
     * Jakarta 2026 - SELURUH baris, mencakup keempat jenis mitra.
     *
     * Seeder ini adalah hasil penggabungan KolaborasiPart1Seeder (mitra Kedutaan
     * Besar, Misi Asing untuk ASEAN, Misi Permanen ASEAN) dan KolaborasiPart2Seeder
     * (mitra Non Perwakilan Negara Asing). Pemisahan Part1/Part2 dahulu diperlukan
     * karena modul Non Perwakilan Negara Asing belum dibuat, sehingga data Part2
     * hanya berstatus draft dan tidak pernah di-insert. Modul tersebut kini sudah
     * tersedia beserta seeder mitranya (NonPerwakilanNegaraAsingSeeder), sehingga
     * kedua bagian digabung menjadi satu seeder per modul.
     *
     * PENTING - relasi ke mitra:
     * Migration tb_kolaborasi tetap menggunakan SATU kolom foreign key
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
     * Normalisasi data Part2 terhadap skema tb_kolaborasi (data Part2 sebelumnya
     * berupa draft mentah dan belum pernah divalidasi ke kolom):
     *   - tanggal_selesai yang pada sheet berisi teks status ("Berjalan", "Batal",
     *     "Dialihkan ke Sub-Kelompok Kerjasama Pemerintah Daerah Dalam Negeri")
     *     -> disimpan sebagai null, karena kolomnya bertipe date. Informasi
     *     statusnya sudah terwakili pada kolom status_kolaborasi.
     *   - Baris "Rencana pelaksanaan Jakarta-Mumbai (JAMU) 2026": nama mitra pada
     *     sheet berupa placeholder generik "Mitra Non-PNA" -> dikoreksi menjadi
     *     "KJRI Mumbai" sesuai pihak pengaju yang disebut pada perihal dan
     *     rangkuman (lihat NonPerwakilanNegaraAsingSeeder).
     *
     * Field yang sengaja dikosongkan sesuai arahan: file_dokumen, nama_pic,
     * nomor_pic. Kolom catatan diseragamkan menjadi placeholder instruksi
     * untuk operator, menggantikan catatan tindak lanjut asli pada sheet.
     * Kolom "Data" (kode referensi dokumen internal) dan "Kontak" pada sheet
     * tidak disimpan karena tidak ada padanan kolom pada skema tb_kolaborasi.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Tunisia',
                'kolaborasi' => 'Permohonan untuk mengeksplorasi gedung Pemerintah Provinsi DKI Jakarta sebagai venue.',
                'rangkuman' => 'Berdasarkan koordinasi lisan, Kedutaan Besar Republik Tunisia bermaksud melaksanakan penampilan seni pada tanggal 20 April 2026, dengan menampilkan 1 (satu) orang penyanyi dan 1 (satu) orang violinis merangkap pianis.<br>Berkenaan dengan itu, Kedutaan Besar Tunisia berharap bantuan Pemerintah Provinsi DKI Jakarta untuk mendapatkan lokasi acara bagi penampilan seni dimaksud, dengan kapasitas 200-250 orang, sistem tata suara yang memadai, dan memiliki grand piano yang dapat dipergunakan oleh pianis.<br>Hal ini telah ditindaklanjuti oleh Biro Kerja Sama Daerah dengan rapat tanggal 23 Februari 2025. Biro Kerja Sama Daerah memberikan opsi untuk mengontak Dinas Kebudayaan atai PT Jakarta Propertindo sesuai keperluan, tetapi Kedutaan Besar Tunisia tidak memberikan feedback lanjutan.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-02-19',
                'tanggal_selesai' => null,  // Batal
                'triwulan_kolaborasi' => 'TW I',
                'status_kolaborasi' => 'Batal',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Bosnia dan Herzegovina',
                'kolaborasi' => 'Proposal rencana pelaksanaan kerja sama antara Sarajevo dan Jakarta',
                'rangkuman' => 'Berdasarkan Surat Walikota Sarajevo Nomor 01/15/3-41-3/26 tanggal 7 Januari 2026 perihal Surat pernyataan kehendak untuk menjalin kerja sama dan kota kembar antara Kota Sarajevo dan Provinsi DKI Jakarta serta surat Duta Besar Bosnia dan Herzegovina untuk Republik Indonesia di Jakarta Nomor 109-1-33-1-35506-4/25 tanggal 14 Januari 2026 hal penerusan surat pernyataan kehendak untuk menjalin kerja sama dan kota kembar antara Kota Sarajevo dan Provinsi DKI Jakarta.<br>Berdasarkan hal ini, Biro Kerja Sama Daerah telah membuat Nota Dinas Telaahan No. 19/PU.12.02 tanggal 27 April 2026 kepada Gubernur DKI Jakarta untuk mendapatkan petunjuk mengenai proposal dimaksud.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-07',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Arab Saudi',
                'kolaborasi' => 'Dukungan Renovasi JIS dan King Salman Islamic Center, Sepetember 2026',
                'rangkuman' => 'Sebagai kelanjutan dari KL - Fasilitasi Kerja Sama dengan Kedutaan Besar Kerajaan Arab Saudi di Bidang Mental Spiritual, dilaksanakan hal-hal sebagai berikut:<br>Berkenaan dengan rencana Dukungan Renovasi JIS dan King Salman Islamic Center, Provinsi DKI Jakarta telah mengirimkan Surat No. 610/KR.03 tanggal 29 Oktober 2025 kepada Kementerian Luar Negeri RI untuk memohon fasilitasi terkait hal ini, dan telah dijawab melalui Surat No. 783/BK/11/2025/04/01 dari Kementerian Luar Negeri Kepada Gubernur DKI Jakarta, yang pada dasarnya menyambut baik dan menyatakan dukungan.<br>Pada tanggal 31 Juli 2026 telah dilaksanakan pertemuan antara Duta Besar Saudi Arabia dan tim Pemerintah Provinsi DKI Jakarta berkenaan dengan rencana renovasi Jakarta Islamic Center (JIC) Koja dan Pembangunan King Salman Islamic Center yang terdiri dari:<br>1. Kerajaan Saudi Arabia memlih pembangunan lokasi King Salman Islamic Center di Cengkareng. dan bersedia membiaya renovasi pembangunan JIC Koja, dengan surat konfirmasi masih berproses.<br>2. Meski demikian, Kedutaan Besar Arab Saudi mengharapkan bahwa tanah di Cengkareng dapat diserahkan dalam keadaan clean and clear, sementara keadaan eksisting, lahan tersebut dimiliki oleh Dinas Ketahanan Pangan, Kelautan, dan Perikanan dan masih berada dalam sengketa.<br>3. Selain itu, Kedutaan Besar Arab Saudi berharap agar skema hibah dapat dilaksanakan secara G to G, yang harus tunduk pada ketentuan PP No. 10 tahun 2011. Berkenaan dengan ini, masih perlu dibahas mekanisme bantuan dari Pemerintah Arab Saudi, apakah dalam bentuk dana, barang, pembangunan langsung, atau melalui mekanisme/lembaga tertentu, dan bahwa beberapa contoh kerja sama bantuan luar negeri, antara lain bantuan Pemerintah Uni Emirat Arab di Solo dan bantuan Pemerintah Arab Saudi di Aceh, sebagai bahan perbandingan untuk mencari mekanisme yang efektif dan sesuai ketentuan.<br>Akan dilaksanakan rapat terbatas berdasarkan hasil-hasil pembahasan ini, yang akan ditindaklanjuti oleh Biro Kerja Sama Daerah dengan membuat draft surat Gubernur DKI Jakarta kepada Kementerian Luar Negeri RI untuk menyampaikan rangkuman situasi dan rencana tindak lanjut.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-09-02',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Jepang',
                'kolaborasi' => 'Rencana Pelaksanaan Jak-Japan Matsuri 2026',
                'rangkuman' => 'Jak-Japan Matsuri (ジャカルタ日本祭り, JJM) adalah festival pertukaran budaya Jepang–Indonesia yang diselenggarakan di Jakarta, Indonesia. Festival ini bertujuan memperdalam saling pengertian dan persahabatan masyarakat kedua negara. Pemerintah Provinsi DKI Jakarta dapat memberikan dukungan pada Jak-Japan Matsuri 2026, dan berkenaan dengan ini, perlu dilaksanakan kontak dengan Kedutaan Besar Jepang mengenai rencana pelaksanaan JJM pada tahun 2026, dan bagaimana Jakarta dapat berkontribusi.<br>Surat disampaikan pada tanggal 8 September 2026, meski acara sudah diinformasikan dari Januari 2026.<br>Dukungan yang diharapkan dari Jakarta adalah:<br>1. Permohonan Kehadiran Gubernur DKI Jakarta saat Pembukan Acara<br>2. Permohonan bantuan publikasi Jak-Japan Matsuri 2026<br>3. Permohonan pencantuman logo DKI Jakarta<br>4. Permohonan Tanda Daftar Pertunjukan Temporer yang dikeluarkan oleh Pelayanan Terpadu Satu<br>Pintu (PTSP) Provinsi DKI Jakarta<br>5. Penerbitan Surat Rekomendasi Penyelenggaraan JJM 2026 dari Dinas Pariwisata dan<br>Ekonomi Kreatif DKI Jakarta<br>6. Permohonan Partisipasi Mengisi Stan Kuliner DKI Jakarta<br>7. Permohonan Peminjaman Mobil Pemadam Kebakaran<br>8. Permohonan Peminjaman Mobil Ambulans pada Tanggal 31 Oktober sampai 1 November<br>2026<br>Rapat untuk mengkonsolidasikan permohonan dukungan akan dilaksanakan pada Rabu, 16 September 2026.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-09-08',
                'tanggal_selesai' => null,  // Berjalan
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Berjalan',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Belgia',
                'kolaborasi' => 'Undangan untuk mendiskusikan penawaran branding 500 Tahun Jakarta dengan Dirty Monitor Belgia.',
                'rangkuman' => 'Berdasarkan surat tanggal 16 Februari 2026 dari AWEX (Wallonia Trade and Investment Agency for Indonesia), Kedutaan Besar Belgia, disampaikan bahwa Dirty Monitor, studio kreatif asal Belgia yang bergerak dalam bidang konten visual inovatif, video mapping, dan pengalaman digital imersif untuk beragam acara internasional, menawarkan jasa branding untuk kegiatan 500 tahun Jakarta.<br>Berdasarkan koordinasi lebih lanjut, diketahui bahwa biaya yang ditawarkan oleh Dirty Monitor adalah EUR 250.000-300.000. Setelah penyampaian ini, belum ada tanggapan balik dari Kedutaan Besar Belgia.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-02-16',
                'tanggal_selesai' => '2026-04-16',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Regret',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Georgia',
                'kolaborasi' => 'Permohonan Penataan cahaya di Monumen Nasional dalam rangka ulang tahun kemerdekaan Georgia',
                'rangkuman' => 'Berdasarkan nota diplomatik No. 31/11103 tanggal 8 April 2026 dari Kedutaan Besar Georgia Kepada Kementerian Luar Negeri RI dan Surat No -- dari Kedutaan Besar Georgia kepada Kepala Biro KSD tanggal 8 April 2026, disampaikan bahwa Kedutaan Besar Georgia memohon penataan pencahayaan Monas pada tanggal 26 Mei 2026 untuk merayakan Hari Kemerdekaan Georgia.<br>Berdasarkan Rapat Koordinasi tanggal 29 April 2026, yang telah disampaikan kepada Kementerian Luar Negeri RI melalui Surat Biro Kerja Sama Daerah No. 13/RR.01.02 tanggal 7 Mei 2026, disepakati bahwa pada prinsipnya, penyinaran lebih diprioritaskan untuk difasilitasi dalam rangka peringatan hubungan diplomatik antara Indonesia dengan negara sahabat. Permohonan penyinaran dalam rangka peringatan hari nasional masing-masing negara, pada saat ini belum menjadi prioritas untuk difasilitasi.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-08',
                'tanggal_selesai' => '2026-05-25',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Regret',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Rakyat Tiongkok',
                'kolaborasi' => 'Penawaran beasiswa 1 tahun di Huaqiao University, Fujian, untuk mengikuti Program Studi Bahasa dan Budaya Tiongkok',
                'rangkuman' => 'Berdasarkan Nota Kedutaan Besar Republik Rakyat Tiongkok Nomor 0715-26 tanggal 29 Juni 2026 kepada Pemerintah Provinsi DKI Jakarta, disampaikan bahwa Kedutaan Besar Republik Rakyat Tiongkok menyampaikan penawaran kepada ASN Provinsi DKI Jakarta yang berusia di bawah 45 (empat puluh lima) tahun untuk mengikuti program studi Bahasa dan Budaya Tiongkok selama 1 (satu) tahun di Huaqiao University, Kota Xiamen, Provinsi Fujian, Republik Rakyat Tiongkok.<br>Program tersebut akan dilaksanakan pada periode September 2026 sampai dengan Juli 2027. Pemerintah Republik Rakyat Tiongkok akan menanggung biaya pendidikan, akomodasi, dan biaya visa peserta selama mengikuti program, dan membekali para peserta dengan uang saku sebesar RMB 5.000.<br>Biro Kerja Sama Daerah menyampaikan surat No e-0140/HM.03.00 tanggal 9 Juli 2026 tanggal kepada BPSDM Provinsi DKI Jakarta untuk memohon bantuan diseminasi informasi dan seleksi.<br>Melalui koordinasi lebih lanjut, diketahui bahwa diperlukan waktu yang lebih panjang untuk melaksanakan diseminasi, maka untuk tahun ini, Pemerintah Provinsi DKI Jakarta belum dapat berpartisipasi.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-29',
                'tanggal_selesai' => '2026-07-09',
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Regret',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Arab Saudi',
                'kolaborasi' => 'Fasilitasi Kerja Sama dengan Kedutaan Besar Kerajaan Arab Saudi di Bidang Mental Spiritual.',
                'rangkuman' => 'Kepala Biro Pendidikan dan Mental Spiritual menyampaikan Nota Dinas No. e-0213/HM.03.00 tanggal 30 September 2025 kepada Biro Kerja Sama Daerah hal Fasilitasi Kerja Sama dengan Kedutaan Besar Kerajaan Arab Saudi di Bidang Mental Spiritual. Termasuk di dalamnya adalah permohonan untuk membahas Rencana Renovasi Jakarta Islamic Center dan Pembangunan Baru International Islamic Center.<br>Rapat terakhir diselenggarakan 31 Juli 2026 di Kedutaan Besar Arab Saudi, yang dihadiri oleh Plh. Sekretaris Daerah Provinsi DKI Jakarta.<br>Pemerintah Provinsi DKI Jakarta telah mengirimkan Surat No. 610/KR.03 tanggal 29 Oktober 2025 kepada Kementerian Luar Negeri RI untuk memohon fasilitasi terkait hal ini, dan telah dijawab melalui Surat No. 783/BK/11/2025/04/01 dari Kementerian Luar Negeri Kepada Gubernur DKI Jakarta, yang pada dasarnya menyambut baik dan menyatakan dukungan.<br>Terkait hal ini juga, pada tanggal 31 Juli 2026 telah dilaksanakan pertemuan antara Duta Besar Saudi Arabia dan tim Pemerintah Provinsi DKI Jakarta yang terdiri dari:<br>1. Kerajaan Saudi Arabia memlih pembangunan lokasi King Salman Islamic Center di Cengkareng. dan bersedia membiaya renovasi pembangunan JIC Koja, dengan surat konfirmasi masih berproses.<br>2. Meski demikian, Kedutaan Besar Arab Saudi mengharapkan bahwa tanah di Cengkareng dapat diserahkan dalam keadaan clean and clear, sementara keadaan eksisting, lahan tersebut dimiliki oleh Dinas Ketahanan Pangan, Kelautan, dan Perikanan dan masih berada dalam sengketa.<br>3. Selain itu, Kedutaan Besar Arab Saudi berharap agar skema hibah dapat dilaksanakan secara G to G, yang harus tunduk pada ketentuan PP No. 10 tahun 2011. Berkenaan dengan ini, masih perlu dibahas mekanisme bantuan dari Pemerintah Arab Saudi, apakah dalam bentuk dana, barang, pembangunan langsung, atau melalui mekanisme/lembaga tertentu, dan bahwa beberapa contoh kerja sama bantuan luar negeri, antara lain bantuan Pemerintah Uni Emirat Arab di Solo dan bantuan Pemerintah Arab Saudi di Aceh, sebagai bahan perbandingan untuk mencari mekanisme yang efektif dan sesuai ketentuan.<br>Akan dilaksanakan rapat terbatas berdasarkan hasil-hasil pembahasan ini, yang akan ditindaklanjuti oleh Biro Kerja Sama Daerah dengan membuat draft surat Gubernur DKI Jakarta kepada Kementerian Luar Negeri RI untuk menyampaikan rangkuman situasi dan rencana tindak lanjut.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-04',
                'tanggal_selesai' => '2026-09-02',
                'triwulan_kolaborasi' => 'TW III',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Federasi Rusia',
                'kolaborasi' => 'Rencana Pelaksanaan pemutaran film di Planetarium Jakarta dalam rangka Human Space Flight Day, 12 April 2026',
                'rangkuman' => 'Melalui Surat No 839 tanggal 26 Maret 2026 kepada Biro Kerja Sama Daerah dan Direktur PT Jakarta Propertindo, Kedutaan Besar Republik Federal Rusia bermaksud melaksanakan pemutaran film produksi Asosiasi Planetarium Rusia berjudul "History of Russia in Space." Berkenaan dengan ini, Kedutaan Besar Rusia memohon kepada Biro Kerja Sama Daerah untuk menegosiasikan pembebasan biaya pemutaran film di Planetarum Jakarta dengan PT Jakarta Propertindo,<br>Negosiasi dilaksanakan melalui beberapa rapat koordinasi, dan dengan beberapa surat penawaran yang disampaikan oleh PT Jakarta Propertindo kepada Kedutaan Besar Federasi Rusia, di antaranya Surat 110/BL4000/IV/2026/0217 tanggal 14 Maret 2026 dan No. 110/BL4000/IV/2026/0197 tanggal 8 April 2026, sebelum diberikan perizinan resmi untuk pemutaran tanpa biaya melalui Surat No. 110/BL4000/IV/2026/0245 tanggal 27 April 2026.<br>Pemutaran telah dilaksanakan tanggal 4 Mei 2026.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-26',
                'tanggal_selesai' => '2026-05-04',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Thailand',
                'kolaborasi' => 'Permohonan dukungan peliputan Songkran oleh Dinas Komunikasi, Informatika, dan Statistik Provinsi DKI Jakarta.',
                'rangkuman' => 'Dinas Komunikasi, Informatika, dan Statistik Provinsi DKI Jakarta memohon bantuan fasilitasi untuk meliput penyelenggaraan Festival Songkran 2026 di Kedutaan Besar Thailand pada tanggal 18 April 2026, melalui Surat No. e-0037/KI.02.00 tanggal 31 Maret 2026 kepada Biro Kerja Sama Daerah.<br>Biro Kerja Sama Daerah telah membuat surat kepada Duta Besar Kerajaan Thailand untuk memohon izin peliputan No. 36/HM/03 tanggal 1 April 2026.<br>Peliputan telah dilaksanakan pada 18 April 2026.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-31',
                'tanggal_selesai' => '2026-04-18',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Uruguay',
                'kolaborasi' => 'Permohonan penataan cahaya di Monumen Nasional dalam rangka hubungan diplomatik Indonesia-Uruguay',
                'rangkuman' => 'Berdasarkan nota diplomatik No. NV 064/2026 tanggal 22 April 2026 dari Kedutaan Besar Uruguay ke Kementerian Luar Negeri RI, dan surat No. 05719/PK/05/2026/67 tanggal 6 Mei 2026 dari Kementerian Luar Negeri RI kepada Kepala Biro Kerja Sama Daerah, dan dengan menimbang hasil Rapat Koordinasi tanggal 29 April 2026 yang disampaikan melalui Surat Biro Kerja Sama Daerah No. 13/RR.01.02 tanggal 7 Mei 2026 Kepada Kementerian Luar Negeri RI, diberitahukan bahwa Kedutaan Besar Republik Oriental Uruguay memohon penataan pencahayaan lampu di kawasan Monimen Nasional dengan warna bendera Uruguay, dalam rangka peringatan 60 Tahun Hubungan Diplomatik RI Uruguay.<br>Permohonan telah dilaksanakan 9 Juni 2026',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-22',
                'tanggal_selesai' => '2026-06-09',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Perancis',
                'kolaborasi' => 'Pelaksanaan Fete de la Musique dalam rangka menuju ulang tahun Jakarta ke-500',
                'rangkuman' => 'Melalui Surat No. 158/IFI/2026 tanggal 2 Maret 2026 kepada Gubernur DKI Jakarta, Pusat Kebudayaan Perancis/IInstitut Français d\'Indonésie (IFI) mengajukan inisiatif untuk melaksanakan acara penampilan seni budaya Fête de la Musique, dalam rangka perayaan ulang tahun Jakarta ke-499.<br>Acara dilaksanakan oleh Dinas Pariwisata dan Ekonomi Kreatif pada tanggal 21 Juni 2026, dan Dinas Kenudayaan pada tanggal 22 Juni 2026',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-24',
                'tanggal_selesai' => '2026-06-22',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Hungaria',
                'kolaborasi' => 'Permohonan kolaborasi pameran Threads of Wax, sekaligus undangan kepada Gubernur DKI Jakarta untuk menghadiri pembukaan pameran.',
                'rangkuman' => 'Melalui Surat No. KUM/18688/2026/ADM tanggal 9 Juni 2026 Kepada Gubernur DKI Jakarta, Kedutaan Besar Hungaria menyampaikan permohonan untuk meggunakan Museum Seni dan Keramik sebagai venue pameran Threads of Wax, yang merupakan pameran kolaborasi tekstil sulam Hungaria dan batik. Sehubungan dengan ini, Kedutaan Besar Hungaria memohon bantuan fasilitasi dari Biro Kerja Sama Daerah, dan saran terkait mengaitkan acara dimaksud dengan perayaan 499 tahun Ulang Tahun Jakarta.<br>Dukungan fasilitasi telah diberikan, dan pembukaan acara dihadiri oleh Gubernur DKI Jakarta pada 29 Juni 2026.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-10',
                'tanggal_selesai' => '2026-06-29',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_kedutaan_besar_id' => 'Kedutaan Besar Republik Islam Pakistan',
                'kolaborasi' => 'Permohonan fasilitasi dan koordinasi pemutaran film "Jinnah" di Gedung Pertunjukan Seni Budaya',
                'rangkuman' => 'Melalui Surat No. Cons-03/06/2026 tanggal 3 Juni 2026, Kedutaan Besar Republik Islam Pakistan memohon kepada Kepala Unit Pengelola Gedung Pertunjukan Seni Budaya Dinas Kebudayaan untuk dapat menggunakan Gedung Kesenian Jakarta untuk melaksanakan pemutaran Film "Jinnah".<br>Acara telah dilaksanakan pada 21 Juni 2026.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-14',
                'tanggal_selesai' => '2026-06-21',
                'triwulan_kolaborasi' => 'TW II',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_non_perwakilan_negara_asing' => 'Stuttgart Philharmonic Orchestra',
                'kolaborasi' => 'Rencana Kolaborasi Stuttgart Philharmonic Orchestra',
                'rangkuman' => 'The Stuttgart Philharmonic Orchestra berencana untuk melaksanakan tur ke Jakarta pada tahun 2027, bertepatan dengan perayaan ulang tahun diplomatik ke-75 RI dan Republik Federal Jerman\'. Stuttgart Philharmonic mengharapkan kontribusi dari Pemerintah Provinsi DKI Jakarta untuk membantu pendanaan tur tersebut.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-19',
                'tanggal_selesai' => null,  // sheet: "Batal"
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
                'tanggal_selesai' => null,  // sheet: "Berjalan"
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
                'nama_perwakilan_ri' => 'KJRI Mumbai',  // sheet: "Mitra Non-PNA"
                'kolaborasi' => 'KJRI Mumbai - Rencana pelaksanaan Jakarta-Mumbai (JAMU) 2026',
                'rangkuman' => 'Melalui Surat No --/SOS/UM/I/2026 tanggal 26 Januari 2026, Konsul Jenderal RI di Mumbai mengajukan permohonan pertemuan dengan Kepala Biro Kerja Sama Daerah. Pertemuan diharapkan dapat terlaksana pada rentang tanggal 10-13 Februari 2026, bertepatan dengan agenda kegiatan kedinasan Konjen RI di Jakarta pada 9-13 Februari 2026.<br>Pertemuan bertujuan untuk membahas penguatan kolaborasi ekonomi, perdagangan, pariwisata, kuliner, sosial-budaya, dan pendidikan melalui hubungan "Sister City" antara Jakarta dan Mumbai.<br>Pengembangan hubungan ini merupakan kelanjutan dari acara the 1st Jakarta Mumbai Update (JAMU) yang dilaksanakan pada 20-21 Agustus 2025.<br>KJRI Mumbai berencana menyelenggarakan the 2nd Jakarta - Mumbai Update (JAMU) 2026 pada 26-28 Juni 2026 di Mumbai.',
                'catatan' => 'Jika terdapat catatan harap ditulis dan lengkapi link gdrive untuk akses dokumen kolaborasi',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-02-12',
                'tanggal_selesai' => null,  // sheet: "Dialihkan ke Sub-Kelompok Kerjasama Pemerintah Daerah Dalam Negeri"
                'triwulan_kolaborasi' => 'TW I',
                'status_kolaborasi' => 'Selesai',
                'nama_pic' => null,
                'nomor_pic' => null,
            ],
            [
                'nama_pemprov_dki' => 'Badan Kesatuan Bangsa dan Politik',
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

        foreach ($data as $item) {
            $idMitra = $this->ambilIdMitra($item);

            if (! $idMitra) {
                continue;
            }

            Kolaborasi::create([
                'id_mitra' => $idMitra,
                ...$item,
                'is_active' => true,
            ]);
        }
    }
}
