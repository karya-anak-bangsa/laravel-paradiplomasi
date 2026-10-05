{{-- PDF seluruh Riwayat Diplomasi satu mitra: satu tabel berjudul per modul (lihat App\Support\EksporRiwayatMitra) --}}
@extends('ekspor.layout-pdf')

@section('judul', $ekspor->judul())

@section('isi')
    <h1>{{ $ekspor->judul() }}</h1>
    <p class="keterangan">{{ $ekspor->keterangan() }}</p>

    @foreach ($ekspor->bagian() as $bagian)
        @php($daftarBaris = $bagian->baris())

        <h2>{{ $loop->iteration }}. {{ $bagian->judul() }} ({{ count($daftarBaris) }} data)</h2>

        {{-- lebar kolom disamakan untuk keenam tabel, lihat EksporRiwayatMitra::lebarKolom() --}}
        @include('ekspor._tabel', ['ekspor' => $bagian, 'daftarBaris' => $daftarBaris, 'lebarKolom' => $ekspor->lebarKolom($bagian)])
    @endforeach
@endsection
