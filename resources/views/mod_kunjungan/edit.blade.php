@extends('template.app')

{{-- content --}}
@section('nav-kunjungan', 'active')
@section('page-header')
    <x-page-header title="Modul Kunjungan" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-form title="Form Ubah Kunjungan">
        <form action="{{ route('kunjungan.update', $kunjungan) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_kunjungan._form')
        </form>
    </x-page-body-form>
@endsection
