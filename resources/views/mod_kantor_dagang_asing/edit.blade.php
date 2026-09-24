@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kantor Dagang Asing" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data Kantor Dagang Asing">
        <form action="{{ route('kantor-dagang-asing.update', $kantorDagangAsing) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_kantor_dagang_asing._form')
        </form>
    </x-page-body-form>
@endsection
