<div class="row">
    <div class="col-lg-12 mb-3">
        <x-form-input-select
            label="Nama Negara"
            name="id_kedutaan_besar"
            :options="$kedutaanBesar->pluck('nama_negara', 'id_kedutaan_besar')->toArray()"
            :value="$audiensi->id_kedutaan_besar ?? null"
            :searchable="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Topik"
            name="topik"
            rows="10"
            :value="$audiensi->topik ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            :value="$audiensi->rangkuman ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$audiensi->catatan ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Diterima"
            name="tanggal_diterima"
            type="date"
            :value="optional($audiensi->tanggal_diterima ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Selesai"
            name="tanggal_selesai"
            type="date"
            hint="Jika audiensi masih berjalan, harap kosongkan tanggal selesai."
            :value="optional($audiensi->tanggal_selesai ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Triwulan Audiensi"
            name="triwulan_audiensi"
            hint="Periode triwulan saat audiensi ini diterima/dicatat."
            :options="\App\Models\Audiensi::TRIWULAN_OPTIONS"
            :value="$audiensi->triwulan_audiensi ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Status Audiensi"
            name="status_audiensi"
            :options="\App\Models\Audiensi::STATUS_OPTIONS"
            :value="$audiensi->status_audiensi ?? null" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('audiensi.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>
