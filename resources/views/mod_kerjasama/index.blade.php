@extends('template.app')

@section('nav-kerjasama', 'active')
@section('page-header')
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Data Kerjasama</h2>
            <span class="text-secondary">Daftar kerjasama dengan perwakilan negara asing</span>
        </div>
        <div class="col-auto">
            <a class="btn btn-success" href="{{-- route('kedutaan-besar.create') --}}">
                <i class="fa-solid fa-plus me-1"></i>Tambah Data
            </a>
        </div>
    </div>
@endsection

@section('page-content')

@endsection
