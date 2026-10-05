@extends('ekspor.layout-pdf')

@section('judul', $ekspor->judul())

@section('isi')
    @php($daftarBaris = $ekspor->baris())

    <h1>{{ $ekspor->judul() }}</h1>
    <p class="keterangan">{{ $ekspor->keteranganFilter() }} {{ $ekspor->pemisahKeterangan() }} {{ count($daftarBaris) }} data</p>

    @include('ekspor._tabel', ['ekspor' => $ekspor, 'daftarBaris' => $daftarBaris])
@endsection
