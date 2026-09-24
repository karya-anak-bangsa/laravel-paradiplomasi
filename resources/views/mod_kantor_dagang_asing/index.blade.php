@extends('template.app')

@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header title="Modul Kantor Dagang Asing" action="kantor-dagang-asing.create" />
@endsection

@section('page-content')
    <x-page-body-table>
        <x-slot name="actions">
            <x-tombol-ekspor :modul="App\Enums\TipeMitra::KantorDagangAsing" />
        </x-slot>
        <x-slot name="thead">
            <tr>
                <th style="width: 30%">Nama</th>
                <th style="width: 55%">Keterangan</th>
                <th data-orderable="false" style="width: 15%" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($kantorDagangAsing as $item)
                <tr>
                    <td>
                        <span class="fw-bold">{{ $item->nama_kantor_dagang_asing }}</span>
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($item->keterangan, 100) ?: '-' }}</td>
                    <td>
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('kantor-dagang-asing.show', $item) }}" class="btn btn-icon btn-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('kantor-dagang-asing.edit', $item) }}" class="btn btn-icon btn-warning">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('kantor-dagang-asing.destroy', $item) }}" method="post" class="confirm-submit d-inline" data-confirm="delete">
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
