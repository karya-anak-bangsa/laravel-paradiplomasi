@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Misi Asing untuk ASEAN" />
@endsection

@section('page-content')
    <x-page-body-table title="Catatan Misi Asing untuk ASEAN Aktif di Biro KSD">
        <x-slot name="thead">
            <tr>
                <th>Negara</th>
                <th>Nama Misi Resmi</th>
                <th>Nama Diplomat</th>
                <th data-orderable="false" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($misiAsingAsean as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="flag flag-sm flag-country-{{ $item->kode_negara }} me-2"></span>
                            <span class="fw-bold">{{ $item->nama_negara }}</span>
                        </div>
                    </td>
                    <td>
                        <p class="fst-normal mb-0">{{ $item->nama_misi_asing_asean_id ?? '-' }}</p>
                        <small class="fst-italic text-primary mb-0">{{ $item->nama_misi_asing_asean_en ?? '-' }}</small>
                    </td>
                    <td>{{ $item->nama_diplomat ?? '-' }}</td>
                    <td>
                        <div class="btn-list justify-content-center">
                            <a href="{{ route('misi-asing-asean.show', $item) }}" class="btn btn-icon btn-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('misi-asing-asean.edit', $item) }}" class="btn btn-icon btn-warning">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-page-body-table>
@endsection
