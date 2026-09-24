# Proyek Web Paradiplomasi Pemda DKI

_Terakhir diperbarui: 25 September 2026 — ekspor Excel/PDF kini juga tersedia di 8 modul Mitra (`App\Support\EksporMitra`, induk bersama `DaftarEkspor`, lihat Bagian 8); Daftar Undangan Acara DKI di PDF hanya "Nama (Status)", alasan kehadiran hanya di Excel. Sebelumnya: modul KBRI, KJRI, PTRI **digabung** menjadi satu modul **Perwakilan RI di Luar Negeri** (`tb_perwakilan_ri`, kolom `tipe_perwakilan_ri`), tipe mitra kini 8 jenis; data lama dipindah lewat migration `2026_09_25_110000_gabung_kbri_kjri_ptri_ke_tb_perwakilan_ri` (lihat Bagian 3). Sebelumnya: penambahan 2 jenis mitra: **Kantor Dagang Asing** & **Pusat Kebudayaan Asing** (pola "nama + keterangan"), urutan tipe mitra kini 10 jenis, dan TETO dipindah dari Non-PNA ke Kantor Dagang Asing lewat migration data. Sebelumnya: penataan ulang tombol (Logout → menu pengguna, ekspor → `x-tombol-ekspor` di header tabel; lihat Bagian 9.5). Sebelumnya: ekspor Excel/PDF di 6 modul Riwayat Diplomasi (`App\Support\EksporDiplomasi`, scope `daftarIndex()`). Sebelumnya: penambahan modul Pengaturan Sistem > Restore Data, enum `App\Enums\ModulDiplomasi`, dan pola "hapus" = nonaktifkan + soft delete lewat trait `MenonaktifkanData`._

## 1. Deskripsi Singkat
<p align="justify">
Website Paradiplomasi Jakarta adalah sistem informasi untuk pencatatan data diplomasi dan hubungan luar negeri Pemda DKI Jakarta yang diwakili oleh Biro Kerjasama Daerah (KSD) setda DKI Jakarta dengan beberapa mitra seperti kedutaan besar, misi asing untuk asean, misi permanen negara asean, dan non perwakilan negara asing. Saat ini, web paradiplomasi jakarta dalam tahap domain testing artinya hasil development akan dijalankan pada domain hostinger. Jika seluruh proses bisnis di web paradiplomasi telah selesai dikerjakan maka akan dilakukan deployment ke server resmi pemda dki yaitu server diskominfotik pemda dki.
</p>
<p align="justify">
Setiap mitra — kedutaan besar, misi asing asean, misi permanen negara asean, kantor dagang asing, pusat kebudayaan asing, Non Perwakilan Negara Asing, perangkat daerah Pemerintah Provinsi DKI Jakarta, serta Perwakilan RI di Luar Negeri (KBRI, KJRI, PTRI) — dapat melakukan diplomasi berupa Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara DKI dan tercatat di web paradiplomasi jakarta. Sebagai contoh, kedutaan besar australia dan misi australia untuk asean melakukan pergantian pimpinan. Lalu kedua pimpinan tersebut ingin berkunjung ke balai kota dki untuk bertemu dengan gubernur dki. Hal ini dilakukan untuk protokoler antara pemda dki dengan mitra biro ksd. Oleh karena itu, pada modul kunjungan akan tercatat dua data kunjungan. Pertama kunjungan duta besar australia dan kedua kunjungan kepala misi australia untuk asean. Walaupun pelaksanaan kunjungan dilakukan pada hari yang sama, namun proses pencatatannya dilakukan dua kali. Contoh lainnya, negara singapura yang diwakili oleh misi permanen republik singapura untuk asean ingin melakukan kerjasama dengan beberapa perguran tinggi di Indonesia. Adapun bentuk kerjasamanya adalah program pertukaran mahasiswa antara nanyang technological university dengan mahasiswa dari universitas indonesia, universitas gajah mada, institut teknologi bandung. Oleh karena itu, pada modul kerjasama akan tercatat satu kerjasama. Secara singkat, setiap riwayat diplomasi (modul kerjasama - acara dki) dapat mencatat data diplomasi dari berbagai jenis mitra biro ksd.
</p>
<p align="justify">
<strong>Pengecualian penting:</strong> modul Acara DKI memiliki proses bisnis yang berbeda dari kelima modul Riwayat Diplomasi lainnya. Satu Acara DKI dapat melibatkan <em>banyak mitra sekaligus</em> dalam satu peristiwa yang sama, masing-masing dengan status kehadirannya sendiri (Diundang/Hadir/Tidak Hadir) beserta alasannya. Lihat Bagian 4 untuk penjelasan lengkap beserta contoh kasus.
</p>

---

## 2. Pembagian Modul
- **Modul Mitra (8 jenis)** — urutan resmi (arahan Kasubag, 25 Sep 2026; dipakai `TipeMitra::cases()`, navbar, dropdown, dan kartu dashboard): Kedutaan Besar, Misi Asing ASEAN, Misi Permanen ASEAN, Kantor Dagang Asing, Pusat Kebudayaan Asing, Perwakilan RI di Luar Negeri, Pemprov DKI Jakarta, Non Perwakilan Negara Asing.
  - *Berbasis negara* (punya `kode_negara`/`nama_negara`, alamat, koordinat): Kedutaan Besar, Misi Asing untuk ASEAN, Misi Permanen Negara ASEAN.
  - *Nama + keterangan saja*: Kantor Dagang Asing, Pusat Kebudayaan Asing, Perwakilan RI di Luar Negeri (+ kolom pilihan `tipe_perwakilan_ri`), Pemerintah Provinsi DKI Jakarta, Non Perwakilan Negara Asing (label navbar "Mitra Non-PNA").

  Kedelapannya adalah *subtype* dari satu supertype `tb_mitra` — lihat Bagian 3. Perhatikan bedanya **Kedutaan Besar** (kedubes negara asing di Jakarta) dan **Perwakilan RI di Luar Negeri** (KBRI/KJRI/PTRI, perwakilan RI di negara lain): dua jenis mitra yang berbeda, bukan duplikat.
- **Modul Riwayat Diplomasi:** Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan (proses bisnis identik, 1 baris = 1 mitra), dan Acara DKI (proses bisnis berbeda, 1 acara = banyak mitra — lihat Bagian 4).
- **Modul Administrator:** Akun Pengguna, Riwayat Aktivitas, Restore Data.
- **Modul Pendukung:** Tanggal Penting (kalender read-only, tidak punya tabel sendiri).

| Nama Modul | Nama Tabel | Aksi | Keterangan |
|---|---|---|---|
| `Akun Pengguna` | `Hardcode dari AuthController` | login dan logout | View index (`mod_akun_pengguna.index`) sudah ada, tapi backend CRUD/listing pengguna belum diimplementasikan. |
| `Riwayat Aktivitas` | `belum dibuat` | - | View index sudah ada namun eksplisit berlabel **"Log Aktivitas Pengguna (Placeholder)"** — belum ada pencatatan log sungguhan. |
| `Restore Data` | *(tidak ada tabel sendiri)* | lihat, cari, pulihkan | **Sudah berfungsi.** Menampilkan seluruh data ter-soft-delete dari 14 modul (8 Mitra + 6 Riwayat Diplomasi) dan mengaktifkannya kembali **satu per satu** — tidak ada aksi massal. Daftar modulnya diturunkan dari `TipeMitra` + `ModulDiplomasi` lewat `App\Support\DataTerhapus`, jadi modul baru otomatis ikut terpantau. Lihat Bagian 9.3. |
| `Kedutaan Besar` | `tb_kedutaan_besar` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | ex. Kedutaan Besar Australia. "Hapus" = nonaktifkan (`is_active = false`), bukan hapus permanen. |
| `Misi Asing ASEAN` | `tb_misi_asing_asean` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | ex. Misi Australia untuk ASEAN |
| `Misi Permanen ASEAN` | `tb_misi_permanen_asean` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | ex. Misi Permanen Republik Singapura |
| `Kantor Dagang Asing` | `tb_kantor_dagang_asing` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Kantor dagang/ekonomi pihak asing di Jakarta yang bukan kedutaan besar. ex. Taipei Economic and Trade Office (TETO). |
| `Pusat Kebudayaan Asing` | `tb_pusat_kebudayaan_asing` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Lembaga kebudayaan negara asing di Jakarta. Modul sudah jadi, **datanya belum ada** (lihat `PusatKebudayaanAsingSeeder`). IFI tetap tercatat di bawah Kedutaan Besar Perancis sesuai sheet acuan. |
| `Non Perwakilan Negara Asing` | `tb_non_perwakilan_negara_asing` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Nama resmi disimpan bebas (bukan negara) di kolom `nama_non_perwakilan_negara_asing`. ex. UNDP, World Economic Forum, PGRI. |
| `Pemerintah Provinsi DKI Jakarta` | `tb_pemprov_dki` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Perangkat daerah Pemprov DKI (biro/dinas/badan) — antar-perangkat daerah dimungkinkan berkerjasama/berkolaborasi. ex. Biro Kepala Daerah. |
| `Perwakilan RI di Luar Negeri` | `tb_perwakilan_ri` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Gabungan eks-modul KBRI, KJRI, PTRI (arahan Kasubag, 25 Sep 2026). Field: `nama_perwakilan_ri` (teks), `tipe_perwakilan_ri` (dropdown `PerwakilanRi::TIPE_OPTIONS`: kode `KBRI`/`KJRI`/`PTRI` yang disimpan → label panjang yang ditampilkan), `keterangan`. Nama **tetap ditulis lengkap** ("KBRI Tokyo", bukan "Tokyo") karena dropdown pemilih mitra, file ekspor, dan Restore Data hanya menampilkan kolom nama. Jangan tertukar dengan modul `Kedutaan Besar`. |
| `Kerjasama` | `tb_kerjasama` | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | 1 baris = 1 mitra, via `id_mitra` generik ke `tb_mitra` (lihat Bagian 3). |
| `Kolaborasi` | `tb_kolaborasi` | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Sama seperti Kerjasama. |
| `Undangan` | `tb_undangan` | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Sama seperti Kerjasama. |
| `Audiensi` | `tb_audiensi` | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Sama seperti Kerjasama. |
| `Kunjungan` | `tb_kunjungan` | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | Sama seperti Kerjasama. |
| `Acara DKI` | `tb_acara_dki` + `tb_acara_dki_mitra` (pivot) | lihat, cari, tambah, ubah, hapus, ekspor Excel/PDF | **Beda pola** — 1 acara bisa punya banyak mitra sekaligus, masing-masing dengan `status_kehadiran` & `keterangan_kehadiran` sendiri. Lihat Bagian 4. |
| `Tanggal Penting` | *(tidak ada tabel sendiri)* | lihat | Kalender read-only, diturunkan dari `tanggal_awal_pelaksanaan`–`tanggal_akhir_pelaksanaan` milik Acara DKI yang `is_active`. |
| `Dashboard` | - | lihat | Kartu akumulasi dua kelompok — **Mitra Biro KSD** (8 kartu, diturunkan dari `TipeMitra` sehingga tipe baru muncul otomatis) dan **Riwayat Diplomasi** (6 kartu + donat perbandingan); tiap kartu menautkan ke index modulnya. Plus peta sebaran kedutaan besar (lat/long), analisis status per modul, dan ranking "Mitra Diplomatik Paling Aktif". |


---

## 3. Arsitektur Data Mitra (Generalisasi-Spesialisasi)

Modul Mitra **bukan** 8 tabel independen — melainkan pola generalisasi-spesialisasi (supertype-subtype):

- **`tb_mitra`** (supertype) — hanya berisi `id_mitra`, `tipe_mitra` (cast ke enum `App\Enums\TipeMitra`), `is_active`, timestamps, soft delete. Baris di tabel ini **tidak pernah diisi manual/di-seed** — dibuat otomatis oleh trait `App\Models\Concerns\BelongsToMitra` setiap kali record subtype baru dibuat.
- **8 tabel subtype** — `tb_kedutaan_besar`, `tb_misi_asing_asean`, `tb_misi_permanen_asean`, `tb_kantor_dagang_asing`, `tb_pusat_kebudayaan_asing`, `tb_perwakilan_ri`, `tb_pemprov_dki`, `tb_non_perwakilan_negara_asing` — masing-masing punya `id_mitra` sebagai foreign key **unique** (relasi 1:1) ke `tb_mitra`, terpisah dari primary key mereka sendiri (`id_kedutaan_besar`, dst).

Kenapa pola ini dipakai: 5 modul Riwayat Diplomasi (Kerjasama–Kunjungan) harus bisa menunjuk ke mitra **apapun jenisnya** lewat satu kolom `id_mitra` yang seragam — tanpa perlu 8 kolom FK terpisah yang saling nullable (`id_kedutaan_besar`, `id_misi_asing_asean`, dst).

### `App\Enums\TipeMitra` adalah sumber tunggal metadata tipe mitra

Setiap case enum membawa metadata lengkap tipenya lewat method: `slug()` (kunci teknis dropdown), `modelClass()`, `relasi()` (nama relasi `hasOne` di `Mitra`), `kolomNama()` (nama kolom nama resmi di tabel subtype), `berbasisNegara()`, `labelSingkat()`, `routeIndex()`, `routeShow()` (diturunkan dari `routeIndex()`, dipakai kartu "Mitra Diplomasi Paling Aktif" di dashboard), `ikon()` & `warna()` (penanda visual dashboard), serta helper statis `relasiMitra()` (daftar relasi untuk eager-load).

Metadata tampilan (`ikon`/`warna`/`labelSingkat`) sengaja ikut ditaruh di enum, bukan di blade — supaya dashboard dan navbar tidak perlu menuliskan daftar tipe mitra lagi.

**Semua kode yang perlu tahu "ada tipe mitra apa saja" WAJIB menurunkannya dari enum ini, jangan menulis daftarnya sendiri.** Yang sudah mengikuti: `Mitra::subtype()`/`nama_resmi_mitra`/`label_mitra`, eager-load di 6 controller Riwayat Diplomasi, `App\Support\DaftarMitra`, komponen `x-mitra-picker` / `x-mitra-icon` / `x-mitra-ringkas`, form Acara DKI, dan trait seeder `ResolvesMitra`. Konsekuensinya menambah jenis mitra ke-9 **tidak perlu menyisir** berkas-berkas itu satu per satu.

### `App\Enums\ModulDiplomasi` — padanan `TipeMitra` untuk 6 modul Riwayat Diplomasi

Kalau `TipeMitra` mendaftar *pihak* yang berdiplomasi, `ModulDiplomasi` mendaftar *peristiwa*-nya: `Kerjasama`, `Kolaborasi`, `Undangan`, `Audiensi`, `Kunjungan`, `AcaraDki`. Metadata per case: `slug()`, `modelClass()`, `kolomJudul()`, `kolomStatus()`, `labelJudul()` (label kolom judul di tabel index & file ekspor), `kolomTriwulan()`, `relasi()` (nama relasi di `HasRiwayatDiplomasi`, padanan `TipeMitra::relasi()`), `routeIndex()`, `routeEdit()`, `ikon()`, `warna()`, `berbasisMitraTunggal()` (false hanya untuk Acara DKI — lihat Bagian 4), plus `dariSlug()`.

⚠️ **Kolom judul tidak senama dengan modulnya** — hanya Kerjasama, Kolaborasi, dan Acara DKI yang begitu; sisanya `tb_undangan.acara`, `tb_audiensi.topik`, `tb_kunjungan.perihal`. Karena itu `kolomJudul()`/`kolomStatus()` **meneruskan** `$judulColumn`/`$statusColumn` milik model (lewat getter publik di `HasDiplomasiProfileAccessors`), bukan menyalin daftarnya. Jangan ubah jadi `match` berisi nama kolom — itu membuat dua daftar yang bisa saling melenceng. Untuk menampilkan judul, pakai accessor `judul_ringkas` yang sudah ada.

Dibuat untuk modul Restore Data, yang harus menyisir **seluruh** modul pemilik `is_active` + `deleted_at`. Aturannya sama seperti `TipeMitra`: **kode yang perlu tahu "ada modul Riwayat Diplomasi apa saja" turunkan dari enum ini**, jangan menulis daftarnya sendiri. Yang sudah mengikuti: `DataTerhapus` (Restore Data), `EksporDiplomasi` + route ekspor, dan komponen `x-mitra-riwayat` (tab riwayat di profil mitra). Satu pengecualian yang masih ada: blok `$akumulasiRiwayat` di `DashboardController` — butuh `warnaChart` yang belum ada di enum, dan sudah diberi komentar penjelas di tempatnya.

### Trait kunci

| Trait | Dipakai oleh | Fungsi |
|---|---|---|
| `BelongsToMitra` | 8 model subtype | Auto-create/soft-delete/restore/force-delete baris `tb_mitra` pasangannya. Setiap model anak **wajib** override `tipeMitra(): string`. Juga menyediakan scope `daftarIndex()` (query index + ekspor) dan `kolomEkspor()` bawaan `Nama | Keterangan` (override bila kolom index subtype-nya berbeda). |
| `ReferencesMitra` | Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan | Relasi `belongsTo` generik ke `tb_mitra.id_mitra` — 5 modul ini menunjuk ke mitra apapun tipenya lewat satu FK yang sama, tanpa perlu tahu subtype-nya. |
| `HasRiwayatDiplomasi` | `Mitra` (supertype) + 8 subtype | Kebalikan dari `ReferencesMitra` — relasi `hasMany` ke 5 modul di atas (**wajib** difilter `is_active`, lihat Bagian 9.3) dan relasi `belongsToMany` khusus `acaraDki()` (lihat Bagian 4). |
| `HasMitraProfileAccessors` | 3 subtype berbasis negara | Accessor UI bersama: `telepon_kantor`/`email_kantor` (string dipisah koma) → array, label & warna badge status aktif. Tidak dipakai subtype "nama + keterangan" karena mereka tidak punya kolom-kolom itu. |
| `ResolvesMitra` (namespace `Database\Seeders\Concerns`) | 6 seeder Riwayat Diplomasi | Menerjemahkan kolom nama mitra pada baris data seeder (`nama_perwakilan_ri`, `nama_pemprov_dki`, dst) menjadi `id_mitra`. Kolom yang dikenali diturunkan dari `TipeMitra::kolomNama()`. |
| `HasDiplomasiFieldOptions` / `HasDiplomasiFilter` / `HasDiplomasiProfileAccessors` | Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara DKI | Konstanta dropdown (`STATUS_OPTIONS`, `TRIWULAN_OPTIONS`), scope filter (`filterStatus`, `filterTahun`, `tahunTersedia`, serta `daftarIndex` — query index yang juga dipakai ekspor Excel/PDF, supaya file yang diunduh dijamin sama dengan tabel), accessor tampilan bersama (`statusBadgeColor`, `judulRingkas`, `tanggalDiterimaDisplay`, dst). |
| `MenonaktifkanData` (namespace `App\Http\Controllers\Concerns`) | `destroy()` di 14 controller (8 Mitra + 6 Riwayat Diplomasi) | Satu-satunya tempat pola "hapus" = nonaktifkan + soft delete diimplementasikan. `nonaktifkan()` untuk Riwayat Diplomasi, `nonaktifkanMitra()` untuk subtype Mitra (ikut menonaktifkan `tb_mitra`). Lihat Bagian 9.3. |

### Aturan wajib saat menambah modul baru yang menunjuk ke Mitra

- **Modul tipe "riwayat diplomasi"** (1 baris = 1 mitra, mengikuti pola Kerjasama–Kunjungan): pakai `ReferencesMitra` + ketiga trait `HasDiplomasi*`, definisikan `$judulColumn`/`$statusColumn`, lalu tambahkan relasi baliknya ke `HasRiwayatDiplomasi`.
- **Subtype Mitra baru** (jenis mitra ke-9 dan seterusnya) — cukup 3 langkah, **tidak perlu** menyentuh controller Riwayat Diplomasi, komponen picker, atau seeder manapun:
  1. Tambah `case` baru di `App\Enums\TipeMitra` beserta keenam method-nya (`slug`, `modelClass`, `relasi`, `kolomNama`, `berbasisNegara`).
  2. Buat migration (`id_[tabel]` + `id_mitra` unique FK + kolom identitas + `is_active` + timestamps + softDeletes) dan model yang memakai `BelongsToMitra` + `HasRiwayatDiplomasi` (+ `HasMitraProfileAccessors` bila berbasis negara), lalu tambahkan relasi `hasOne`-nya di `Mitra` dengan nama **persis** seperti `TipeMitra::relasi()`.
  3. Buat controller + Store/Update request + folder view (`_form`, `create`, `edit`, `index`, `show`, `show-rincian`) + 2 baris route + entri navbar. Halaman `show` memakai `<x-mitra-riwayat>` — **jangan** membuat `show-riwayat.blade.php` sendiri.

---

## 4. Proses Bisnis Khusus: Acara DKI (Banyak Mitra per Acara)

5 modul Riwayat Diplomasi (Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan) proses bisnisnya 100% identik: **satu baris = satu mitra = satu peristiwa**. Kalau dua mitra berbeda terlibat dalam kunjungan yang sama di hari yang sama, dicatat sebagai **dua baris kunjungan terpisah** (lihat contoh dubes Australia vs kepala Misi Australia untuk ASEAN di Bagian 1).

**Acara DKI berbeda.** Satu Acara DKI adalah satu peristiwa (festival budaya, forum ekonomi, forum hubungan internasional, dll.) yang bisa mengundang **banyak mitra sekaligus**, dan setiap mitra punya status kehadirannya sendiri yang independen satu sama lain.

**Contoh ilustrasi proses bisnis** (menjelaskan kenapa satu Acara DKI = banyak mitra dengan status berbeda-beda, bukan sekadar variasi acak):

| Acara | Mitra diundang | Hadir | Tidak Hadir (+alasan) |
|---|---|---|---|
| Festival Budaya Betawi | Singapura, Malaysia, Rusia, AS, Inggris | Singapura, Malaysia, Rusia, Inggris | AS — tidak ada keuntungan finansial bagi negaranya |
| Forum Ekonomi ASEAN | Seluruh Misi Permanen ASEAN + Kedubes AS & Inggris | Semua hadir | — |
| Misi Perdamaian Dunia | Inggris, Prancis, China, Rusia, AS, dll. | Inggris, Prancis, China, Rusia, dll. | AS — menolak hadir karena China & Rusia turut diundang (sensitivitas geopolitik) |

Dari sini terlihat polanya: keputusan hadir/tidak suatu mitra bisa dipengaruhi oleh **konteks acara itu sendiri** (siapa saja mitra lain yang hadir, jenis manfaat yang ditawarkan) — bukan atribut tetap milik mitra tersebut. Itu sebabnya status kehadiran harus melekat pada *pasangan* (acara, mitra), bukan pada acara atau mitra saja.

### Implementasi

Relasi Acara DKI ↔ Mitra memakai tabel pivot **`tb_acara_dki_mitra`** (many-to-many), **bukan** `hasMany`/`belongsTo` seperti 5 modul lainnya:

- `id_acara_dki`, `id_mitra` — kombinasi **unique** (satu mitra tidak boleh dobel di acara yang sama).
- `status_kehadiran` — enum `Diundang` / `Hadir` / `Tidak Hadir`.
- `keterangan_kehadiran` — teks bebas, nullable. **Penting secara bisnis**, bukan sekadar catatan opsional: dari sini bisa ditelusuri pola seperti "mitra mana yang konsisten menolak hadir bila mitra tertentu lain diundang" atau "jenis acara apa yang berhasil menarik kehadiran mitra tertentu".

Model pivot: `App\Models\AcaraDkiMitra extends Pivot`, dipakai lewat `->using(AcaraDkiMitra::class)` di kedua sisi relasi — `AcaraDKI::mitra()` dan `HasRiwayatDiplomasi::acaraDki()`.

Migration `2026_09_23_100001_create_tb_acara_dki_mitra_table.php` sudah menangani migrasi data lama (skema 1-mitra-per-acara → pivot, di-backfill sebagai status `Hadir`) beserta `down()` yang reversibel.

> **Implikasi untuk pengembangan lanjutan:** Jangan menyederhanakan modul Acara DKI kembali ke pola `hasMany`/1-mitra-per-baris meskipun terlihat "lebih konsisten" dengan 5 modul lain — proses bisnisnya memang sengaja berbeda. Sebaliknya, jika ada modul riwayat diplomasi **baru** yang punya sifat serupa (satu peristiwa melibatkan banyak mitra dengan atribut per-mitra), ikuti pola pivot Acara DKI, bukan pola `ReferencesMitra`.

---

## 5. Hak Akses & Modul
| Role | Kunci session | Middleware | Kemampuan |
|---|---|---|---|
| `admin` | `auth_role = admin` | `CekAdmin` (cek `session('auth_role') === 'admin'`) | Akses penuh (CRUD) ke seluruh modul, termasuk Pengaturan Sistem |
| `guest` | `auth_role = guest` | `CekAuth` (wajib `auth_email` tersesi), `CekTamu` (redirect ke dashboard kalau sudah login) | Akses hanya `index` dan `show` pada modul publik |

Route resource di `routes/web.php` konsisten memisah blok `->except(['index','show'])` (khusus admin) dan `->only(['index','show'])` (admin & guest) untuk setiap modul — ikuti pola ini untuk modul baru.

---

## 6. Git & Deployment
- **Repository:** https://github.com/karya-anak-bangsa/laravel-paradiplomasi
- **Domain Testing:** https://www.paradiplomasi-jakarta.id (Hostinger)
- **Domain Production:** belum tersedia

## 7. Sumber Data Acuan
Biro KSD memberikan akses data diplomasi menggunakan google spreadsheet. Adapun beberapa link akses seperti berikut 
- **[Kedutaan besar](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=0#gid=0)**
- **[Misi Asing untuk ASEAN](https://docs.google.com/spreadsheets/d/1nAn8AkgiNSYgMRTfvMZNAjQAZ0yNjTrt/edit?gid=1497379427)**
- **[Misi Permanen Negara ASEAN](https://docs.google.com/spreadsheets/d/1nAn8AkgiNSYgMRTfvMZNAjQAZ0yNjTrt/edit?gid=1288212522)**
- **Kantor Dagang Asing, Pusat Kebudayaan Asing, Perwakilan RI di Luar Negeri, Pemerintah Provinsi DKI Jakarta, Non Perwakilan Negara Asing:** *tidak punya sheet tersendiri* — Biro KSD belum menyediakannya. Daftar mitranya **diturunkan** dari kolom "Mitra" pada sheet Riwayat Diplomasi di bawah, yaitu seluruh nama yang tidak mengikuti pola penamaan "Kedutaan Besar …", "Misi … untuk ASEAN", atau "Misi Permanen … untuk ASEAN", lalu dipilah per jenis mitra:

  | Seeder | Jumlah | Isi |
  |---|---|---|
  | `KantorDagangAsingSeeder` | 1 | Taipei Economic and Trade Office (TETO) — dipindah dari Non-PNA; DB yang sudah berjalan dipindah oleh migration `2026_09_25_100002_pindahkan_teto_ke_tb_kantor_dagang_asing` (id_mitra tetap, riwayat tetap tersambung) |
  | `PusatKebudayaanAsingSeeder` | 0 | Belum ada data — slot kosong |
  | `NonPerwakilanNegaraAsingSeeder` | 21 | Organisasi internasional, instansi pemerintah pusat RI, pemerintah negara/daerah asing, organisasi profesi & badan usaha |
  | `PemprovDkiSeeder` | 2 | Biro Kepala Daerah, Badan Kesatuan Bangsa dan Politik |
  | `PerwakilanRiSeeder` | 3 | KBRI Tokyo, KBRI Bern (`KBRI`), KJRI Mumbai (`KJRI`). Belum ada data PTRI. Gabungan eks-`KbriSeeder`/`KjriSeeder`/`PtriSeeder` |

  Catatan: Kementerian Luar Negeri RI dan Menteri Luar Negeri RI tetap di Non-PNA — instansi pemerintah pusat, bukan perangkat daerah Pemprov DKI maupun perwakilan RI di luar negeri. Jika kelak Biro KSD menerbitkan sheet khusus untuk jenis-jenis mitra ini, sheet tersebut yang menjadi sumber kebenaran dan seeder di atas perlu direkonsiliasi terhadapnya.
- **[Kerjasama](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=349452470)**
- **[Kolaborasi](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=908759696)**
- **[Undangan](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=1980990669)**
- **[Audiensi](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=1015452074)**
- **[Kunjungan](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=306344728)**
- **[Acara DKI](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=697844018)**

---

## 8. Teknologi & Environment
- **Framework & UI:** Laravel ^13.17, Template Tabler UI 1.4.0
- **Environment:** PHP 8.3.28, MySQL 8.0.40, Apache 2.4.62, Composer 2.10.1, Node.js 24.12.0
- **Local Server:** Laragon 8.4.0
- **Testing Server:** Hostinger
- **Production Server:** Server Resmi Pemda DKI Jakarta (Diskominfotik)
- **Build Frontend (Vite):** Tailwind CSS 4 (`@tailwindcss/vite`) — dipakai terbatas, sebagian besar styling masih dari Tabler UI.
- **Library Frontend via CDN (bukan npm/Vite):** Select2 (`4.1.0-rc.0` + tema `select2-bootstrap-5-theme`), DataTables (`2.1.8`), SweetAlert2, Simple-Notify — semuanya dimuat langsung di `resources/views/template/app.blade.php`. **Jangan** install ulang lewat `npm`, supaya tidak ada dua sumber versi yang berbeda.
- **Paket Composer untuk ekspor:** `maatwebsite/excel` ^4.0 (Excel, di atas PhpSpreadsheet 5) dan `barryvdh/laravel-dompdf` ^3.1 (PDF). Server testing/production wajib menjalankan `composer install` setelah deploy, dan butuh ekstensi PHP `zip`, `gd`, `xml`, `mbstring`. Di Hostinger `proc_open` dimatikan sehingga script `package:discover` bawaan Composer gagal — jalankan `composer install --no-dev --optimize-autoloader --no-scripts`, lalu `php artisan package:discover` dan `php artisan optimize:clear` secara manual.
  - Ukuran PDF dijaga kecil (±50–80 KB): font subsetting diaktifkan di trait `App\Http\Controllers\Concerns\MengunduhEkspor`, dan kop memakai `public/img/dki-jakarta-kop.png` (159×180 px), bukan `dki-jakarta.webp` (1200×1355 px) — dompdf menyematkan gambar dalam resolusi aslinya, sehingga logo besar saja menambah ±700 KB per file.
  - Ekspor tersedia di **14 modul**: 6 Riwayat Diplomasi dan 8 Mitra. Alurnya: dropdown `x-tombol-ekspor` (di header kartu tabel index, prop `modul` berisi case `ModulDiplomasi` **atau** `TipeMitra` — keduanya punya `urlEkspor()`) → route
    - `ekspor.excel` / `ekspor.pdf` (`/ekspor/{slug ModulDiplomasi}/{excel|pdf}`) → `EksporDiplomasiController` → `App\Support\EksporDiplomasi`, atau
    - `ekspor.mitra.excel` / `ekspor.mitra.pdf` (`/ekspor/mitra/{slug TipeMitra}/{excel|pdf}`) → `EksporMitraController` → `App\Support\EksporMitra`,

    lalu keduanya → trait `MengunduhEkspor` → `App\Exports\DaftarExport` / view `ekspor.daftar-pdf`. `EksporDiplomasi` & `EksporMitra` sama-sama turunan `App\Support\DaftarEkspor` (header, header bertingkat, penomoran baris, nama file), jadi file Excel/PDF-nya tidak punya salinan per jenis.
  - Kolom ekspor sengaja **sama dengan tabel index** (arahan user), bedanya judul/keterangan ditulis utuh dan Acara DKI mencantumkan nama mitra + status kehadiran. Kalau kolom index berubah, ubah juga `EksporDiplomasi::kolom()` (Riwayat Diplomasi) atau `kolomEkspor()` model subtype-nya (Mitra — bawaannya `Nama | Keterangan` di `BelongsToMitra`, di-override oleh Kedutaan Besar, Misi Asing, Misi Permanen, dan Perwakilan RI). Data mitra memakai scope `daftarIndex()` di `BelongsToMitra`, sama dengan `index()` controller-nya. Nilai dua baris (nama ID + EN, nama + jabatan diplomat) ditulis sebagai satu teks berpemisah baris (`"\n"`): Excel menampilkannya lewat *wrap text*, PDF lewat `nl2br`.
  - Daftar Undangan Acara DKI (arahan user, 25 Sep 2026): **PDF hanya "Nama Mitra (Status)"**, sedangkan **Excel juga mencantumkan alasan kehadirannya** ("Nama (Hadir – alasan)") karena alasan penting untuk analisis pola kehadiran (Bagian 4). Keduanya lewat `EksporDiplomasi::teksUndangan($undangan, denganAlasan: …)`.
  - Semua teks di Excel ditulis sebagai teks (`DaftarExport::bindValue()`), bukan lewat binder bawaan PhpSpreadsheet yang menganggap teks berawalan `=` sebagai rumus — mencegah *formula injection* dari judul/nama yang diketik pengguna. Jangan hapus binder ini.
  - Batasan dompdf yang sudah ditemui: `counter(pages)` di CSS selalu "0" (nomor halaman dicetak lewat canvas di `MengunduhEkspor::nomorHalaman()`), dan satu baris tabel tidak bisa dipecah ke dua halaman (baris yang lebih tinggi dari kertas terpotong). Karena itu Daftar Undangan Acara DKI di PDF ditulis **satu mitra per `<tr>`** bernomor `1).`, `2).`, dst. — kolom lain hanya diisi di `<tr>` pertama dan garis antar-`<tr>` dihapus (kelas `sambung-atas`/`sambung-bawah`) supaya tampak satu sel. **Jangan** diganti `rowspan` (lebar kolom menyusut di halaman lanjutan) maupun `<br>` dalam satu sel (terpotong).
  - Header PDF dua tingkat (`DaftarEkspor::headerBertingkat()`): kolom tanggal dikelompokkan di bawah "Tanggal" (colspan 2 → Diterima | Selesai), kolom lain rowspan 2. Tabel tanpa kolom tanggal (daftar Mitra) otomatis satu tingkat. Excel tetap memakai `header()` satu tingkat.

---

## 9. Arsitektur & Konvensi Penulisan Source Code

### 9.1 Struktur Arsitektur
- **Pola Desain:** Standard MVC Laravel 13.
- **Kualitas Kode:** Mengikuti kaidah ISO 9126 (*Scalable* & *Maintainable*).

### 9.2 Aturan Penamaan
- **Database Non-Konvensional:**
  - Nama tabel menggunakan awalan `tb_` (contoh: `tb_mitra`, `tb_kedutaan_besar`, `tb_kerjasama`, `tb_acara_dki_mitra`).
  - Primary Key menggunakan format `id_[nama_tabel]` (contoh: `id_mitra`, `id_kedutaan_besar`, `id_acara_dki_mitra`).
  - **Catatan untuk Model:** Setiap Model WAJIB mendefinisikan `$table` dan `$primaryKey` secara eksplisit.
- **Model:** Singular PascalCase (contoh: `KedutaanBesar`, `MisiAsingAsean`, `Kerjasama`, `AcaraDkiMitra`).
- **Controller:** Singular PascalCase + `Controller` (contoh: `KedutaanBesarController`).
- **View (Blade):** Setiap modul dalam folder terpisah dengan struktur standar: `index.blade.php`, `show.blade.php`, `create.blade.php`, `edit.blade.php`, dan `_form.blade.php`.
- **Variabel & Method:** camelCase (contoh: `$daftarKedutaan`, `getDaftarKedutaan()`).

### 9.3 Pola "Hapus" = Nonaktifkan + Soft Delete, Bukan Hapus Permanen
Tombol "hapus" di **seluruh** modul (Mitra & Riwayat Diplomasi) **tidak pernah** menghapus data. Method `destroy()` memanggil trait `App\Http\Controllers\Concerns\MenonaktifkanData` (`nonaktifkan()` untuk Riwayat Diplomasi, `nonaktifkanMitra()` untuk subtype Mitra), yang melakukan **dua** hal:

1. `is_active = false` — status bisnisnya: data hilang dari index modul, dropdown mitra, kartu dashboard, dan tab Riwayat Diplomasi.
2. `deleted_at` terisi (soft delete Eloquent) — **catatan kapan** data dihapus, sekaligus penanda bahwa baris itu layak muncul di **Pengaturan Sistem > Restore Data**.

Keduanya tetap terpisah karena perannya beda: `is_active` menentukan data tampil atau tidak, `deleted_at` mencatat jejak penghapusan. Jangan panggil `update(['is_active' => false])` langsung di controller baru — pakai trait di atas, supaya `deleted_at` tidak terlewat dan datanya tidak "hilang" dari modul Restore Data.

Konsekuensi lain:
- Setiap relasi baru dari sisi Mitra ke modul Riwayat Diplomasi **wajib** ditambahkan `->where('is_active', true)` (lihat `HasRiwayatDiplomasi`).
- Sebaliknya, setiap relasi dari **data historis ke Mitra** wajib `->withTrashed()` — sudah dipasang di `ReferencesMitra::mitra()`, `AcaraDKI::mitra()`, kedelapan `hasOne` di `Mitra`, dan `BelongsToMitra::mitra()`. Alasannya: kerjasama yang masih aktif tetap harus menampilkan nama mitranya walau mitra itu sudah dihapus. Kalau lupa, `$item->mitra->nama_resmi_mitra` jadi null dan halaman index/rincian modul Riwayat Diplomasi error begitu ada mitra yang dihapus.
- `tb_mitra` (supertype) ikut dinonaktifkan/dipulihkan otomatis mengikuti subtype-nya lewat `BelongsToMitra` (hook `deleted`/`restored`).
- Pemulihannya — kebalikan dari trait di atas — ada di `App\Support\DataTerhapus::pulihkan()`: `is_active` dikembalikan true dan `deleted_at` dikosongkan dalam satu operasi simpan. Catatan teknis: `restore()` memakai `save()` sehingga atribut lain ikut tersimpan, sedangkan `delete()` pada model bersoft-delete **hanya** menulis `deleted_at` + `updated_at` — itu sebabnya penonaktifan butuh dua query, pemulihan cukup satu.
- **Force delete tidak dipanggil dari mana pun.** Tidak ada jalur di aplikasi yang bisa menghilangkan data dari database secara permanen.

**Batasan yang masih ada:** halaman Restore Data bisa menjawab *kapan* data dihapus, tapi belum bisa menjawab *siapa* yang menghapusnya — tabel tidak punya kolom pengguna dan login masih hardcode di `AuthController`. Jejak pelaku baru mungkin setelah ada tabel akun pengguna sungguhan + modul Riwayat Aktivitas.

### 9.4 Konvensi Form & Validasi
- Setiap field wajib diisi **wajib** diberi tanda bintang merah (`<span class="text-danger">*</span>`) pada label-nya — berlaku di semua modul Kerjasama–Acara DKI, ditegakkan lewat prop `:required="true"` pada komponen `x-form-input-*`.
- **`Store…Request` dan `Update…Request` satu modul harus IDENTIK** (kecuali nama kelasnya). Alasannya: `create` dan `edit` memakai `_form.blade.php` yang sama, jadi bintang merah yang muncul di halaman Ubah adalah janji yang ditagihkan ke `Update…Request`. Kalau `update` dilonggarkan jadi `nullable`, admin bisa mengosongkan field yang label-nya bertanda wajib — dan untuk `tanggal_diterima` itu berarti barisnya lenyap dari filter tahun serta melayang di urutan index. Cek dengan `diff` saat menambah/mengubah aturan validasi.
- **Kolom baru di migration wajib ikut ditambahkan ke `$fillable`, rule request, dan `_form.blade.php` sekaligus.** Seeder BUKAN alat verifikasi untuk ini: `php artisan db:seed` berjalan di dalam `Model::unguarded()`, sehingga kolom yang tidak ada di `$fillable` tetap terisi lewat seeder tapi diam-diam gagal lewat form. Kalau datanya ada di DB namun tidak bisa diubah dari halaman Ubah, inilah penyebabnya.
- Dropdown dengan opsi banyak (mis. pemilihan mitra) **wajib** pakai Select2 (`.select2`, tema `bootstrap-5`), bukan `<select>` polos.
- Dropdown Select2 di dalam elemen yang overflow-scroll (mis. tabel responsive) **wajib** di-set `dropdownParent: $(document.body)` supaya tidak terpotong.

### 9.5 Komponen Blade yang Sudah Tersedia — Pakai Ulang, Jangan Duplikasi
Sudah ada di `resources/views/components/`: `form-input-text`, `form-input-textarea`, `form-input-select`, `form-input-email`, `form-input-password`, `form-input-file`, `page-header`, `page-body-form`, `page-body-show`, `page-body-table`, `page-body-filter`, `tombol-ekspor`, `show-field`, `stat-card`, `waktu-akses`, `mitra-icon`, `mitra-picker`, `mitra-ringkas`, `mitra-riwayat`.

**`x-waktu-akses`** — teks "Diakses pada 25 Sep 2026, 02:26 WIB" dalam WIB (lihat Bagian 9.6). Prop: `label` (default `"Diakses pada"`; PDF ekspor memakai `"Diunduh pada"`). Hanya mengeluarkan teks — pembungkusnya (mis. `<small class="text-danger">`) tetap ditulis pemanggil.

**`x-stat-card`** — kartu angka dashboard (avatar berikon + jumlah + label). Props: `jumlah`, `label`, `ikon`, `warna`, `route` (opsional; kalau diisi, seluruh kartu jadi area klik lewat `stretched-link`). Kelas grid-nya dioper lewat atribut biasa, mis. `class="col-lg-3 col-sm-6"`.

**`x-page-body-filter`** — kartu filter Status & Tahun di index 6 modul Riwayat Diplomasi. Props: `statusOptions`, `tahunOptions`. Hanya berisi filter — tombol ekspor sengaja **tidak** ditaruh di sini.

**`x-page-body-table`** — kartu tabel `.datatable`. Selain slot `thead`/`tbody`, punya slot opsional `actions` yang dirender di kanan header kartu (`card-actions`).

**`x-tombol-ekspor`** — satu tombol netral "Ekspor" berisi dropdown Excel/PDF yang membawa filter aktif. Prop: `modul` (case `App\Enums\ModulDiplomasi` atau `App\Enums\TipeMitra`; untuk mitra judul dropdown-nya "Seluruh mitra aktif" karena index mitra tidak punya filter). Dipasang di slot `actions` milik `x-page-body-table`. Tampil untuk admin maupun guest.

**Aturan tata letak tombol (arahan user, 25 Sep 2026):** satu halaman hanya punya **satu tombol solid berwarna**, yaitu aksi utamanya ("Tambah Data" di `x-page-header`). Aksi lain dibuat netral dan diletakkan dekat objek yang dikenai aksinya — ekspor di header tabel, Logout di dalam menu pengguna (avatar) pada `template/header.blade.php`. Sebelumnya Logout, Tambah Data, Excel, dan PDF semuanya tombol solid yang bertumpuk di kolom kanan, sehingga terkesan bergerombol.

Khusus tiga komponen mitra terakhir:
- **`x-mitra-riwayat`** — seluruh tab Riwayat Diplomasi (6 tab + modal rinciannya) pada halaman profil mitra. Dipakai oleh **semua** modul mitra. Sebelumnya tiap modul punya salinan `show-riwayat.blade.php` sendiri sepanjang ±800 baris; keempat salinan itu sudah dihapus. Props: `:mitra` (model subtype dengan keenam relasi ter-load) dan `sebutan` (kata benda untuk pesan kosong, mis. `"kedutaan ini"`). Daftar 5 tab pertama beserta nama relasi/kolomnya diturunkan dari `ModulDiplomasi`; tombol Ubah hanya tampil untuk admin.
- **Kolom tanggal di tabel `.datatable` wajib diberi `data-order` berformat ISO** (`Y-m-d` atau `Y-m-d H:i:s`). DataTables tidak bisa membaca "02 Jul 2026" / "23 Sep 2026, 09:51 WIB" sebagai tanggal dan akan mengurutkannya sebagai teks (angka hari duluan). Kolom Aksi diberi `data-orderable="false"`.
- **`x-mitra-ringkas`** — blok identitas mitra di dalam modal rincian. Props: `:mitra` (model `Mitra` supertype).
- **`x-mitra-picker`** — pemilih mitra dua tingkat (tipe → nama). Prop: `:daftar-mitra` dari `App\Support\DaftarMitra::aktifPerTipe()`.

Sebelum menulis blade baru, cek dulu apakah komponen di atas sudah mengakomodasi kebutuhannya. Jika kode view blade berulang di beberapa modul dan belum ada komponennya, buat x-component baru — jangan copy-paste antar modul. Prinsip yang sama berlaku di level model: kalau logic/konstanta dipakai ≥2 modul Riwayat Diplomasi, taruh di trait `Concerns` (lihat Bagian 3), bukan diduplikasi per model.

### 9.6 Aturan Umum
- Controller dan model harus tipis, tidak boleh ada logic berat (pindahkan ke trait/service jika perlu dipakai ulang).
- **Zona waktu: simpan UTC, tampilkan WIB.** `config('app.timezone')` sengaja tetap `UTC` supaya `created_at`/`updated_at`/`deleted_at` lama dan baru konsisten; jam yang ditampilkan ke pengguna dikonversi ke `config('app.timezone_tampilan')` (`Asia/Jakarta`). Jangan tulis `now()->format(...)` atau `$model->created_at->format(...)` polos di view — pakai `App\Support\Waktu::sekarang()` / `Waktu::tampil($timestamp)` atau komponen `<x-waktu-akses />`. Sebelum aturan ini ada, semua label "WIB" di aplikasi sebenarnya jam UTC (terlambat 7 jam). Kolom `date` murni (`tanggal_diterima`, dst.) tidak terpengaruh.

---

## 10. Aturan untuk Claude Agent
- **Strict Pint Formatting**: Jalankan atau pastikan kode mematuhi standar PSR-12 dan Laravel Pint sebelum mengusulkan perubahan.
- **Localization**: Pesan validasi, notifikasi status, dan label antarmuka menggunakan bahasa Indonesia (`resources/lang/id` atau `lang/id`).
- **Jangan sederhanakan pola arsitektur tanpa memahami alasan bisnisnya** — khususnya pola supertype-subtype Mitra (Bagian 3) dan pola pivot Acara DKI (Bagian 4). Keduanya sengaja berbeda dari pola default, bukan inkonsistensi yang perlu "diperbaiki".
- **Jangan menulis daftar tipe mitra secara hardcode di mana pun** — turunkan dari `App\Enums\TipeMitra` (Bagian 3). Rantai `if/elseif`, `match`, atau daftar `<option>` yang menyebut tipe mitra satu per satu adalah tanda pola ini dilanggar. Aturan yang sama berlaku untuk daftar modul Riwayat Diplomasi lewat `App\Enums\ModulDiplomasi`.
- **`destroy()` wajib lewat trait `MenonaktifkanData`**, jangan `update(['is_active' => false])` langsung (Bagian 9.3) — kalau `deleted_at` tidak terisi, datanya tidak akan muncul di Pengaturan Sistem > Restore Data dan praktis tidak bisa dipulihkan admin.
- **Pengecualian yang disengaja:** ranking "Mitra Diplomatik Paling Aktif" di dashboard **hanya** mencakup Kedutaan Besar, Misi Asing ASEAN, dan Misi Permanen ASEAN. Kantor Dagang Asing, Pusat Kebudayaan Asing, Perwakilan RI, Pemprov DKI, dan Mitra Non-PNA sengaja tidak diperingkat — ranking ini mengukur keaktifan mitra diplomatik asing, bukan seluruh pihak yang pernah berinteraksi dengan Biro KSD. Jangan "melengkapi" daftar ini memakai `TipeMitra::cases()`.
- **Filter `is_active` wajib** setiap kali menambah relasi baru dari Mitra/subtype ke modul Riwayat Diplomasi manapun (lihat Bagian 9.3) — kalau lupa, data yang sudah "dihapus" akan tetap muncul di tab Riwayat Diplomasi pada halaman profil mitra.
- **Cek komponen Blade & trait Concerns yang sudah ada** (Bagian 9.5) sebelum menulis kode baru yang berpotensi duplikat.
