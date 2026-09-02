@extends('template.app')

{{-- content --}}
@section('nav-kedutaan-besar', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kedutaan Besar"
        back-route="kedutaan-besar.index">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rincian Data - {{ $kedutaanBesar->nama_negara }}</h3>
                </div>
                <div class="card-body">

                    {{-- format undangan --}}
                    <div class="hr-text hr-text-left mt-4">Format Undangan</div>
                    @if ($kedutaanBesar->format_undangan)
                        <p class="mb-0" style="white-space: pre-line;">{{ $kedutaanBesar->format_undangan }}</p>
                    @else
                        <p class="text-secondary mb-0">Belum ada catatan format undangan.</p>
                    @endif
                    {{-- format undangan --}}

                    <div class="hr-text hr-text-start">Diplomasi</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-content">
                                <span class="flag flag-lg flag-country-{{ $kedutaanBesar->kode_negara }}"></span>
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (ID)</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Kedutaan (EN)</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Nama Diplomat</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->nama_diplomat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Jabatan Diplomat</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->jabatan_diplomat ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="hr-text hr-text-start">Kontak</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Telepon Kantor</div>
                            <div class="datagrid-content">
                                @forelse ($kedutaanBesar->telepon_kantor_array as $telepon)
                                    <div>{{ $telepon }}</div>
                                @empty
                                    -
                                @endforelse
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Email Kantor</div>
                            <div class="datagrid-content">
                                @forelse ($kedutaanBesar->email_kantor_array as $email)
                                    <div>{{ $email }}</div>
                                @empty
                                    -
                                @endforelse
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Website</div>
                            <div class="datagrid-content">
                                @if ($kedutaanBesar->website)
                                    <a href="{{ $kedutaanBesar->website }}" target="_blank" rel="noopener">{{ $kedutaanBesar->website }}</a>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="hr-text hr-text-start">Alamat</div>
                    <div class="datagrid align-items-center">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Alamat Lengkap</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->alamat ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Kelurahan</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->kelurahan ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Kecamatan</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->kecamatan ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Kota</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->kota ?? '-' }}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Kode Pos</div>
                            <div class="datagrid-content">{{ $kedutaanBesar->kode_pos ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- <small class="text-danger">Diakses pada {{ now()->format('d M Y, H:i') }} WIB</small> --}}
                </div>
                {{-- card-footer --}}
            </div>
            {{-- card --}}
        </div>
        {{-- col --}}
    </div>
    {{-- row --}}

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Diplomasi</h3>
                </div>
                <div class="card-body">
                    <span>Abaikan ini. Next development</span>
                </div>
                <div class="card-footer">
                    {{-- <small class="text-danger">Diakses pada {{ now()->format('d M Y, H:i') }} WIB</small> --}}
                </div>
                {{-- card-footer --}}
            </div>
            {{-- card --}}
        </div>
        {{-- col --}}
    </div>
    {{-- row --}}

@endsection
