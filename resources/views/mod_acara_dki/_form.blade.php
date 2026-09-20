<div class="row">
    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Acara DKI"
            name="acara_dki"
            rows="10"
            :value="$acaraDki->acara_dki ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            :value="$acaraDki->rangkuman ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$acaraDki->catatan ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Diterima"
            name="tanggal_diterima"
            type="date"
            :value="optional($acaraDki->tanggal_diterima ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Selesai"
            name="tanggal_selesai"
            type="date"
            hint="Jika acara masih berjalan, harap kosongkan tanggal selesai."
            :value="optional($acaraDki->tanggal_selesai ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Awal Pelaksanaan"
            name="tanggal_awal_pelaksanaan"
            type="date"
            :value="optional($acaraDki->tanggal_awal_pelaksanaan ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Akhir Pelaksanaan"
            name="tanggal_akhir_pelaksanaan"
            type="date"
            :value="optional($acaraDki->tanggal_akhir_pelaksanaan ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Triwulan Acara DKI"
            name="triwulan_acara_dki"
            hint="Periode triwulan saat acara DKI ini diterima/dicatat."
            :options="\App\Models\AcaraDKI::TRIWULAN_OPTIONS"
            :value="$acaraDki->triwulan_acara_dki ?? null" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Status Acara DKI"
            name="status_acara_dki"
            :options="\App\Models\AcaraDKI::STATUS_OPTIONS"
            :value="$acaraDki->status_acara_dki ?? null" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('acara-dki.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>
