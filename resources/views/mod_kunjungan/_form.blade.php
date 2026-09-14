<div class="row">
    <div class="col-lg-12 mb-3">
        <x-form-input-select
            label="Nama Negara"
            name="id_kedutaan_besar"
            :options="$kedutaanBesar->pluck('nama_negara', 'id_kedutaan_besar')->toArray()"
            :value="$kunjungan->id_kedutaan_besar ?? null"
            :searchable="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Perihal"
            name="perihal"
            rows="10"
            :value="$kunjungan->perihal ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            :value="$kunjungan->rangkuman ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$kunjungan->catatan ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Diterima"
            name="tanggal_diterima"
            type="date"
            :value="optional($kunjungan->tanggal_diterima ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Selesai"
            name="tanggal_selesai"
            type="date"
            hint="Jika kunjungan masih berjalan, harap kosongkan tanggal selesai."
            :value="optional($kunjungan->tanggal_selesai ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Triwulan Kunjungan"
            name="triwulan_kunjungan"
            hint="Periode triwulan saat kunjungan ini diterima/dicatat."
            :options="\App\Models\Kunjungan::TRIWULAN_OPTIONS"
            :value="$kunjungan->triwulan_kunjungan ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Status Kunjungan"
            name="status_kunjungan"
            :options="\App\Models\Kunjungan::STATUS_OPTIONS"
            :value="$kunjungan->status_kunjungan ?? null" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>
