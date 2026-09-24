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

            .keterangan {
                margin: 0 0 10px;
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
            <div class="aplikasi">Paradiplomatic Compass Analytical (https://paradiplomasi-jakarta.id/)</div>
        </header>

        {{-- "Halaman X dari Y" dicetak di pojok kanan footer oleh
             EksporDiplomasiController::nomorHalaman() — dompdf tidak mendukung counter(pages) di CSS --}}
        <footer><x-waktu-akses label="Diunduh pada" /></footer>

        @php($daftarBaris = $ekspor->baris())
        @php($header = $ekspor->headerBertingkat())

        <h1>{{ $ekspor->judul() }}</h1>
        <p class="keterangan">{{ $ekspor->keteranganFilter() }} &middot; {{ count($daftarBaris) }} data</p>

        <table>
            <thead>
                <tr>
                    @foreach ($header['atas'] as $kolom)
                        <th colspan="{{ $kolom['colspan'] }}" rowspan="{{ $kolom['rowspan'] }}">{{ $kolom['label'] }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($header['bawah'] as $label)
                        <th>{{ $label }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($daftarBaris as $baris)
                    {{-- Daftar Undangan Acara DKI ditulis satu mitra per <tr>, bukan <br> di
                         satu sel: dompdf tidak bisa memecah satu baris tabel ke dua halaman,
                         sehingga acara dengan puluhan mitra akan terpotong di bawah kertas.
                         Kolom lain hanya diisi di <tr> pertama (bukan rowspan — lebar kolom
                         dompdf menyusut di halaman lanjutan kalau pakai rowspan). --}}
                    @php($jumlahTr = max(1, ...array_map(fn ($nilai) => is_array($nilai) ? count($nilai) : 1, array_values($baris))))
                    @for ($i = 0; $i < $jumlahTr; $i++)
                        <tr>
                            @foreach ($baris as $label => $nilai)
                                <td @class([
                                    'tengah' => in_array($label, \App\Support\EksporDiplomasi::KOLOM_SEMPIT),
                                    'sambung-atas' => $i > 0,
                                    'sambung-bawah' => $i < $jumlahTr - 1,
                                ])>
                                    @if (is_array($nilai))
                                        @if ($nilai === [])
                                            {{ \App\Support\EksporDiplomasi::TANPA_MITRA }}
                                        @else
                                            {{ $i + 1 }}). {{ $nilai[$i] }}
                                        @endif
                                    @elseif ($i > 0)
                                        {{-- lanjutan: sudah ditulis di <tr> pertama --}}
                                    @elseif ($nilai instanceof \DateTimeInterface)
                                        {{ $nilai->format('d M Y') }}
                                    @else
                                        {{ $nilai ?? '-' }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endfor
                @empty
                    <tr>
                        <td colspan="{{ count($ekspor->header()) }}" class="tengah">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>

</html>
