<div class="card">
    <div class="card-header">
        <h3 class="card-title">Rincian Data - {{ $kedutaanBesar->nama_negara }}</h3>
    </div>
    <div class="card-body">

        {{-- format undangan --}}
        <div class="hr-text hr-text-start">Format Undangan</div>
        @if ($kedutaanBesar->format_undangan)
            <p class="badge bg-primary-lt text-primary-lt-fg fs-4 mb-0">{{ $kedutaanBesar->format_undangan }}</p>
        @else
            <p class="badge bg-primary-lt fs-4 mb-0">Belum ada catatan format undangan.</p>
        @endif
        {{-- format undangan --}}

        <div class="hr-text hr-text-start">Diplomasi</div>
        <div class="datagrid align-items-center">
            <div class="datagrid-item">
                <div class="datagrid-content d-flex align-items-center">
                    <span class="flag flag-md flag-country-{{ $kedutaanBesar->kode_negara }} me-2"></span>
                    <span class="fw-bold">{{ $kedutaanBesar->nama_negara }}</span>
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

        <div class="hr-text hr-text-start">Lokasi</div>
        <div class="datagrid align-items-center">
            <div class="datagrid-item">
                <div class="datagrid-title">Alamat</div>
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
            <div class="datagrid-item">
                <div class="datagrid-title"></div>
                <div class="datagrid-content"></div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title"></div>
                <div class="datagrid-content"></div>
            </div>
        </div>

        <div class="hr-text hr-text-start">Peta</div>
        @if ($kedutaanBesar->latitude && $kedutaanBesar->longitude)
            <div id="peta-lokasi" style="height: 450px; width: 100%; border-radius: 4px;"></div>
        @else
            <p class="text-secondary mb-0">Koordinat lokasi belum tersedia.</p>
        @endif

    </div>
    <div class="card-footer">
        {{-- <small class="text-danger">Diakses pada {{ now()->format('d M Y, H:i') }} WIB</small> --}}
    </div>
    {{-- card-footer --}}
</div>
{{-- card --}}
