{{-- <div class="hr-text hr-text-start">Diplomasi</div> --}}
<div class="datagrid align-items-center mb-5">
    <div class="datagrid-item">
        <div class="datagrid-title">Format Undangan</div>
        <div class="datagrid-content">{{ $kedutaanBesar->format_undangan }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Bendera Negara</div>
        <div class="datagrid-content d-flex align-items-center">
            <span class="flag flag-md flag-country-{{ $kedutaanBesar->kode_negara }} me-2"></span>
            <span class="fw-bold">{{ $kedutaanBesar->nama_negara }}</span>
        </div>
    </div>
</div>
{{-- <div class="datagrid align-items-center mb-5">
    <div class="datagrid-item">
        <div class="datagrid-title">Kedutaan Besar (ID)</div>
        <div class="datagrid-content">{{ $kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Kedutaan Besar (EN)</div>
        <div class="datagrid-content">{{ $kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</div>
    </div>
</div> --}}
{{-- <div class="datagrid align-items-center mb-5">
    <div class="datagrid-item">
        <div class="datagrid-title">Nama Diplomat</div>
        <div class="datagrid-content">{{ $kedutaanBesar->nama_diplomat ?? '-' }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Jabatan Diplomat</div>
        <div class="datagrid-content">{{ $kedutaanBesar->jabatan_diplomat ?? '-' }}</div>
    </div>
</div> --}}
<div class="datagrid align-items-center mb-5">
    <div class="datagrid-item">
        <div class="datagrid-title">Kedutaan Besar</div>
        <div class="datagrid-content">
            <p class="fst-normal mb-0">{{ $kedutaanBesar->nama_kedutaan_besar_id ?? '-' }}</p>
            <small class="fst-italic text-primary mb-0">{{ $kedutaanBesar->nama_kedutaan_besar_en ?? '-' }}</small>
        </div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Diplomat</div>
        <div class="datagrid-content">
            <p class="fst-normal mb-0">{{ $kedutaanBesar->nama_diplomat ?? '-' }}</p>
            <small class="fst-italic text-primary mb-0">{{ $kedutaanBesar->jabatan_diplomat ?? '-' }}</small>
        </div>
    </div>
</div>
<div class="datagrid align-items-center mb-0">
    <div class="datagrid-item">
        <div class="datagrid-title">Email</div>
        <div class="datagrid-content">{{ $kedutaanBesar->email_kantor ?? '-' }}</div>
    </div>
    <div class="datagrid-item">
        <div class="datagrid-title">Telepon</div>
        <div class="datagrid-content">{{ $kedutaanBesar->telepon_kantor ?? '-' }}</div>
    </div>
</div>
