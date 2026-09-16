<div class="hr-text hr-text-start">Format Undangan</div>
@if ($misiAsingAsean->format_undangan)
    <p class="badge bg-primary-lt text-primary-lt-fg fs-4 mb-0">{{ $misiAsingAsean->format_undangan }}</p>
@else
    <p class="badge bg-primary-lt fs-4 mb-0">Belum ada catatan format undangan.</p>
@endif

<div class="hr-text hr-text-start">Diplomasi</div>
<div class="datagrid align-items-center">
    <div class="datagrid-item">
        <div class="datagrid-content d-flex align-items-center">
            <span class="flag flag-md flag-country-{{ $misiAsingAsean->kode_negara }} me-2"></span>
            <span class="fw-bold">{{ $misiAsingAsean->nama_negara }}</span>
        </div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Nama Misi Resmi</div>
        <div class="datagrid-content">{{ $misiAsingAsean->nama_misi_resmi ?? '-' }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Nama Diplomat</div>
        <div class="datagrid-content">{{ $misiAsingAsean->nama_diplomat ?? '-' }}</div>
    </div>
</div>

<div class="hr-text hr-text-start">Lokasi</div>
<div class="datagrid align-items-center">
    <div class="datagrid-item">
        <div class="datagrid-title">Alamat</div>
        <div class="datagrid-content">{{ $misiAsingAsean->alamat ?? '-' }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Kelurahan</div>
        <div class="datagrid-content">{{ $misiAsingAsean->kelurahan ?? '-' }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Kecamatan</div>
        <div class="datagrid-content">{{ $misiAsingAsean->kecamatan ?? '-' }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Kota</div>
        <div class="datagrid-content">{{ $misiAsingAsean->kota ?? '-' }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Kode Pos</div>
        <div class="datagrid-content">{{ $misiAsingAsean->kode_pos ?? '-' }}</div>
    </div>
</div>

<div class="hr-text hr-text-start">Kontak</div>
<div class="datagrid align-items-center">
    <div class="datagrid-item">
        <div class="datagrid-title">Telepon Kantor</div>
        <div class="datagrid-content">
            @forelse ($misiAsingAsean->telepon_kantor_array as $telepon)
                <div>{{ $telepon }}</div>
            @empty
                -
            @endforelse
        </div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Email Kantor</div>
        <div class="datagrid-content">
            @forelse ($misiAsingAsean->email_kantor_array as $email)
                <div>{{ $email }}</div>
            @empty
                -
            @endforelse
        </div>
    </div>
</div>
