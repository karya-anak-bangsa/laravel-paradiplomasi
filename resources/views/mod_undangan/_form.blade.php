<div class="row">
    <div class="col-lg-12 mb-3">
        <x-form-input-select
            label="Nama Negara"
            name="id_kedutaan_besar"
            :options="$kedutaanBesar->pluck('nama_negara', 'id_kedutaan_besar')->toArray()"
            :value="$undangan->id_kedutaan_besar ?? null"
            :searchable="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Acara"
            name="acara"
            rows="10"
            :value="$undangan->acara ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            :value="$undangan->rangkuman ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$undangan->catatan ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Diterima"
            name="tanggal_diterima"
            type="date"
            :value="optional($undangan->tanggal_diterima ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Selesai"
            name="tanggal_selesai"
            type="date"
            hint="Jika undangan masih berjalan, harap kosongkan tanggal selesai."
            :value="optional($undangan->tanggal_selesai ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Triwulan Undangan"
            name="triwulan_undangan"
            hint="Periode triwulan saat undangan ini diterima/dicatat."
            :options="\App\Models\Undangan::TRIWULAN_OPTIONS"
            :value="$undangan->triwulan_undangan ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Status Undangan"
            name="status_undangan"
            :options="\App\Models\Undangan::STATUS_OPTIONS"
            :value="$undangan->status_undangan ?? null" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('undangan.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>
