@extends('template.app')

{{-- content --}}
@section('nav-kedutaan-besar', 'active')
@section('page-header')
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Modul Kedutaan Besar</h2>
            {{-- <span class="text-secondary">Daftar perwakilan negara asing yang terdaftar</span> --}}
        </div>
        <div class="col-auto">
            <a class="btn btn-success" href="{{-- route('kedutaan-besar.create') --}}">
                <i class="fa-solid fa-plus me-1"></i>Tambah Data
            </a>
        </div>
    </div>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Daftar mitra aktif di Biro KSD</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter datatable">
                            <thead>
                                <tr>
                                    <th>Negara</th>
                                    <th>Nama Kedutaan</th>
                                    <th>Nama Diplomat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kedutaanBesar as $item)
                                    <tr>
                                        <td>
                                            {{ $item->nama_negara }}
                                        </td>
                                        <td>
                                            <p class="fst-normal mb-0">{{ $item->nama_kedutaan_besar_id ?? '-' }}</p>
                                            <small class="fst-italic mb-0">{{ $item->nama_kedutaan_besar_en ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <p class="fst-normal mb-0">{{ $item->nama_diplomat ?? '-' }}</p>
                                            <small class="fst-italic mb-0">{{ $item->jabatan_diplomat ?? '-' }}</small>
                                        </td>
                                        <td>
                                            @if ($item->is_active)
                                                <span class="badge bg-success-lt">Aktif</span>
                                            @else
                                                <span class="badge bg-warning-lt">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="" class="btn btn-icon btn-primary">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="" class="btn btn-icon btn-warning">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-icon btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

@endsection
