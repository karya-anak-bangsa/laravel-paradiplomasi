@extends('template.app')

@section('nav-undangan', 'active')
@section('page-header')
    <x-page-header
        title="Modul Undangan"
        action="undangan.create">
    </x-page-header>

@endsection

@section('page-content')
    <x-page-body-table
        title="Daftar undangan dari perwakilan negara asing">

        <x-slot name="thead">
            <tr>
                <th data-orderable="true" style="width: 15%">Negara</th>
                <th data-orderable="false" style="width: 23%">Acara</th>
                <th data-orderable="false" style="width: 35%">Rangkuman</th>
                <th data-orderable="true" style="width: 10%">Status Undangan</th>
                <th data-orderable="false" class="text-center" style="width: 1%; white-space: nowrap;">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($undangan as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="flag flag-sm flag-country-{{ $item->kedutaanBesar->kode_negara }} me-2"></span>
                            <span class="fw-bold">{{ $item->kedutaanBesar->nama_negara }}</span>
                        </div>
                    </td>
                    <td>
                        {{ str($item->acara)->stripTags() }}
                    </td>
                    <td>
                        {{ str($item->rangkuman)->stripTags()->limit(100) }}
                    </td>
                    <td>
                        <span class="badge {{ $item->status_badge_color }}">
                            {{ $item->status_undangan }}
                        </span>
                    </td>
                    <td style="white-space: nowrap;">
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('undangan.show', $item) }}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                            @if (session('auth_role') === 'admin')
                                <a href="" class="btn btn-icon btn-warning"><i class="fa-solid fa-edit"></i></a>
                                <a href="" class="btn btn-icon btn-danger"><i class="fa-solid fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-page-body-table>
@endsection
