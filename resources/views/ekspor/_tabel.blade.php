{{-- Tabel PDF sebuah DaftarEkspor. Parameter: $ekspor (DaftarEkspor), $daftarBaris (hasil $ekspor->baris()),
     $lebarKolom opsional (label => persen) — diisi pemanggil bila beberapa tabel harus selebar sama
     (PDF Riwayat Diplomasi satu mitra); tanpa itu dihitung dari $daftarBaris tabel ini saja. --}}
@php($header = $ekspor->headerBertingkat())
@php($lebarKolom ??= $ekspor->kolomSeragam() ? $ekspor->lebarKolomSeragam($daftarBaris) : [])

<table @class(['seragam' => $ekspor->kolomSeragam()])>
    <thead>
        <tr>
            @foreach ($header['atas'] as $kolom)
                <th colspan="{{ $kolom['colspan'] }}" rowspan="{{ $kolom['rowspan'] }}" @isset($lebarKolom[$kolom['label']]) style="width: {{ $lebarKolom[$kolom['label']] }}%" @endisset>{{ $kolom['label'] }}</th>
            @endforeach
        </tr>
        @if ($header['bawah'] !== [])
            <tr>
                @foreach ($header['bawah'] as $label)
                    {{-- lebar diminta lewat label lengkap ("Tanggal Diterima"), bukan "Diterima" --}}
                    <th @isset($lebarKolom[\App\Support\DaftarEkspor::GRUP_TANGGAL.' '.$label]) style="width: {{ $lebarKolom[\App\Support\DaftarEkspor::GRUP_TANGGAL.' '.$label] }}%" @endisset>{{ $label }}</th>
                @endforeach
            </tr>
        @endif
    </thead>
    <tbody>
        @forelse ($daftarBaris as $baris)
            {{-- Daftar Undangan Acara DKI ditulis satu mitra per <tr>, bukan <br> di
                 satu sel: dompdf tidak bisa memecah satu baris tabel ke dua halaman,
                 sehingga acara dengan puluhan mitra akan terpotong di bawah kertas.
                 Kolom lain hanya diisi di <tr> pertama (bukan rowspan — lebar kolom
                 dompdf menyusut di halaman lanjutan kalau pakai rowspan). Alasan
                 kehadiran sengaja tidak dicetak di PDF — hanya di Excel. --}}
            @php($jumlahTr = max(1, ...array_map(fn ($nilai) => is_array($nilai) ? count($nilai) : 1, array_values($baris))))
            @for ($i = 0; $i < $jumlahTr; $i++)
                <tr>
                    @foreach ($baris as $label => $nilai)
                        <td @class([
                            'tengah' => in_array($label, \App\Support\DaftarEkspor::KOLOM_SEMPIT),
                            'sambung-atas' => $i > 0,
                            'sambung-bawah' => $i < $jumlahTr - 1,
                        ])>
                            @if (is_array($nilai))
                                @if ($nilai === [])
                                    {{ \App\Support\EksporDiplomasi::TANPA_MITRA }}
                                @else
                                    {{ $i + 1 }}). {{ \App\Support\EksporDiplomasi::teksUndangan($nilai[$i], denganAlasan: false) }}
                                @endif
                            @elseif ($i > 0)
                                {{-- lanjutan: sudah ditulis di <tr> pertama --}}
                            @elseif ($nilai instanceof \DateTimeInterface)
                                {{ $nilai->format('d M Y') }}
                            @else
                                {{-- "\n" = nilai dua baris, mis. nama ID + EN pada daftar mitra --}}
                                {!! $ekspor->kolomSeragam() ? \App\Support\DaftarEkspor::htmlSelSeragam($nilai ?? '-') : nl2br(e($nilai ?? '-')) !!}
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
