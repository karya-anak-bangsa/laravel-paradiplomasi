@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul PTRI" action="ptri.create" />
@endsection

@section('page-content')
    <x-page-body-table>
        <x-slot name="thead">
            <tr>
                <th style="width: 30%">Nama</th>
                <th style="width: 55%">Keterangan</th>
                <th data-orderable="false" style="width: 15%" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($ptri as $item)
                <tr>
                    <td>
                        <span class="fw-bold">{{ $item->nama_ptri }}</span>
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($item->keterangan, 100) ?: '-' }}</td>
                    <td>
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('ptri.show', $item) }}" class="btn btn-icon btn-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('ptri.edit', $item) }}" class="btn btn-icon btn-warning">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('ptri.destroy', $item) }}" method="post" class="confirm-submit d-inline" data-confirm="delete">
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
