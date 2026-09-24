@extends('template.app')

@section('nav-kegiatan', 'active')
@section('page-header')
    <x-page-header
        title="Modul Acara DKI"
        action="acara-dki.create">
    </x-page-header>

@endsection

@section('page-content')
    <x-page-body-filter :statusOptions="$statusOptions" :tahunOptions="$tahunOptions" :modul="App\Enums\ModulDiplomasi::AcaraDki" />

    <x-page-body-table title="Daftar acara DKI">
        <x-slot name="thead">
            <tr>
                <th data-orderable="true" style="width:22%" class="text-start">Acara DKI</th>
                <th data-orderable="true" style="width:16%" class="text-center">Daftar Undangan</th>
                <th data-orderable="true" style="width:15%" class="text-center">Tanggal Diterima</th>
                <th data-orderable="true" style="width:15%" class="text-center">Tanggal Selesai</th>
                <th data-orderable="true" style="width:14%" class="text-center">Status</th>
                <th data-orderable="true" style="width:18%" class="text-center">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($acaraDki as $item)
                <tr>
                    <td class="text-start">{{ $item->judul_ringkas }}</td>
                    <td class="text-center">
                        @if ($item->mitra->isEmpty())
                            {{-- acara tanpa mitra sama sekali (dibatalkan/ditunda, atau
                                 data undangannya belum dikurasi) ditandai terpisah supaya
                                 tidak terbaca sebagai tiga hitungan nol. --}}
                            <span class="badge bg-secondary-lt d-block">Belum ada mitra</span>
                        @else
                            <span class="badge bg-blue-lt d-block mb-1">{{ $item->mitra->where('pivot.status_kehadiran', 'Diundang')->count() }} Diundang</span>
                            <span class="badge bg-success-lt d-block mb-1">{{ $item->mitra->where('pivot.status_kehadiran', 'Hadir')->count() }} Hadir</span>
                            <span class="badge bg-danger-lt d-block">{{ $item->mitra->where('pivot.status_kehadiran', 'Tidak Hadir')->count() }} Tidak Hadir</span>
                        @endif
                    </td>
                    <td class="text-center" data-order="{{ $item->tanggal_diterima_order }}">{{ $item->tanggal_diterima_display }}</td>
                    <td class="text-center" data-order="{{ $item->tanggal_selesai_order }}">{!! $item->tanggal_selesai_display !!}</td>
                    <td class="text-center">
                        <span class="badge {{ $item->status_badge_color }}">
                            {{ $item->status_acara_dki }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-list flex-nowrap justify-content-center">
                            <a href="{{ route('acara-dki.show', $item) }}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                            @if (session('auth_role') === 'admin')
                                <a href="{{ route('acara-dki.edit', $item) }}" class="btn btn-icon btn-warning"><i class="fa-solid fa-edit"></i></a>
                                <form action="{{ route('acara-dki.destroy', $item) }}" method="post" class="confirm-submit d-inline" data-confirm="delete">
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
