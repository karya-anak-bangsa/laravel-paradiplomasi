@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Misi Permanen Negara ASEAN" action="misi-permanen-asean.create" />
@endsection

@section('page-content')
    <x-page-body-table>
        <x-slot name="thead">
            <tr>
                <th style="width: 20%">Negara</th>
                <th style="width: 35%">Nama Misi Resmi</th>
                <th style="width: 35%">Nama Diplomat</th>
                <th data-orderable="false" class="text-center" style="width: 10%">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($misiPermanenAsean as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="flag flag-sm flag-country-{{ $item->kode_negara }} me-2"></span>
                            <span class="fw-bold">{{ $item->nama_negara }}</span>
                        </div>
                    </td>
                    <td>
                        <p class="fst-normal mb-0">{{ $item->nama_misi_permanen_asean_id ?? '-' }}</p>
                        <small class="fst-italic text-primary mb-0">{{ $item->nama_misi_permanen_asean_en ?? '-' }}</small>
                    </td>
                    <td>{{ $item->nama_diplomat ?? '-' }}</td>
                    <td>
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('misi-permanen-asean.show', $item) }}" class="btn btn-icon btn-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('misi-permanen-asean.edit', $item) }}" class="btn btn-icon btn-warning">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('misi-permanen-asean.destroy', $item) }}" method="post" class="confirm-submit d-inline" data-confirm="delete">
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
