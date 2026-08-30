@extends('template.app')

@section('nav-kerjasama', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kerjasama"
        action="kerjasama.create">
    </x-page-header>

@endsection

@section('page-content')
    <x-page-body-table
        title="Daftar kerjasama dengan perwakilan negara asing">

        <x-slot name="thead">
            <tr>
                <th>Negara</th>
                <th>Kerjasama</th>
                <th data-orderable="false">Rangkuman</th>
                <th data-orderable="false">File Dokumen</th>
                <th data-orderable="false">Status Kerjasama</th>
                <th data-orderable="false" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($kerjasama as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="flag flag-sm flag-country-{{ $item->kedutaanBesar->kode_negara }} me-2"></span>
                            <span class="fw-bold">{{ $item->kedutaanBesar->nama_negara }}</span>
                        </div>
                    </td>
                    <td>
                        {{ str($item->kerjasama)->stripTags() }}
                    </td>
                    <td>
                        {{ str($item->rangkuman)->stripTags()->limit(100) }}
                    </td>
                    <td>
                        {{-- Dummy: belum ada route/storage download, tinggal ganti href saat sudah siap --}}
                        <a href="#" class="badge bg-blue-lt">
                            <i class="fa-solid fa-download me-1"></i>Unduh
                        </a>
                    </td>
                    <td>
                        <span class="badge {{ $item->status_badge_color }}">
                            {{ $item->status_kerjasama }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-list justify-content-center">
                            <a href="{{ route('kerjasama.show', $item) }}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                            <a href="#" class="btn btn-icon btn-warning"><i class="fa-solid fa-edit"></i></a>
                            <a href="#" class="btn btn-icon btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-page-body-table>
@endsection
