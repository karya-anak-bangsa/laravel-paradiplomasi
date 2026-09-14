@extends('template.app')

{{-- content --}}
@section('nav-kunjungan', 'active')
@section('page-header')
    <x-page-header title="Modul Kunjungan" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Tambah Kunjungan">
        <form action="{{ route('kunjungan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('mod_kunjungan._form')
        </form>
    </x-page-body-form>
@endsection
