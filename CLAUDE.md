# Proyek Web Paradiplomasi Pemda DKI

## 1. Ikhtisar & Tautan Penting
- **Repository:** https://github.com/karya-anak-bangsa/laravel-paradiplomasi
- **Domain Produksi:** https://www.paradiplomasi-jakarta.id (Hostinger)
- **Sumber Data Acuan:** [Spreadsheet Data Diplomasi DKI](https://docs.google.com/spreadsheets/d/1S1RD2XSW96kCV6dSM2cEJpMCtwDH7Xmc072knEET7_o/edit?usp=sharing)
- **Tujuan Sistem:** Pengelolaan dan pencatatan riwayat diplomasi dan kemitraan luar negeri Pemda DKI Jakarta.

--

## 1. Deskripsi Singkat
- Sistem pengelolaan kerja sama internasional dan hubungan paradiplomasi Pemda DKI Jakarta.
- saya akan lanjutkan. 

---

## 2. Pembagian Modul
- **Modul Mitra:** Kedutaan Besar, Misi Asing untuk ASEAN, Misi Permanen Negara ASEAN, Non Perwakilan Negara Asing
- **Modul Riwayat Diplomasi:** Kerjasama, Kolaborasi, Undangan, Audiensi, Kunjungan, Acara DKI.
- **Modul Administrator:** Pengaturan Sistem.

---

## 3. Hak Akses & Modul
- **Administrator:** Akses penuh (CRUD) ke seluruh modul, termasuk Pengaturan Sistem.
- **Tamu (Guest):** Akses baca/cari (Read-only) pada modul publik.

---

## 4. Git & Deployment
- **Repository:** https://github.com/karya-anak-bangsa/laravel-paradiplomasi
- **Domain Testing:** https://www.paradiplomasi-jakarta.id (Hostinger)

---

## 5. Stack Teknologi & Environment
- **Framework & UI:** Laravel 13.27.0, Template Tabler UI 1.4.0
- **Environment:** PHP 8.3.28, MySQL 8.0.40, Apache 2.4.62, Composer 2.10.1, Node.js 24.12.0
- **Local Server:** Laragon 8.4.0
- **Testing Server:** Hostinger
- **Production Server:** Server Resmi Pemda DKI Jakarta (Diskominfotik)

---

## 6. Arsitektur & Konvensi Penulisan Source Code

### 6.1 Struktur Arsitektur
- **Pola Desain:** Standard MVC Laravel 13.
- **Kualitas Kode:** Mengikuti kaidah ISO 9126 (*Scalable* & *Maintainable*).

### 6.2 Aturan Penamaan & Database (PENTING)
- **Database Non-Konvensional:** 
  - Nama tabel menggunakan awalan `tb_` (contoh: `tb_mitra`, `tb_kedutaan_besar`, `tb_kerjasama`).
  - Primary Key menggunakan format `id_[nama_tabel]` (contoh: `id_mitra`, `id_kedutaan_besar`).
  - **Catatan untuk Model:** Setiap Model WAJIB mendefinisikan `$table` dan `$primaryKey` secara eksplisit.
- **Model:** Singular PascalCase (contoh: `KedutaanBesar`, `MisiAsingAsean`, `Kerjasama`).
- **Controller:** Singular PascalCase + `Controller` (contoh: `KedutaanBesarController`).
- **View (Blade):** Setiap modul dalam folder terpisah dengan struktur standar: `index.blade.php`, `show.blade.php`, `create.blade.php`, `edit.blade.php`, dan `_form.blade.php`.
- **Variabel & Method:** camelCase (contoh: `$daftarKedutaan`, `getDaftarKedutaan()`).

---

## 7. Aturan untuk Claude Agent
- **Strict Pint Formatting**: Jalankan atau pastikan kode mematuhi standar PSR-12 dan Laravel Pint sebelum mengusulkan perubahan.
- **Localization**: Pesan validasi, notifikasi status, dan label antarmuka menggunakan bahasa Indonesia (`resources/lang/id` atau `lang/id`).
