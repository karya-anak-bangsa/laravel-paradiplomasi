# Proyek Web Paradiplomasi Pemda DKI

## 1. Deskripsi Singkat
Website Paradiplomasi Jakarta adalah sistem informasi untuk pencatatan data diplomasi dan hubungan luar negeri Pemda DKI Jakarta yang diwakili oleh Biro Kerjasama Daerah (KSD) setda DKI Jakarta dengan beberapa mitra seperti kedutaan besar, misi asing untuk asean, misi permanen negara asean, dan non perwakilan negara asing.

---

## 2. Pembagian Modul
- **Modul Mitra:** Kedutaan Besar, Misi Asing untuk ASEAN, Misi Permanen Negara ASEAN, Non Perwakilan Negara Asing
- **Modul Riwayat Diplomasi:** Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara DKI.
- **Modul Administrator:** Pengaturan Sistem.

---

## 3. Hak Akses & Modul
- **Administrator:** Akses penuh (CRUD) ke seluruh modul, termasuk Pengaturan Sistem.
- **Tamu (Guest):** Akses baca/cari (Read-only) pada modul publik.
| Role | Kunci session | Kemampuan |
|---|---|---|
| `admin` | `auth_role = admin` | CRUD penuh + menu Pengaturan Sistem |
| `guest` ("Tamu Biro KSD") | `auth_role = guest` | hanya `index` dan `show` |

---

## 4. Git & Deployment
- **Repository:** https://github.com/karya-anak-bangsa/laravel-paradiplomasi
- **Domain Testing:** https://www.paradiplomasi-jakarta.id (Hostinger)
- **Domain Production:** belum tersedia.

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

### 7.2 Aturan Penamaan & Database (PENTING)
- **Database Non-Konvensional:** 
  - Nama tabel menggunakan awalan `tb_` (contoh: `tb_mitra`, `tb_kedutaan_besar`, `tb_kerjasama`).
  - Primary Key menggunakan format `id_[nama_tabel]` (contoh: `id_mitra`, `id_kedutaan_besar`).
  - **Catatan untuk Model:** Setiap Model WAJIB mendefinisikan `$table` dan `$primaryKey` secara eksplisit.
- **Model:** Singular PascalCase (contoh: `KedutaanBesar`, `MisiAsingAsean`, `Kerjasama`).
- **Controller:** Singular PascalCase + `Controller` (contoh: `KedutaanBesarController`).
- **View (Blade):** Setiap modul dalam folder terpisah dengan struktur standar: `index.blade.php`, `show.blade.php`, `create.blade.php`, `edit.blade.php`, dan `_form.blade.php`.
- **Variabel & Method:** camelCase (contoh: `$daftarKedutaan`, `getDaftarKedutaan()`).

---

## 8. Aturan untuk Claude Agent
- **Strict Pint Formatting**: Jalankan atau pastikan kode mematuhi standar PSR-12 dan Laravel Pint sebelum mengusulkan perubahan.
- **Localization**: Pesan validasi, notifikasi status, dan label antarmuka menggunakan bahasa Indonesia (`resources/lang/id` atau `lang/id`).
