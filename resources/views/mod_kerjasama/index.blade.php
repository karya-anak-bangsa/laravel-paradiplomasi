@extends('template.app')

@section('nav-kerjasama', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kerjasama"
        action="kerjasama.create">
    </x-page-header>

@endsection

@section('page-content')

    <x-page-body-table title="Daftar kerjasama dengan perwakilan negara asing">
        <x-slot name="thead">
            <tr>
                <th data-orderable="true" style="width:20%" class="text-start">Negara</th>
                <th data-orderable="true" style="width:35%" class="text-start">Kerjasama</th>
                <th data-orderable="true" style="width:15%" class="text-center">Tanggal Diterima</th>
                <th data-orderable="true" style="width:15%" class="text-center">Tanggal Selesai</th>
                <th data-orderable="true" style="width:15%" class="text-center">Status</th>
                <th data-orderable="true" style="width:10%" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($kerjasama as $item)
                <tr>
                    <td class="text-start">
                        <div class="d-flex align-items-center">
                            <span class="flag flag-sm flag-country-{{ $item->kedutaanBesar->kode_negara }} me-2"></span>
                            <span class="fw-bold">{{ $item->kedutaanBesar->nama_negara }}</span>
                        </div>
                    </td>
                    <td class="text-start">{{ $item->judul_ringkas }}</td>
                    <td class="text-center">{{ $item->tanggal_diterima_display }}</td>
                    <td class="text-center">{!! $item->tanggal_selesai_display !!}</td>
                    <td class="text-center">
                        <span class="badge {{ $item->status_badge_color }}">
                            {{ $item->status_kerjasama }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('kerjasama.show', $item) }}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('kerjasama.edit', $item) }}" class="btn btn-icon btn-warning"><i class="fa-solid fa-edit"></i></a>
                                <a href="" class="btn btn-icon btn-danger"><i class="fa-solid fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-page-body-table>
@endsection
