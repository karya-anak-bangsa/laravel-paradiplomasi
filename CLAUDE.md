# Proyek Web Paradiplomasi Pemda DKI

## 1. Deskripsi Singkat
<p align="justify">
Website Paradiplomasi Jakarta adalah sistem informasi untuk pencatatan data diplomasi dan hubungan luar negeri Pemda DKI Jakarta yang diwakili oleh Biro Kerjasama Daerah (KSD) setda DKI Jakarta dengan beberapa mitra seperti kedutaan besar, misi asing untuk asean, misi permanen negara asean, dan non perwakilan negara asing. Saat ini, web paradiplomasi jakarta dalam tahap domain testing artinya hasil development akan dijalankan pada domain hostinger. Jika seluruh proses bisnis di web paradiplomasi telah selesai dikerjakan maka akan dilakukan deployment ke server resmi pemda dki yaitu server diskominfotik pemda dki.
</p>
<p align="justify">
Setiap mitra baik kedutaan besar, misi asing asean, misi permanen negara asean, dan Non Perwakilan Negara Asing dapat melakukan diplomasi berupa Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara DKI dan tercatat di web paradiplomasi jakarta. Sebagai contoh, kedutaan besar australia dan misi australia untuk asean melakukan pergantian pimpinan. Lalu kedua pimpinan tersebut ingin berkunjung ke balai kota dki untuk bertemu dengan gubernur dki. Hal ini dilakukan untuk protokoler antara pemda dki dengan mitra biro ksd. Oleh karena itu, pada modul kunjungan akan tercatat dua data kunjungan. Pertama kunjungan duta besar australia dan kedua kunjungan kepala misi australia untuk asean. Walaupun pelaksanaan kunjungan dilakukan pada hari yang sama, namun proses pencatatannya dilakukan dua kali. Contoh lainnya, negara singapura yang diwakili oleh misi permanen republik singapura untuk asean ingin melakukan kerjasama dengan beberapa perguran tinggi di Indonesia. Adapun bentuk kerjasamanya adalah program pertukaran mahasiswa antara nanyang technological university dengan mahasiswa dari universitas indonesia, universitas gajah mada, institut teknologi bandung. Oleh karena itu, pada modul kerjasama akan tercatat satu kerjasama. Secara singkat, setiap riwayat diplomasi (modul kerjasama - acara dki) dapat mencatat data diplomasi dari berbagai jenis mitra biro ksd.
</p>

---

## 2. Pembagian Modul
- **Modul Mitra:** Kedutaan Besar, Misi Asing untuk ASEAN, Misi Permanen Negara ASEAN, Non Perwakilan Negara Asing.
- **Modul Riwayat Diplomasi:** Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara DKI.
- **Modul Administrator:** Akun pengguna, Riwayat Aktivitas.
|---|---|---|
| Nama Modul | Nama Tabel | Aksi | Keterangan |
|---|---|---|
| `Akun Pengguna` | `Hardcode dari AuthController` | login dan logout | Administrator dapat melihat daftar tamu-tamu yang memiliki akses ke sistem. |
| `Riwayat Aktivitas` | `belum dibuat` | - | - |
| `Kedutaan Besar` | `tb_kedutaan_besar` | lihat, cari, tambah, ubah, hapus | ex. Kedutaan Besar Australia |
| `Misi Asing ASEAN` | `tb_misi_asing_asean` | lihat, cari, tambah, ubah, hapus | ex. Misi Australia untuk ASEAN |
| `Misi Permanen ASEAN` | `tb_misi_permanen_asean` | lihat, cari, tambah, ubah, hapus | ex. Misi Permanen Republik Singapura |
| `Non Perwakilan Negara Asing` | `belum dibuat` | - | - |
| `Kerjasama` | `tb_kerjasama` | lihat, cari, tambah, ubah, hapus | - |
| `Kolaborasi` | `tb_kolaborasi` | lihat, cari, tambah, ubah, hapus | - |
| `Undangan` | `tb_undangan` | lihat, cari, tambah, ubah, hapus | - |
| `Audiensi` | `tb_audiensi` | lihat, cari, tambah, ubah, hapus | - |
| `Kunjungan` | `tb_kunjungan` | lihat, cari, tambah, ubah, hapus | - |
| `Acara DKI` | `tb_acara_dki` | lihat, cari, tambah, ubah, hapus | - |
|---|---|---|

---

## 3. Hak Akses & Modul
| Role | Kunci session | Kemampuan |
|---|---|---|
| `admin` | `auth_role = admin` | Akses penuh (CRUD) ke seluruh modul, termasuk Pengaturan Sistem |
| `guest` | `auth_role = guest` | Akses hanya `index` dan `show` pada modul publik |

---

## 4. Git & Deployment
- **Repository:** https://github.com/karya-anak-bangsa/laravel-paradiplomasi
- **Domain Testing:** https://www.paradiplomasi-jakarta.id (Hostinger)
- **Domain Production:** belum tersedia

## 5. Sumber Data Acuan
Biro KSD memberikan akses data diplomasi menggunakan google spreadsheet. Adapun beberapa link akses seperti berikut 
- **[Kedutaan besar](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=0#gid=0)**
- **[Misi Asing untuk ASEAN](https://docs.google.com/spreadsheets/d/1nAn8AkgiNSYgMRTfvMZNAjQAZ0yNjTrt/edit?gid=1497379427#gid=1497379427)**
- **[Misi Permanen Negara ASEAN](https://docs.google.com/spreadsheets/d/1nAn8AkgiNSYgMRTfvMZNAjQAZ0yNjTrt/edit?gid=1288212522#gid=1288212522)**
- **Non Perwakilan Negara Asing:** Data belum tersedia.
- **[Kerjasama](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=349452470#gid=349452470)**
- **[Kolaborasi](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=908759696#gid=908759696)**
- **[Undangan](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=1980990669#gid=1980990669)**
- **[Audiensi](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=1015452074#gid=1015452074)**
- **[Kunjungan](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=306344728#gid=306344728)**
- **[Acara DKI](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?gid=697844018#gid=697844018)**

---

## 6. Teknologi & Environment
- **Framework & UI:** Laravel 13.27.0, Template Tabler UI 1.4.0
- **Environment:** PHP 8.3.28, MySQL 8.0.40, Apache 2.4.62, Composer 2.10.1, Node.js 24.12.0
- **Local Server:** Laragon 8.4.0
- **Testing Server:** Hostinger
- **Production Server:** Server Resmi Pemda DKI Jakarta (Diskominfotik)

---

## 7. Arsitektur & Konvensi Penulisan Source Code

### 7.1 Struktur Arsitektur
- **Pola Desain:** Standard MVC Laravel 13.
- **Kualitas Kode:** Mengikuti kaidah ISO 9126 (*Scalable* & *Maintainable*).

### 7.2 Aturan Penamaan
- **Database Non-Konvensional:** 
  - Nama tabel menggunakan awalan `tb_` (contoh: `tb_mitra`, `tb_kedutaan_besar`, `tb_kerjasama`).
  - Primary Key menggunakan format `id_[nama_tabel]` (contoh: `id_mitra`, `id_kedutaan_besar`).
  - **Catatan untuk Model:** Setiap Model WAJIB mendefinisikan `$table` dan `$primaryKey` secara eksplisit.
- **Model:** Singular PascalCase (contoh: `KedutaanBesar`, `MisiAsingAsean`, `Kerjasama`).
- **Controller:** Singular PascalCase + `Controller` (contoh: `KedutaanBesarController`).
- **View (Blade):** Setiap modul dalam folder terpisah dengan struktur standar: `index.blade.php`, `show.blade.php`, `create.blade.php`, `edit.blade.php`, dan `_form.blade.php`.
- **Variabel & Method:** camelCase (contoh: `$daftarKedutaan`, `getDaftarKedutaan()`).

### Pola Penulisan Source Code
- Jika kode view blade berulang dibeberapa modul maka dibuatkan x-component sehingga view blade tidak berulang.
- Controller dan model harus tipis tidak boleh ada logic.

---

## 8. Aturan untuk Claude Agent
- **Strict Pint Formatting**: Jalankan atau pastikan kode mematuhi standar PSR-12 dan Laravel Pint sebelum mengusulkan perubahan.
- **Localization**: Pesan validasi, notifikasi status, dan label antarmuka menggunakan bahasa Indonesia (`resources/lang/id` atau `lang/id`).
