@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Perwakilan RI di Luar Negeri" />
@endsection

@section('page-content')
    <x-page-body-form title="Form Ubah Data Perwakilan RI">
        <form action="{{ route('perwakilan-ri.update', $perwakilanRi) }}" method="post" enctype="multipart/form-data" class="confirm-submit" data-confirm="update">
            @csrf
            @method('PUT')
            @include('mod_perwakilan_ri._form')
        </form>
    </x-page-body-form>
@endsection
