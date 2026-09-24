<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>{{ $ekspor->judul() }}</title>
        <style>
            @page {
                margin: 95px 36px 50px 36px;
            }

            body {
                font-family: "DejaVu Sans", sans-serif;
                font-size: 9px;
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
                font-size: 12px;
                font-weight: bold;
                padding-top: 6px;
            }

            header .aplikasi {
                font-size: 9px;
                color: #475569;
            }

            footer {
                position: fixed;
                bottom: -30px;
                left: 0;
                right: 0;
                font-size: 8px;
                color: #64748b;
            }

            h1 {
                font-size: 13px;
                margin: 0 0 2px;
            }

            .keterangan {
                margin: 0 0 8px;
                color: #475569;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

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
        </style>
    </head>

    <body>
        <header>
            {{-- Versi kecil (159×180 px) khusus kop PDF: dompdf menyematkan gambar
                 dalam resolusi aslinya, dan dki-jakarta.webp (1200×1355 px) saja
                 menambah ±700 KB ke setiap file. --}}
            <img src="{{ public_path('img/dki-jakarta-kop.png') }}" alt="Logo DKI Jakarta">
            <div class="instansi">Biro Kerjasama Daerah Setda Provinsi DKI Jakarta</div>
            <div class="aplikasi">Paradiplomasi Jakarta — Paradiplomatic Compass Analytical System</div>
        </header>

        {{-- "Halaman X dari Y" dicetak di pojok kanan footer oleh
             EksporDiplomasiController::nomorHalaman() — dompdf tidak mendukung counter(pages) di CSS --}}
        <footer><x-waktu-akses label="Diunduh pada" /></footer>

        @php($daftarBaris = $ekspor->baris())

        <h1>{{ $ekspor->judul() }}</h1>
        <p class="keterangan">{{ $ekspor->keteranganFilter() }} &middot; {{ count($daftarBaris) }} data</p>

        <table>
            <thead>
                <tr>
                    @foreach ($ekspor->header() as $label)
                        <th>{{ $label }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($daftarBaris as $baris)
                    <tr>
                        @foreach ($baris as $label => $nilai)
                            <td @class(['tengah' => in_array($label, \App\Support\EksporDiplomasi::KOLOM_SEMPIT)])>
                                @if ($nilai instanceof \DateTimeInterface)
                                    {{ $nilai->format('d M Y') }}
                                @elseif (is_array($nilai))
                                    {{-- disambung, bukan satu per baris: dompdf tidak bisa memecah
                                         satu baris tabel ke dua halaman, jadi acara dengan puluhan
                                         mitra akan terpotong kalau ditulis menurun --}}
                                    {{ implode('; ', $nilai) }}
                                @else
                                    {{ $nilai ?? '-' }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($ekspor->header()) }}" class="tengah">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>

</html>
