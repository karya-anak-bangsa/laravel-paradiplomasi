@extends('template.app')

{{-- content --}}
@section('nav-kedutaan-besar', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kedutaan Besar"
        action="kedutaan-besar.create">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-table title="Catatan Mitra Aktif di Biro KSD">
        <x-slot name="thead">
            <tr>
                <th>Negara</th>
                <th>Nama Kedutaan</th>
                <th>Nama Diplomat</th>
                <th data-orderable="false" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($kedutaanBesar as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="flag flag-sm flag-country-{{ $item->kode_negara }} me-2"></span>
                            <span class="fw-bold">{{ $item->nama_negara }}</span>
                        </div>
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
                        <div class="btn-list justify-content-center">
                            <a href="{{ route('kedutaan-besar.show', $item) }}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                            <a href="#" class="btn btn-icon btn-warning"><i class="fa-solid fa-edit"></i></a>
                            <a href="#" class="btn btn-icon btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-page-body-table>
@endsection
