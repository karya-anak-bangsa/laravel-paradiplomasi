@extends('template.app')

@section('nav-kolaborasi', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kolaborasi"
        action="kolaborasi.create">
    </x-page-header>

@endsection

@section('page-content')
    <x-page-body-table title="Daftar kolaborasi dengan perwakilan negara asing">
        <x-slot name="thead">
            <tr>
                <th data-orderable="true" style="width:15%" class="text-start">Negara</th>
                <th data-orderable="true" style="width:20%" class="text-start">Mitra</th>
                <th data-orderable="true" style="width:25%" class="text-start">Kolaborasi</th>
                <th data-orderable="true" style="width:12%" class="text-center">Tanggal Diterima</th>
                <th data-orderable="true" style="width:12%" class="text-center">Tanggal Selesai</th>
                <th data-orderable="true" style="width:8%" class="text-center">Status</th>
                <th data-orderable="true" style="width:8%" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($kolaborasi as $item)
                <tr>
                    <td class="text-start">
                        <div class="d-flex align-items-center">
                            <span class="flag flag-sm flag-country-{{ $item->mitra->kode_mitra }} me-2"></span>
                            <span class="fw-bold">{{ $item->mitra->nama_mitra }}</span>
                        </div>
                    </td>
                    <td class="text-start">{{ $item->mitra->nama_resmi_mitra }}</td>
                    <td class="text-start">{{ $item->judul_ringkas }}</td>
                    <td class="text-center">{{ $item->tanggal_diterima_display }}</td>
                    <td class="text-center">{!! $item->tanggal_selesai_display !!}</td>
                    <td class="text-center">
                        <span class="badge {{ $item->status_badge_color }}">
                            {{ $item->status_kolaborasi }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('kolaborasi.show', $item) }}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('kolaborasi.edit', $item) }}" class="btn btn-icon btn-warning"><i class="fa-solid fa-edit"></i></a>
                                <form action="{{ route('kolaborasi.destroy', $item) }}" method="post" class="confirm-submit d-inline" data-confirm="delete">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-page-body-table>
@endsection
