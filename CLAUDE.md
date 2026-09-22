# Proyek Web Paradiplomasi Pemda DKI

_Terakhir diperbarui: 23 September 2026 — menyesuaikan dengan implementasi terkini di branch `main`._

## 1. Deskripsi Singkat
<p align="justify">
Website Paradiplomasi Jakarta adalah sistem informasi untuk pencatatan data diplomasi dan hubungan luar negeri Pemda DKI Jakarta yang diwakili oleh Biro Kerjasama Daerah (KSD) setda DKI Jakarta dengan beberapa mitra seperti kedutaan besar, misi asing untuk asean, misi permanen negara asean, dan non perwakilan negara asing. Saat ini, web paradiplomasi jakarta dalam tahap domain testing artinya hasil development akan dijalankan pada domain hostinger. Jika seluruh proses bisnis di web paradiplomasi telah selesai dikerjakan maka akan dilakukan deployment ke server resmi pemda dki yaitu server diskominfotik pemda dki.
</p>
<p align="justify">
Setiap mitra baik kedutaan besar, misi asing asean, misi permanen negara asean, dan Non Perwakilan Negara Asing dapat melakukan diplomasi berupa Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara DKI dan tercatat di web paradiplomasi jakarta. Sebagai contoh, kedutaan besar australia dan misi australia untuk asean melakukan pergantian pimpinan. Lalu kedua pimpinan tersebut ingin berkunjung ke balai kota dki untuk bertemu dengan gubernur dki. Hal ini dilakukan untuk protokoler antara pemda dki dengan mitra biro ksd. Oleh karena itu, pada modul kunjungan akan tercatat dua data kunjungan. Pertama kunjungan duta besar australia dan kedua kunjungan kepala misi australia untuk asean. Walaupun pelaksanaan kunjungan dilakukan pada hari yang sama, namun proses pencatatannya dilakukan dua kali. Contoh lainnya, negara singapura yang diwakili oleh misi permanen republik singapura untuk asean ingin melakukan kerjasama dengan beberapa perguran tinggi di Indonesia. Adapun bentuk kerjasamanya adalah program pertukaran mahasiswa antara nanyang technological university dengan mahasiswa dari universitas indonesia, universitas gajah mada, institut teknologi bandung. Oleh karena itu, pada modul kerjasama akan tercatat satu kerjasama. Secara singkat, setiap riwayat diplomasi (modul kerjasama - acara dki) dapat mencatat data diplomasi dari berbagai jenis mitra biro ksd.
</p>
<p align="justify">
<strong>Pengecualian penting:</strong> modul Acara DKI memiliki proses bisnis yang berbeda dari kelima modul Riwayat Diplomasi lainnya. Satu Acara DKI dapat melibatkan <em>banyak mitra sekaligus</em> dalam satu peristiwa yang sama, masing-masing dengan status kehadirannya sendiri (Diundang/Hadir/Tidak Hadir) beserta alasannya. Lihat Bagian 4 untuk penjelasan lengkap beserta contoh kasus.
</p>

---

## 2. Pembagian Modul
- **Modul Mitra:** Kedutaan Besar, Misi Asing untuk ASEAN, Misi Permanen Negara ASEAN, Non Perwakilan Negara Asing (label navbar: "Mitra Non-PNA"). Keempatnya adalah *subtype* dari satu supertype `tb_mitra` — lihat Bagian 3.
- **Modul Riwayat Diplomasi:** Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan (proses bisnis identik, 1 baris = 1 mitra), dan Acara DKI (proses bisnis berbeda, 1 acara = banyak mitra — lihat Bagian 4).
- **Modul Administrator:** Akun Pengguna, Riwayat Aktivitas.
- **Modul Pendukung:** Tanggal Penting (kalender read-only, tidak punya tabel sendiri).

| Nama Modul | Nama Tabel | Aksi | Keterangan |
|---|---|---|---|
| `Akun Pengguna` | `Hardcode dari AuthController` | login dan logout | View index (`mod_akun_pengguna.index`) sudah ada, tapi backend CRUD/listing pengguna belum diimplementasikan. |
| `Riwayat Aktivitas` | `belum dibuat` | - | View index sudah ada namun eksplisit berlabel **"Log Aktivitas Pengguna (Placeholder)"** — belum ada pencatatan log sungguhan. |
| `Kedutaan Besar` | `tb_kedutaan_besar` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus | ex. Kedutaan Besar Australia. "Hapus" = nonaktifkan (`is_active = false`), bukan hapus permanen. |
| `Misi Asing ASEAN` | `tb_misi_asing_asean` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus | ex. Misi Australia untuk ASEAN |
| `Misi Permanen ASEAN` | `tb_misi_permanen_asean` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus | ex. Misi Permanen Republik Singapura |
| `Non Perwakilan Negara Asing` | `tb_non_perwakilan_negara_asing` + `tb_mitra` (supertype) | lihat, cari, tambah, ubah, hapus | Sudah terimplementasi penuh. Nama resmi disimpan bebas (bukan negara) di kolom `nama_non_perwakilan_negara_asing`. |
| `Kerjasama` | `tb_kerjasama` | lihat, cari, tambah, ubah, hapus | 1 baris = 1 mitra, via `id_mitra` generik ke `tb_mitra` (lihat Bagian 3). |
| `Kolaborasi` | `tb_kolaborasi` | lihat, cari, tambah, ubah, hapus | Sama seperti Kerjasama. |
| `Undangan` | `tb_undangan` | lihat, cari, tambah, ubah, hapus | Sama seperti Kerjasama. |
| `Audiensi` | `tb_audiensi` | lihat, cari, tambah, ubah, hapus | Sama seperti Kerjasama. |
| `Kunjungan` | `tb_kunjungan` | lihat, cari, tambah, ubah, hapus | Sama seperti Kerjasama. |
| `Acara DKI` | `tb_acara_dki` + `tb_acara_dki_mitra` (pivot) | lihat, cari, tambah, ubah, hapus | **Beda pola** — 1 acara bisa punya banyak mitra sekaligus, masing-masing dengan `status_kehadiran` & `keterangan_kehadiran` sendiri. Lihat Bagian 4. |
| `Tanggal Penting` | *(tidak ada tabel sendiri)* | lihat | Kalender read-only, diturunkan dari `tanggal_awal_pelaksanaan`–`tanggal_akhir_pelaksanaan` milik Acara DKI yang `is_active`. |
| `Dashboard` | - | lihat | Rangkuman akumulasi seluruh modul, peta sebaran kedutaan besar (lat/long), analisis status per modul, dan ranking "Mitra Diplomatik Paling Aktif" (Kedutaan Besar + Misi Asing ASEAN + Misi Permanen ASEAN, dihitung dari total baris di 6 modul Riwayat Diplomasi). |


---

## 3. Arsitektur Data Mitra (Generalisasi-Spesialisasi)

Modul Mitra **bukan** 4 tabel independen — melainkan pola generalisasi-spesialisasi (supertype-subtype):

- **`tb_mitra`** (supertype) — hanya berisi `id_mitra`, `tipe_mitra` (cast ke enum `App\Enums\TipeMitra`), `is_active`, timestamps, soft delete. Baris di tabel ini **tidak pernah diisi manual/di-seed** — dibuat otomatis oleh trait `App\Models\Concerns\BelongsToMitra` setiap kali record subtype baru dibuat.
- **4 tabel subtype** — `tb_kedutaan_besar`, `tb_misi_asing_asean`, `tb_misi_permanen_asean`, `tb_non_perwakilan_negara_asing` — masing-masing punya `id_mitra` sebagai foreign key **unique** (relasi 1:1) ke `tb_mitra`, terpisah dari primary key mereka sendiri (`id_kedutaan_besar`, dst).

Kenapa pola ini dipakai: 5 modul Riwayat Diplomasi (Kerjasama–Kunjungan) harus bisa menunjuk ke mitra **apapun jenisnya** lewat satu kolom `id_mitra` yang seragam — tanpa perlu 4 kolom FK terpisah yang saling nullable (`id_kedutaan_besar`, `id_misi_asing_asean`, dst).

### Trait kunci

| Trait | Dipakai oleh | Fungsi |
|---|---|---|
| `BelongsToMitra` | 4 model subtype | Auto-create/soft-delete/restore/force-delete baris `tb_mitra` pasangannya. Setiap model anak **wajib** override `tipeMitra(): string`. |
| `ReferencesMitra` | Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan | Relasi `belongsTo` generik ke `tb_mitra.id_mitra` — 5 modul ini menunjuk ke mitra apapun tipenya lewat satu FK yang sama, tanpa perlu tahu subtype-nya. |
| `HasRiwayatDiplomasi` | `Mitra` (supertype) + 4 subtype | Kebalikan dari `ReferencesMitra` — relasi `hasMany` ke 5 modul di atas (**wajib** difilter `is_active`, lihat Bagian 9.3) dan relasi `belongsToMany` khusus `acaraDki()` (lihat Bagian 4). |
| `HasMitraProfileAccessors` | 4 subtype | Accessor UI bersama: `telepon_kantor`/`email_kantor` (string dipisah koma) → array, label & warna badge status aktif. |
| `HasDiplomasiFieldOptions` / `HasDiplomasiFilter` / `HasDiplomasiProfileAccessors` | Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara DKI | Konstanta dropdown (`STATUS_OPTIONS`, `TRIWULAN_OPTIONS`), scope filter (`filterStatus`, `filterTahun`, `tahunTersedia`), accessor tampilan bersama (`statusBadgeColor`, `judulRingkas`, `tanggalDiterimaDisplay`, dst). |

### Aturan wajib saat menambah modul baru yang menunjuk ke Mitra

- **Modul tipe "riwayat diplomasi"** (1 baris = 1 mitra, mengikuti pola Kerjasama–Kunjungan): pakai `ReferencesMitra` + ketiga trait `HasDiplomasi*`, definisikan `$judulColumn`/`$statusColumn`, lalu tambahkan relasi baliknya ke `HasRiwayatDiplomasi`.
- **Subtype Mitra baru** (jenis mitra selain 4 yang sudah ada): pakai `BelongsToMitra` + `HasMitraProfileAccessors` + `HasRiwayatDiplomasi`, tambahkan case baru di `App\Enums\TipeMitra`.

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
- **Non Perwakilan Negara Asing:** *tidak punya sheet tersendiri* — Biro KSD belum menyediakannya. Daftar mitranya **diturunkan** dari kolom "Mitra" pada kelima sheet Riwayat Diplomasi di bawah, yaitu seluruh nama yang tidak mengikuti pola penamaan "Kedutaan Besar …", "Misi … untuk ASEAN", atau "Misi Permanen … untuk ASEAN". Hasil turunan tersebut menjadi satu-satunya sumber data mitra Non-PNA saat ini dan tercatat di `NonPerwakilanNegaraAsingSeeder` (27 mitra, lengkap dengan catatan koreksi terhadap sheet acuan). Jika kelak Biro KSD menerbitkan sheet khusus Non-PNA, sheet tersebut yang menjadi sumber kebenaran dan seeder ini perlu direkonsiliasi terhadapnya.
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

### 9.3 Pola "Hapus" = Nonaktifkan, Bukan Hapus Permanen
Tombol "hapus" di **seluruh** modul (Mitra & Riwayat Diplomasi) **tidak** melakukan delete data. Method `destroy()` hanya melakukan `update(['is_active' => false])`. Konsekuensinya:
- Baris tetap ada di database dan tetap muncul di relasi manapun yang **tidak** memfilter `is_active` — karena itu setiap relasi baru dari sisi Mitra ke modul Riwayat Diplomasi **wajib** ditambahkan `->where('is_active', true)` (lihat `HasRiwayatDiplomasi`).
- Soft delete Eloquent (`deleted_at`) tetap dipasang di semua tabel sebagai lapisan kedua, tapi bukan mekanisme yang dipicu tombol "hapus" — baru relevan untuk operasi force-delete/cleanup data di masa depan.
- `tb_mitra` (supertype) ikut dinonaktifkan/di-restore otomatis mengikuti subtype-nya lewat `BelongsToMitra`.

### 9.4 Konvensi Form & Validasi
- Setiap field wajib diisi **wajib** diberi tanda bintang merah (`<span class="text-danger">*</span>`) pada label-nya — berlaku di semua modul Kerjasama–Acara DKI, ditegakkan lewat prop `:required="true"` pada komponen `x-form-input-*`.
- Dropdown dengan opsi banyak (mis. pemilihan mitra) **wajib** pakai Select2 (`.select2`, tema `bootstrap-5`), bukan `<select>` polos.
- Dropdown Select2 di dalam elemen yang overflow-scroll (mis. tabel responsive) **wajib** di-set `dropdownParent: $(document.body)` supaya tidak terpotong.

### 9.5 Komponen Blade yang Sudah Tersedia — Pakai Ulang, Jangan Duplikasi
Sudah ada di `resources/views/components/`: `form-input-text`, `form-input-textarea`, `form-input-select`, `form-input-email`, `form-input-password`, `form-input-file`, `page-header`, `page-body-form`, `page-body-show`, `page-body-table`, `page-body-filter`, `show-field`, `mitra-icon`, `mitra-picker`.

Sebelum menulis blade baru, cek dulu apakah komponen di atas sudah mengakomodasi kebutuhannya. Jika kode view blade berulang di beberapa modul dan belum ada komponennya, buat x-component baru — jangan copy-paste antar modul. Prinsip yang sama berlaku di level model: kalau logic/konstanta dipakai ≥2 modul Riwayat Diplomasi, taruh di trait `Concerns` (lihat Bagian 3), bukan diduplikasi per model.

### 9.6 Aturan Umum
- Controller dan model harus tipis, tidak boleh ada logic berat (pindahkan ke trait/service jika perlu dipakai ulang).

---

## 10. Aturan untuk Claude Agent
- **Strict Pint Formatting**: Jalankan atau pastikan kode mematuhi standar PSR-12 dan Laravel Pint sebelum mengusulkan perubahan.
- **Localization**: Pesan validasi, notifikasi status, dan label antarmuka menggunakan bahasa Indonesia (`resources/lang/id` atau `lang/id`).
- **Jangan sederhanakan pola arsitektur tanpa memahami alasan bisnisnya** — khususnya pola supertype-subtype Mitra (Bagian 3) dan pola pivot Acara DKI (Bagian 4). Keduanya sengaja berbeda dari pola default, bukan inkonsistensi yang perlu "diperbaiki".
- **Filter `is_active` wajib** setiap kali menambah relasi baru dari Mitra/subtype ke modul Riwayat Diplomasi manapun (lihat Bagian 9.3) — kalau lupa, data yang sudah "dihapus" akan tetap muncul di tab Riwayat Diplomasi pada halaman profil mitra.
- **Cek komponen Blade & trait Concerns yang sudah ada** (Bagian 9.5) sebelum menulis kode baru yang berpotensi duplikat.
