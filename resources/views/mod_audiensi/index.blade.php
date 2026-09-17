@extends('template.app')

@section('nav-audiensi', 'active')
@section('page-header')
    <x-page-header
        title="Modul Audiensi"
        action="audiensi.create">
    </x-page-header>

@endsection

@section('page-content')
    <x-page-body-table title="Daftar audiensi dengan perwakilan negara asing">
        <x-slot name="thead">
            <tr>
                <th data-orderable="true" style="width:30%" class="text-start">Mitra</th>
                <th data-orderable="true" style="width:30%" class="text-start">Topik</th>
                <th data-orderable="true" style="width:10%" class="text-center">Tanggal Diterima</th>
                <th data-orderable="true" style="width:10%" class="text-center">Tanggal Selesai</th>
                <th data-orderable="true" style="width:10%" class="text-center">Status</th>
                <th data-orderable="true" style="width:10%" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($audiensi as $item)
                <tr>
                    <td class="text-start">
                        <div class="d-flex align-items-center">
                            <span class="flag flag-md flag-country-{{ $item->mitra->kode_mitra }} me-2"></span>
                            <span class="fw-bold">{{ $item->mitra->nama_resmi_mitra }}</span>
                        </div>
                    </td>
                    <td class="text-start">{{ $item->judul_ringkas }}</td>
                    <td class="text-center">{{ $item->tanggal_diterima_display }}</td>
                    <td class="text-center">{!! $item->tanggal_selesai_display !!}</td>
                    <td class="text-center">
                        <span class="badge {{ $item->status_badge_color }}">
                            {{ $item->status_audiensi }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('audiensi.show', $item) }}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('audiensi.edit', $item) }}" class="btn btn-icon btn-warning"><i class="fa-solid fa-edit"></i></a>
                                <form action="{{ route('audiensi.destroy', $item) }}" method="post" class="confirm-submit d-inline" data-confirm="delete">
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
