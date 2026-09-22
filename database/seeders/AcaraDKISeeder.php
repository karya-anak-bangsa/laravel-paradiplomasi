<?php

namespace Database\Seeders;

use App\Models\AcaraDKI;
use App\Models\KedutaanBesar;
use App\Models\NonPerwakilanNegaraAsing;
use Illuminate\Database\Seeder;

class AcaraDKISeeder extends Seeder
{
    /**
     * Sumber data: sheet "Acara DKI" (kode arsip "-EV-") pada spreadsheet Data
     * Paradiplomasi Jakarta 2026 (10 baris data, sesuai jumlah baris berisi pada
     * sheet acuan).
     *
     * Empat baris tambahan yang tercantum setelah tabel Acara DKI pada sheet yang
     * sama (kode arsip "-LL-": pensiun Dubes Malaysia, rapat koordinasi Kemlu RI,
     * 2x pemberitahuan rekayasa lalu lintas) SENGAJA TIDAK diikutsertakan di sini —
     * sesuai konfirmasi bisnis, keempatnya BUKAN Acara DKI (bukan acara yang
     * dihadiri mitra), melainkan kategori arsip "Lain-Lain" yang terpisah.
     *
     * PENTING - relasi ke mitra (pivot tb_acara_dki_mitra):
     * Kolom "Mitra yang Hadir" pada sheet acuan adalah SATU-SATUNYA sumber
     * terstruktur untuk kehadiran mitra. Sesuai arahan bisnis, kolom ini hanya
     * berisi mitra yang BENAR-BENAR hadir, sehingga setiap mitra yang di-seed di
     * sini diberi status_kehadiran = 'Hadir'. Status 'Diundang' pada sheet acuan
     * hanya tersirat di narasi bebas kolom Rangkuman (tidak terstruktur per-mitra),
     * sehingga tidak diimpor sebagai baris pivot terpisah — opsi enum Diundang/
     * Tidak Hadir tetap tersedia di skema untuk pencatatan manual berikutnya.
     *
     * Baris tanpa mitra terkonfirmasi (Djakarta Ennichi 2026 - dibatalkan, Jakarta
     * Future Festival 2026 - kehadiran belum dikonfirmasi ulang oleh Bappeda,
     * Jakarta Investment Forum - kehadiran belum dikonfirmasi ulang oleh Dinas
     * PM-PTSP) DIIMPOR TANPA baris pivot mitra. Ini melewati validasi form ('mitra'
     * => min:1 pada Store/UpdateAcaraDKIRequest) karena seeder menulis langsung ke
     * model, bukan lewat HTTP request — pengecualian yang disengaja khusus untuk
     * migrasi data historis ini.
     *
     * Organisasi internasional yang muncul sebagai penghadir pada baris "Resepsi
     * HUT ke-499 Jakarta" (Breathe Cities/C40 Cities, ICLEI Indonesia, UCLG ASPAC,
     * UN Resident Coordinator Indonesia) adalah mitra Non Perwakilan Negara Asing.
     * Keempatnya kini di-seed lewat NonPerwakilanNegaraAsingSeeder bersama seluruh
     * mitra Non-PNA lain dari sheet Riwayat Diplomasi, sehingga seeder ini cukup
     * me-lookup nama-nya (sebelumnya memakai firstOrCreate() karena tabel
     * tb_non_perwakilan_negara_asing belum punya seeder tersendiri).
     *
     * Baris "Resepsi HUT ke-499 Jakarta" membedakan tingkat kehadiran per mitra
     * pada sheet acuan (Duta Besar vs CdA/Wakil). Perbedaan ini dipertahankan lewat
     * kolom keterangan_kehadiran untuk mitra yang hadir setingkat CdA/Wakil (bukan
     * Duta Besar), karena relevan secara protokoler bagi Biro KSD.
     *
     * Koreksi data terhadap sheet acuan:
     *   - Baris "Jakarta Investment Forum": tanggal_selesai pada sheet tertulis 28
     *     Agustus 2028 (typo jelas — tidak konsisten dengan tanggal_diterima 18
     *     Agustus 2026 dan tanggal pelaksanaan 28 Agustus 2026 pada baris yang
     *     sama) -> dikoreksi menjadi 2026-08-28.
     *
     * Nama resmi Kedutaan Besar mengikuti ejaan pada seeder mitra
     * (nama_kedutaan_besar_id di KedutaanBesarPart1-11Seeder), bukan istilah bebas
     * pada narasi sheet Acara DKI (mis. sheet menulis "Rusia" -> seeder mitra
     * "Kedutaan Besar Federasi Rusia").
     *
     * Field 'catatan' bersifat wajib (required) pada StoreAcaraDKIRequest. Baris
     * pada sheet acuan yang kolom Catatan-nya kosong diberi placeholder instruksi
     * untuk operator, mengikuti pola KerjasamaSeeder.
     *
     * Kolom "Data" (kode referensi arsip internal) dan "Kontak" pada sheet tidak
     * disimpan karena tidak ada padanan kolom pada skema tb_acara_dki.
     */
    public function run(): void
    {
        $data = [
            [
                'pelaksana' => 'Dinas Pariwisata dan Ekonomi Kreatif; Suku Dinas Pariwisata dan Ekonomi Kreatif Jakarta Barat',
                'acara_dki' => '<p>Cap Go Meh 2026</p>',
                'rangkuman' => '<p>Pemerintah Provinsi DKI Jakarta telah mencanangkan sejumlah kegiatan dalam menyambut Hari Raya Tahun Baru Imlek 2026 dan Cap Go Meh 2026, salah satunya adalah perayaan Cap Go Meh 2026. Dalam melaksanakan acara-acara ini, Pemerintah Provinsi DKI Jakarta berharap untuk dapat berkolaborasi dengan Kedutaan Besar Republik Rakyat Tiongkok di Jakarta, salah satunya melalui penampilan seni budaya Tiongkok dalam Imlek Festival 2026. Acara dihadiri oleh Mr. Zhen Wangda, Counselor, Embassy of the People\'s Republic of China</p>',
                'catatan' => '<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-01-27',
                'tanggal_selesai' => '2026-03-04',
                'tanggal_awal_pelaksanaan' => '2026-03-03',
                'tanggal_akhir_pelaksanaan' => '2026-03-04',
                'triwulan_acara_dki' => 'TW I',
                'status_acara_dki' => 'Selesai',
                'mitra' => [
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Rakyat Tiongkok',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                ],
            ],
            [
                'pelaksana' => 'Panitia Djakarta Ennichi 2026',
                'acara_dki' => '<p>Djakarta Ennichi 2026</p>',
                'rangkuman' => '<p>Panitia Djakarta Ennichi, bersama dengan Dinas Kebudayaan Provinsi DKI Jakarta, berencana melaksanakan Djakarta Ennichi 2026 dan memohon bantuan Biro Kerja Sama Daerah Setda Provinsi DKI Jakarta untuk membuat draft surat undangan kepada calon-calon mitra kolaborasi dari Jepang Karena beberapa kendala dengan event organizer, pelaksanaan acara dibatalkan.</p>',
                'catatan' => '<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-03-30',
                'tanggal_selesai' => '2026-05-24',
                'tanggal_awal_pelaksanaan' => '2026-05-23',
                'tanggal_akhir_pelaksanaan' => '2026-05-24',
                'triwulan_acara_dki' => 'TW II',
                'status_acara_dki' => 'Batal',
                'mitra' => [],
            ],
            [
                'pelaksana' => 'Biro Kepala Daerah; Dinas Kebudayaan; Dinas Pariwisata dan Ekonomi Kreatif',
                'acara_dki' => '<p>Lebaran Betawi 2026</p>',
                'rangkuman' => '<p>Pemerintah Provinsi DKI Jakarta menyelenggarakan acara Lebaran Betawi pada hari Minggu, 12 April 2026, dengan mengundang perwakilan dari Kedutaan-kedutaan Besar Negara ASEAN. Tiga Kedutaan Besar tercatat menghadiri: Kedutaan Besar Singapura, Kedutaan Besar Malaysia, dan Kedutaan Besar Thailand. 1. Mrs. Hathaichanok Riddhagni Frumau, Minister and Deputy Chief of Mission, Embassy of Thailand 2. Mr. Farzamie Sarkawi, Chargé d\'affaires of Embassy of Malaysia 3. Mr. Gordon Ng, Second Secretary, Embassy of Singapore. 4. Pendamping dari Kedutaan Besar Malaysia: Ms. Rosnita Hamzah, Counsellor.</p>',
                'catatan' => '<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-04-06',
                'tanggal_selesai' => '2026-04-13',
                'tanggal_awal_pelaksanaan' => '2026-04-12',
                'tanggal_akhir_pelaksanaan' => '2026-04-13',
                'triwulan_acara_dki' => 'TW II',
                'status_acara_dki' => 'Selesai',
                'mitra' => [
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Malaysia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Singapura',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Thailand',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                ],
            ],
            [
                'pelaksana' => 'Biro Pembangunan dan Lingkungan Hidup',
                'acara_dki' => '<p>Pencanangan 5 Abad Jakarta dan Gerakan Pilah Sampah.</p>',
                'rangkuman' => '<p>Biro Pembangunan dan Lingkungan Hidup menyelenggarakan acara Pencanangan 5 Abad Jakarta dan Deklarasi Gerakan Pilah sampah pada 10 Mei 2026, di Plaza Festival, Jalan H.R. Rasuna Said No. 22, Setiabudi, Jakarta Selatan. Acara dihadiri oleh: 1. H.E. Mr. Armin Limo, Ambassador of Bosnia and Herzegovina 2. H.E. Mr. Enrique Antonio Acuña Mendoza, Ambassador of the Bolivarian Republic of Venezuela 3. H.E. Mr. Sandeep Chakravorty, Ambassador of India 4. H.E. Mr. Kwok Fook Seng, Ambassador of the Republic of Singapore 5. H.E. Mr. Marc David Gerritsen, Ambassador of the Kingdom of the Netherlands + Spouse 6. Ms. Rosnita Hamzah, Counsellor, Embassy of Malaysia</p>',
                'catatan' => '<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-05-06',
                'tanggal_selesai' => '2026-05-11',
                'tanggal_awal_pelaksanaan' => '2026-05-10',
                'tanggal_akhir_pelaksanaan' => '2026-05-11',
                'triwulan_acara_dki' => 'TW II',
                'status_acara_dki' => 'Selesai',
                'mitra' => [
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Bosnia dan Herzegovina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Venezuela',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar India',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Singapura',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Kerajaan Belanda',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Malaysia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                ],
            ],
            [
                'pelaksana' => 'Biro Kepala Daerah',
                'acara_dki' => '<p>Resepsi bertema Senja di Jakarta: Memperingati HUT ke-499 Kota Jakarta/Jakarta Twilight Soirée: Commemorating Jakarta’s 499th Anniversary</p>',
                'rangkuman' => '<p>Dalam rangka memperingati Hari Ulang Tahun Jakarta ke-499, Pemerintah Provinsi DKI Jakarta menyelenggarakan resepsi pada Senin, 22 Juni 2026 16.00 WIB, di Ruang Sriwijaya, Gedung A.A. Maramis, Jakarta Pusat dengan tema Senja di Jakarta: Memperingati HUT ke-499 Kota Jakarta/Jakarta Twilight Soirée: Commemorating Jakarta’s 499th Anniversary Acara dimaksud mengundang sejumlah Perwakilan Negara Asing di Jakarta serta beberapa organisasi internasional yang merupakan mitra-mitra Provinsi DKI Jakarta. Acara telah dilaksanakan dan dihadiri oleh: Duta Besar: 1. H.E. Mr. Enkhtaivan Dashnyam, Ambassador of Mongolia 2. H.E. Ms. Rut Kruger Giverin, Ambassador, of Norway 3. H.E. Mr. Dan Adrian Bălănescu, Ambassador of Romania 4. H.E. Mr. Olivier Zehnder, Ambassador of Switzerland 5. H.E. Mrs. Lilla Karsay, Ambassador of Hungary 6. H.E. Prof. Fekadu Beyene Aleka Ambassador of the Federal Democratic Republic of Ethiopia 7. H.E. Mr. Tean Samnang, Ambassador of Cambodia 8. H.E. Mr. Armin Limo, Ambassador of Bosnia and Herzegovina 9. H.E. Mr. Ta Van Thong, Ambassador of the Socialist Republic of Viet Nam 10. H.E. Mr. Mario Ignacio Artaza, Ambassador of Chile 11. H.E. Sheikh Mohamed bin Ahmed bin Salim Al Shanfari, Ambassador of Oman 12. H.E. Mr. Serob Bejanyan, Ambassador of the Republic of Armenia 13. H.E. Mr. Salam Al Achkar, Ambassador of the Republic of Lebanon 14. H.E. Ms. Cristina González, Ambassador of Uruguay 15. H.E. Mr. Khalid Jassim Alyassin, Ambassador of the State of Kuwait 16. H.E. Mr. Ramil Rzayev, Ambassador of the Republic of Azerbaijan 17. H.E. Mr. Mohammad Boroujerdi, Ambassador of the Islamic Republic of Iran 18. H.E. Mr. Manuel Estuardo Roldán Barillas, Ambassador of the Republic of Guatemala 19. H.E. Mr. Ahmed Abdulla Alharmasi Alhajeri, Ambassador of the Kingdom of Bahrain 20. H.E. Mr. Luis Arellano Jibaja, Ambassador of Ecuador 21. H.E. Ms. Ivana Golubovic Duboka, Ambassador of the Republic of Serbia 22. H.E. Mr. Francisco de la Torre Galindo, Ambassador of Mexico 23. H.E. Mr. António Rodrigues José, Ambassador of Mozambique 24. H.E. Mr. Tornike Nozadze, Ambassador of Georgia 25. H.E. Prof. Dr. Talip Küçükcan, Ambassador of the Republic of Türkiye 26. H.E. Sheikh Abdul Karim Harelimana, Ambassador of the Republic of Rwanda 27. H.E. Mr. Marc Gerritsen, Ambassador of the Kingdom of the Netherlands 28. H.E. Mr. Ralf Beste, Ambassador of the Federal Republic of Germany 29. H.E. Mr. Bernardo de Sicart Escoda, Ambassador of Spain 30. H.E. Mr. Dimitrios Michapoulos, Ambassador of Greece 31. H.E. Ms. Tanya Dimitrova, Ambassador of Bulgaria 32. H.E. Mr. Yoon Soongu, Ambassador of the Republic of Korea 33. H.E. Mr. Abdulla Salem AlDhaheri, Ambassador of the United Arab Emirates 34. H.E. Mr. Kwok Fook Seng, Ambassador of Singapore.. 35. H.E. Mr. Sergei Tolchenov, Ambassador of the Russian Federation 36. H.E. Mr. Abdulmonem Annan, Ambassador of the Syrian Arab Republic 37. H.E. Mr. Salem Ahmed Abdulrahman Balfakeeh, Ambassador of the Republic of Yemen 38. H.E. Mr. Oybek Eshonov, Ambassador of Uzbekistan 39. H.E. Mr. Raman Ramanouski, Ambassador of the Republic of Belarus 40. H.E. Mr. Redouane Houssaini, Ambassador of the Kingdom of Morocco 41. H.E. Mr. Fabien Penone, Ambassador of France 42. H.E. Mr. Gustavo Coppa, Ambassador,Ambassador of Argentina 43. H.E. Mr. Abdirashid Salat Abdille, Ambassadorof the Republic of Kenya 44. H.E. Mr. Faisal Abdullah H. Amodi, Ambassador of the Kingdom of Saudi Arabia 45. H.E. Mr. Prapan Disytatat, Ambassador of Thailand 46. H.E. Mr. Mpetjane Kgaogelo Lekgoro, Ambassador of the Republic of South Africa, 47. H.E. Mr. Abdelouahab Osmane, Ambassador, Embassy of Algeria 48. H.E. Mr. Florêncio de Almeida, Ambassadorof Republic of Angola 49. H.E. Mr. Enrique Antonio Acuña Mendoza, Ambassador of the Bolivarian Republic of Venezuela 50. H.E. Mr. Abdalfatah Ahmed Khalil Alsattari, Ambassador of the State of Palestine 51. H.E. Mr. Roberto Sarmento De Oliveira Soares, Ambassador of The Democratic Republic Of Timor-Leste CdA, Perwakilan Lain: 1. Ms. Maushumi Rahman, Chargé d\'Affaires, Embassy of the People\'s Republic of Bangladesh 2. Mr. Farzamie Sarkawi, Chargé d\'Affaires, Embassy of Malaysia 3. Dr. Ammar Hameed Saadallah Al-Khalidy, Chargé d\'Affaires, The Embassy of the Republic of Iraq 4. Mr. Mawlawi Sadullah Baloch, Chargé d\'Affaires, Embassy of Afghanistan 5. Mr. Myochin Mitsuru, Chargé d\'Affaires, Embassy of Japan 6. Mrs. Angeliqa Lejonberg, Chargé d\'Affaires, Embassy of Sweden 7. Mr. Arnur Tanbay, Chargé d\'Affaires, Embassy of Kazakhstan 8. Mr. Daniel Dom, Chargé d\'Affaires, Embassy of the Slovak Republic 9. Mr. Michael Wislocki, Chargé d\'Affaires, Embassy of the Republic of Austria 10. Ms. Yevheniia Shynkarenko, Chargé d\'Affaires, Embassy of Ukraine 11. Mr. Nikson Ballço, Chargé d\'Affaires, Embassy of Albania 12. Mr. Nicolas de Bonhome, Consul, Embassy of Belgium 13. Mr. Zhen Wangda, Counselor, Embassy of the People\'s Republic of China 14. Ms. Gita Kamath, Deputy Ambassador, Australian Embassy 15. Mr. Gonaranao B. Musor, Deputy Chief of Mission and Consul General, Philippine Embassy 16, Mr. Anwar Hassan Ali Fadlalla, Deputy Head of Mission, Embassy of the Republic of the Sudan 17. Mrs. Shaima Salem Alhebsi, Deputy Head of Mission, Embassy of the United Arab Emirates 18. Mr. Igor Pronobis, Deputy Head of Political, Press and Information, Delegation of the European Union 19. Mr. Hussaini Hassan, First Secretary, Embassy of Nigeria 20. Mr. Suleiman Ahmed Saleh, Head of Chancery/Minister Plenipotentiary, Embassy of the United Republic of Tanzania 21. Mr. Francisco José Masís Holdridge, Head of Mission, Embassy of Costa Rica Perwakilan Organisasi Internasional 1. Mr. Fadhil Muhammad Firdaus, City Advisor, Breathe Cities, C40 Cities 2. Juniarti Elisabeth, Membership and Communication Officer, ICLEI Indonesia 3. Aniessa Delima Sari, Strategic Services and Programme Manager, United Cities and Local Governments Asia Pacific (UCLG ASPAC) 4. Gita Sabharwal, UN Resident Coordinator in Indonesia, United Nations</p>',
                'catatan' => '<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-05',
                'tanggal_selesai' => '2026-06-23',
                'tanggal_awal_pelaksanaan' => '2026-06-22',
                'tanggal_akhir_pelaksanaan' => '2026-06-23',
                'triwulan_acara_dki' => 'TW II',
                'status_acara_dki' => 'Selesai',
                'mitra' => [
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Afrika Selatan',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Demokratik Aljazair',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Angola',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Arab Saudi',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Argentina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Armenia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Azerbaijan',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Kerajaan Bahrain',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Kerajaan Belanda',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Belarus',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Bosnia dan Herzegovina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Bulgaria',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Chili',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Ekuador',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Demokratik Federal Ethiopia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Georgia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Guatemala',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Hungaria',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Islam Iran',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Federal Jerman',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Kamboja',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Kenya',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Korea',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Kuwait',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Lebanon',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Kerajaan Maroko',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Meksiko',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Mongolia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Mozambik',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Norwegia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Kesultanan Oman',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Palestina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Perancis',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Persatuan Emirat Arab',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Rumania',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Federasi Rusia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Rwanda',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Serbia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Singapura',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Kerajaan Spanyol',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Arab Suriah',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Swiss',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Thailand',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Timor Leste',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Turki',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Uruguay',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Uzbekistan',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Venezuela',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Vietnam',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Yaman',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Yunani',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Afghanistan',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Albania',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Australia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Austria',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Bangladesh',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Belgia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Filipina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Irak',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Jepang',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Kazakhstan',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Kosta Rika',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Malaysia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Federal Nigeria',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Persatuan Emirat Arab',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Rakyat Tiongkok',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Slovakia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Sudan',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Swedia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Persatuan Tanzania',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Ukraina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Delegasi Uni Eropa',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => 'Hadir diwakilkan oleh Chargé d\'Affaires (CdA) atau pejabat setingkat, bukan oleh Duta Besar.',
                    ],
                    [
                        'type' => 'non_pna',
                        'nama' => 'Breathe Cities, C40 Cities',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'non_pna',
                        'nama' => 'ICLEI Indonesia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'non_pna',
                        'nama' => 'United Cities and Local Governments Asia Pacific (UCLG ASPAC)',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'non_pna',
                        'nama' => 'UN Resident Coordinator in Indonesia, United Nations',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                ],
            ],
            [
                'pelaksana' => 'Badan Perencanaan Pembangunan Daerah',
                'acara_dki' => '<p>Jakarta Future Festival 2026</p>',
                'rangkuman' => '<p>Badan Perencaaan Pembangunan Daerah mengundang sejumlah Kedutaan Besar untuk menghadiri Jakarta Future Festival pada 5 s.d. 7 Juni 2026.</p>',
                'catatan' => '<p>Perlu dilaksanakan koordinasi dengan Bappeda Provinsi DKI Jakarta untuk mengetahui Kedutaan Besar yang hadir</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-01',
                'tanggal_selesai' => '2026-06-08',
                'tanggal_awal_pelaksanaan' => '2026-06-07',
                'tanggal_akhir_pelaksanaan' => '2026-06-08',
                'triwulan_acara_dki' => 'TW II',
                'status_acara_dki' => 'Selesai',
                'mitra' => [],
            ],
            [
                'pelaksana' => 'Dinas Pariwisata dan Ekonomi Kreatif',
                'acara_dki' => '<p>Pembukaan Jakarta Folklore Festival 2026</p>',
                'rangkuman' => '<p>Jakarta menjadi tuan rumah penyelenggaraan Jakarta World FolkFest 2026 yang menghadirkan 115 delegasi internasional dari enam negara, yaitu Romania, Yunani, Polandia, Filipina, Rusia, dan Korea Selatan. Acara diselenggarakan bersamaan dengan momentum perayaan HUT ke-499 Jakarta dari tanggal 1 sampai 7 Juli 2026. Para delegasi diagendakan untuk mengunjungi beberapa tempat wisata di Jakarta, dan pada tanggal 3, 4, dan 5 Juli, para delegasi bergabung dengan tim-tim kesenian dari Jakarta akan tampil di anjungan Sarinah. Acara ini dihadiri oleh: 1. H.E. Mr. Dan Adrian Bălănescu, Ambassador of Romania 2. H.E. Mr. Yoon Soongu, Ambassador of the Republic of Korea 3. Ms. Radegunda Dela Cruz, Cultural Officer and Attaché, Embassy of the Republic of the Philippines 4. Mrs. Karolina Ionescu, Secretary II, Political Affairs, Embassy of the Republic of Poland 5. Representative of the Embassy of the Russian Federation</p>',
                'catatan' => '<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-06-26',
                'tanggal_selesai' => '2026-07-08',
                'tanggal_awal_pelaksanaan' => '2026-07-07',
                'tanggal_akhir_pelaksanaan' => '2026-07-08',
                'triwulan_acara_dki' => 'TW II',
                'status_acara_dki' => 'Selesai',
                'mitra' => [
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Rumania',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Korea',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Filipina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Federasi Rusia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Polandia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                ],
            ],
            [
                'pelaksana' => 'Dinas Kebudayaan Provinsi DKI Jakarta',
                'acara_dki' => '<p>Kharisma Batavia 2026</p>',
                'rangkuman' => '<p>Pada hari Kamis, 16 Juli 2026 pukul 16.00 WIB telah dilaksanakan Rapat Koordinasi Dukungan Kegiatan "Kharisma Batavia Menuju Jakarta" melalui Zoom Meeting. Rapat dipimpin oleh Kepala Unit Pengelola Museum Seni mewakili Kepala Dinas Kebudayaan Provinsi DKI Jakarta, serta dihadiri oleh panitia penyelenggara dari Perhimpunan Kebayaku, tenaga ahli Staf Khusus Gubernur (Ibu Amel Sannie) dan para perwakilan OPD terkait, antara lain Bappeda, Biro Kepala Daerah, Biro Umum, Biro Kerja Sama Daerah, Dinas Pertamanan dan Hutan Kota, serta Dinas Pariwisata dan Ekonomi Kreatif. Kegiatan "Kharisma Batavia Menuju Jakarta" diselenggarakan oleh Perhimpunan Kebayaku bekerja sama dengan Pemerintah Provinsi DKI Jakarta pada hari Jumat, 31 Juli 2026 di Balai Agung, Balai Kota Provinsi DKI Jakarta. Jumlah tamu diperkirakan sekitar 200 orang, terdiri atas para Duta Besar beserta istri, pejabat Pemerintah Provinsi DKI Jakarta, dan undangan khusus. Acara dihadiri oleh: Peraga busana: 1. H. E. Barbara Szymanowska - Ambassador of the Republic of Poland 2. H. E. Dr. Tanya Dimitrova - Ambassador of the Republic of Bulgaria 3. Madam Taruna Chakravorty, Spouse of the Ambassador of India 4. Madam Emina Limo, Spouse of the Ambassador of Bosnia & Herzegovina Tamu undangan: 1. H.E. Mrs. Ivana Golubović - Duboka, Ambassador of the Republic of Serbia to the Republic of Indonesia 2. H.E. Mr. Enkhtaivan Dashnyam Uyangatsetseg Ulzii-ochir, Ambassador of Mongolia to the Republic of Indonesia 3. H.E. Mrs. Sumadhurika Sashikala Premawardhane, Ambassador of the Democratic Socialist Republic of Sri Lanka to the Republic of Indonesia 4. Ms. Patricia Nora Pankovics, Consul/Cultural Attaché, Embassy of Hungary 5. Ms. Ms. Yevhenia, Chargé d\'Affaires a.i. Embassy of Ukraine in Indonesia 6. Representative of the Embassy of Portugal</p>',
                'catatan' => '<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-16',
                'tanggal_selesai' => '2026-08-01',
                'tanggal_awal_pelaksanaan' => '2026-07-31',
                'tanggal_akhir_pelaksanaan' => '2026-08-01',
                'triwulan_acara_dki' => 'TW III',
                'status_acara_dki' => 'Selesai',
                'mitra' => [
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Bosnia dan Herzegovina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Bulgaria',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Hungaria',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar India',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Mongolia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Polandia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Portugal',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Republik Serbia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Sri Lanka',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Ukraina',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                ],
            ],
            [
                'pelaksana' => 'Biro Pembangunan dan Lingkungan Hidup',
                'acara_dki' => '<p>Penanaman Mangrove dalam rangka Hari Mangrove Sedunia.</p>',
                'rangkuman' => '<p>Dalam rangka memperingati Perayaan Hari Mangrove Sedunia, Biro Pembangunan dan Lingkungan Hidup melaksanakan acara penyelenggaraan Penanaman Mangrove pada Minggu, 26 Juli 2026, di Lahan Kewajiban PT. KNI, Pantai Indah Kapuk, Jakarta Utara. Acara dihadiri oleh Ms. Rosnita Hamzah, Counsellor, Embassy of Malaysia.</p>',
                'catatan' => '<p>Jika terdapat catatan tambahan terkait acara ini, harap dilengkapi di sini beserta link gdrive untuk akses dokumen pendukung (jika ada).</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-07-12',
                'tanggal_selesai' => '2026-07-31',
                'tanggal_awal_pelaksanaan' => '2026-07-30',
                'tanggal_akhir_pelaksanaan' => '2026-07-31',
                'triwulan_acara_dki' => 'TW III',
                'status_acara_dki' => 'Selesai',
                'mitra' => [
                    [
                        'type' => 'kedutaan_besar',
                        'nama' => 'Kedutaan Besar Malaysia',
                        'status_kehadiran' => 'Hadir',
                        'keterangan_kehadiran' => null,
                    ],
                ],
            ],
            [
                'pelaksana' => 'Jakarta Investment Forum',
                'acara_dki' => '<p>Undangan untuk menghadiri Jakarta Investment Forum</p>',
                'rangkuman' => '<p>Pemerintah Provinsi DKI Jakarta mengirimkan undangan untuk menghadiri pembukaan Jakarta Investment Forum kepada sejumlah Perwakilan Negara Asing di Jakarta, sebagai berikut: 1. Deputy Secretary-General of ASEAN for Community and Corporate Affairs, ASEAN Secretariat 2. Ambassador of the Republic of Singapore to Indonesia 3. British Ambassador to Indonesia and Timor Leste 4. Chargé d’Affaires ad interim for the U.S. Mission to Indonesia 5. Australian Ambassador to Indonesia 6. Charge d\'Affaires of the Embassy of the Republic of Korea to Indonesia 7. Ambassador of Japan to Indonesia 8. Ambassador of the People\'s Republic of China in Jakarta to Indonesia 9. Ambassador of Malaysia to Indonesia 10. Ambassador of the Kingdom of the Netherlands in Indonesia 11. Ambassador of the Kingdom of Thailand to the Republic of Indonesia 12. Ambassador of Laos to Indonesia 13. Ambassador of Myanmar to Indonesia 14. Ambassador of Timor Leste to Indonesia 15. Ambassador of the Socialist Republic of Vietnam to Indonesia 16. Ambassador of Brunei Darussalam to Indonesia 17. Ambassador of the Royal Embassy of Cambodia to Indonesia 18. Permanent Mission of Cambodia to ASEAN (Indonesia) 19. Permanent Mission of the Democratic Republic of Timor-Leste to ASEAN 20. Charge d\'Affaires, a.i. / Minister and Consul General, Philippine Embassy in Indonesia 21. Permanent Mission of the Philippines to ASEAN 22. Ambassador of the United Arab Emirates to Indonesia and ASEAN 23. The France Ambassador to Indonesia, Timor-Leste, and ASEAN 24. Ambassador of Switzerland to Indonesia, Timor-Leste and ASEAN 25. First Secretary of the Embassy of the Kingdom of Belgium to Indonesia, Timor-Leste and ASEAN 26. Ambassador of Canada to Indonesia and Timor-Leste 27. Trade and Investment Director of the Government of New South Wales (NSW) 28. Head of Business and Talent Attraction/Investment Promotion of the Hong Kong Economic and Trade Office (HKETO) in Jakarta 29. Trade Commissioner, Malaysia External Trade Development Corporation (MATRADE) 30. Trade and Investment counselor for Indonesia, Malaysia & Singapore Wallonia Export & Investment Agency (AWEX) Status kehadirian kedutaan-kedutaan dimaksud pada acara ini perlu dicek kembali kepada Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu.</p>',
                'catatan' => '<p>Status kehadiran PNA pada acara ini perlu dicek kembali kepada Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu.</p>',
                'file_dokumen' => null,
                'tanggal_diterima' => '2026-08-18',
                'tanggal_selesai' => '2026-08-28',
                'tanggal_awal_pelaksanaan' => '2026-08-28',
                'tanggal_akhir_pelaksanaan' => '2026-08-28',
                'triwulan_acara_dki' => 'TW III',
                'status_acara_dki' => 'Selesai',
                'mitra' => [],
            ],
        ];

        foreach ($data as $item) {
            $mitraList = $item['mitra'];
            unset($item['mitra']);

            $acaraDki = AcaraDKI::create([
                ...$item,
                'is_active' => true,
            ]);

            $pivotMitra = [];

            foreach ($mitraList as $mitra) {
                $idMitra = match ($mitra['type']) {
                    'kedutaan_besar' => KedutaanBesar::where('nama_kedutaan_besar_id', $mitra['nama'])->value('id_mitra'),
                    'non_pna' => NonPerwakilanNegaraAsing::where('nama_non_perwakilan_negara_asing', $mitra['nama'])->value('id_mitra'),
                };

                if (! $idMitra) {
                    continue;
                }

                $pivotMitra[$idMitra] = [
                    'status_kehadiran' => $mitra['status_kehadiran'],
                    'keterangan_kehadiran' => $mitra['keterangan_kehadiran'] ?? null,
                ];
            }

            if ($pivotMitra) {
                $acaraDki->mitra()->attach($pivotMitra);
            }
        }
    }
}
