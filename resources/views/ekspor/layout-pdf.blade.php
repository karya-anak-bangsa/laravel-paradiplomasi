<!DOCTYPE html>
<html lang="id">

    {{-- Kerangka seluruh file PDF ekspor (kop, footer, gaya tabel). Isinya dari
         daftar-pdf (satu tabel) atau riwayat-mitra-pdf (satu tabel per modul);
         tabelnya sendiri di ekspor._tabel. --}}

    <head>
        <meta charset="UTF-8">
        <title>@yield('judul')</title>
        <style>
            @page {
                margin: 95px 36px 50px 36px;
            }

            body {
                font-family: "DejaVu Sans", sans-serif;
                font-size: 11px;
                color: #1e293b;
            }

            header {
                position: fixed;
                top: -75px;
                left: 0;
                right: 0;
                height: 52px;
                border-bottom: 2px solid #1e293b;
            }

            header img {
                height: 44px;
                float: left;
                margin-right: 10px;
            }

            header .instansi {
                font-size: 15px;
                font-weight: bold;
                padding-top: 4px;
            }

            header .aplikasi {
                font-size: 11px;
                color: #475569;
            }

            footer {
                position: fixed;
                bottom: -30px;
                left: 0;
                right: 0;
                font-size: 10px;
                color: #64748b;
            }

            h1 {
                font-size: 16px;
                margin: 0 0 2px;
            }

            /* Judul bagian per modul pada PDF Riwayat Diplomasi satu mitra */
            h2 {
                font-size: 13px;
                margin: 16px 0 6px;
                page-break-after: avoid;
            }

            .keterangan {
                margin: 0 0 10px;
                color: #475569;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            /* Kolom "No" selebar isinya, kolom lain sama lebar (lihat DaftarEkspor::kolomSeragam()) */
            thead {
                display: table-header-group;
            }

            th,
            td {
                border: 1px solid #94a3b8;
                padding: 4px 5px;
                vertical-align: top;
            }

            th {
                background: #e2e8f0;
                text-align: center;
            }

            .tengah {
                text-align: center;
                white-space: nowrap;
            }

            /* Satu data Acara DKI = beberapa <tr> (satu per mitra undangan).
               Garis di antara <tr>-nya dihapus supaya terlihat sebagai satu sel. */
            td.sambung-atas {
                border-top: none;
                padding-top: 1px;
            }

            td.sambung-bawah {
                border-bottom: none;
                padding-bottom: 1px;
            }
        </style>
    </head>

    <body>
        <header>
            {{-- Versi kecil (159×180 px) khusus kop PDF: dompdf menyematkan gambar
                 dalam resolusi aslinya, dan dki-jakarta.webp (1200×1355 px) saja
                 menambah ±700 KB ke setiap file. --}}
            <img src="{{ public_path('img/dki-jakarta-kop.png') }}" alt="Logo DKI Jakarta">
            <div class="instansi">Biro Kerjasama Daerah Setda Provinsi DKI Jakarta</div>
            <div class="aplikasi">Paradiplomatic Compass Analytical System (https://paradiplomasi-jakarta.id/)</div>
        </header>

        {{-- "Halaman X dari Y" dicetak di pojok kanan footer oleh
             MengunduhEkspor::nomorHalaman() — dompdf tidak mendukung counter(pages) di CSS --}}
        <footer><x-waktu-akses label="Diunduh pada" /></footer>

        @yield('isi')
    </body>

</html>
