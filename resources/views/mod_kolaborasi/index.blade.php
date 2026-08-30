@extends('template.app')

@section('nav-kolaborasi', 'active')
@section('page-header')
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Data Kolaborasi</h2>
            <span class="text-secondary">Daftar kolaborasi dengan perwakilan negara asing</span>
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
