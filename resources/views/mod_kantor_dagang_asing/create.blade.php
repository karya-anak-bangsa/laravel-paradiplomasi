@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kantor Dagang Asing" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Tambah Data Kantor Dagang Asing">
        <form action="{{ route('kantor-dagang-asing.store') }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="save">
            @csrf
            @include('mod_kantor_dagang_asing._form')
        </form>
    </x-page-body-form>
@endsection
