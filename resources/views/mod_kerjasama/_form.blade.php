<div class="row">
    <div class="col-lg-12 mb-3">
        <x-form-input-select
            label="Nama Negara"
            name="id_kedutaan_besar"
            :options="$kedutaanBesar->pluck('nama_negara', 'id_kedutaan_besar')->toArray()"
            :value="$kerjasama->id_kedutaan_besar ?? null"
            :searchable="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Kerjasama"
            name="kerjasama"
            rows="10"
            :value="$kerjasama->kerjasama ?? null" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            :value="$kerjasama->rangkuman ?? null" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$kerjasama->catatan ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Diterima"
            name="tanggal_diterima"
            type="date"
            :value="optional($kerjasama->tanggal_diterima ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Selesai"
            name="tanggal_selesai"
            type="date"
            hint="Jika kerjasama masih berjalan, harap kosongkan tanggal selesai."
            :value="optional($kerjasama->tanggal_selesai ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Triwulan Kerjasama"
            name="triwulan_kerjasama"
            hint="Periode triwulan saat kerjasama ini diterima/dicatat."
            :options="\App\Models\Kerjasama::TRIWULAN_OPTIONS"
            :value="$kerjasama->triwulan_kerjasama ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Status Kerjasama"
            name="status_kerjasama"
            :options="\App\Models\Kerjasama::STATUS_OPTIONS"
            :value="$kerjasama->status_kerjasama ?? null" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('kerjasama.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>
