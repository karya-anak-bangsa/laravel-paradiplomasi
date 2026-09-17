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
