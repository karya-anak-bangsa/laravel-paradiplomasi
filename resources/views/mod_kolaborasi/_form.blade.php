<div class="row">
    <x-mitra-picker
        :value="$kolaborasi->id_mitra ?? null"
        :mitra="$kolaborasi->mitra ?? null"
        :kedutaan-besar="$kedutaanBesar"
        :misi-asing-asean="$misiAsingAsean"
        :misi-permanen-asean="$misiPermanenAsean"
        :non-perwakilan-negara-asing="$nonPerwakilanNegaraAsing" />

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Kolaborasi"
            name="kolaborasi"
            rows="10"
            :value="$kolaborasi->kolaborasi ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            :value="$kolaborasi->rangkuman ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$kolaborasi->catatan ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Diterima"
            name="tanggal_diterima"
            type="date"
            :value="optional($kolaborasi->tanggal_diterima ?? null)->format('Y-m-d')"
            :required="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-text
            label="Tanggal Selesai"
            name="tanggal_selesai"
            type="date"
            hint="Jika kolaborasi masih berjalan, harap kosongkan tanggal selesai."
            :value="optional($kolaborasi->tanggal_selesai ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Triwulan Kolaborasi"
            name="triwulan_kolaborasi"
            hint="Periode triwulan saat kolaborasi ini diterima/dicatat."
            :options="\App\Models\Kolaborasi::TRIWULAN_OPTIONS"
            :value="$kolaborasi->triwulan_kolaborasi ?? null"
            :required="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Status Kolaborasi"
            name="status_kolaborasi"
            :options="\App\Models\Kolaborasi::STATUS_OPTIONS"
            :value="$kolaborasi->status_kolaborasi ?? null"
            :required="true" />
    </div>

    <div class="col-lg-2 mb-3">
        <a href="{{ route('kolaborasi.index') }}" class="btn btn-secondary w-100">
            <i class="fa-solid fa-rotate-left me-2"></i>Kembali
        </a>
    </div>

    <div class="col-lg-2 mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa-solid fa-save me-2"></i>Simpan
        </button>
    </div>
</div>

