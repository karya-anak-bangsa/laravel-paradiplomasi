@extends('template.app')

@section('nav-kunjungan', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kunjungan"
        action="kunjungan.create">
    </x-page-header>

@endsection

@section('page-content')
    <x-page-body-filter :statusOptions="$statusOptions" :tahunOptions="$tahunOptions" :modul="App\Enums\ModulDiplomasi::Kunjungan" />

    <x-page-body-table title="Daftar kunjungan dari/ke perwakilan negara asing">
        <x-slot name="thead">
            <tr>
                <th data-orderable="true" style="width:30%" class="text-start">Mitra</th>
                <th data-orderable="true" style="width:30%" class="text-start">Perihal</th>
                <th data-orderable="true" style="width:10%" class="text-center">Tanggal Diterima</th>
                <th data-orderable="true" style="width:10%" class="text-center">Tanggal Selesai</th>
                <th data-orderable="true" style="width:10%" class="text-center">Status</th>
                <th data-orderable="true" style="width:10%" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($kunjungan as $item)
                <tr>
                    <td class="text-start">
                        <div class="d-flex align-items-center">
                            <x-mitra-icon :mitra="$item->mitra" />
                            <span class="fw-bold">{{ $item->mitra->nama_resmi_mitra }}</span>
                        </div>
                    </td>
                    <td class="text-start">{{ $item->judul_ringkas }}</td>
                    <td class="text-center" data-order="{{ $item->tanggal_diterima_order }}">{{ $item->tanggal_diterima_display }}</td>
                    <td class="text-center" data-order="{{ $item->tanggal_selesai_order }}">{!! $item->tanggal_selesai_display !!}</td>
                    <td class="text-center">
                        <span class="badge {{ $item->status_badge_color }}">
                            {{ $item->status_kunjungan }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('kunjungan.show', $item) }}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('kunjungan.edit', $item) }}" class="btn btn-icon btn-warning"><i class="fa-solid fa-edit"></i></a>
                                <form action="{{ route('kunjungan.destroy', $item) }}" method="post" class="confirm-submit d-inline" data-confirm="delete">
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
