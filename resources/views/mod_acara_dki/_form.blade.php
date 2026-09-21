<div class="row">
    <div class="col-lg-6 mb-3">
        <label class="form-label" for="tipe_mitra_pilihan">Tipe Mitra</label>
        <select class="form-select border-dark" id="tipe_mitra_pilihan">
            <option value="" selected>Pilih tipe mitra</option>
            <option value="kedutaan_besar">Kedutaan Besar</option>
            <option value="misi_asing_asean">Misi Asing untuk ASEAN</option>
            <option value="misi_permanen_asean">Misi Permanen Negara ASEAN</option>
            <option value="non_pna">Non Perwakilan Negara Asing</option>
        </select>
        <small class="form-text">Pilih tipe mitra terlebih dahulu untuk menampilkan daftar negaranya.</small>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="form-label" for="id_mitra"><span class="text-danger">*</span>Nama Mitra</label>
        <select class="form-select border-dark" name="id_mitra" id="id_mitra" disabled>
            <option value="" selected>Pilih tipe mitra terlebih dahulu</option>

            <optgroup label="Kedutaan Besar" data-tipe-mitra="kedutaan_besar" hidden>
                @foreach ($kedutaanBesar as $mitra)
                    <option value="{{ $mitra->id_mitra }}" @selected(old('id_mitra', $acaraDki->id_mitra ?? null) == $mitra->id_mitra)>
                        {{ $mitra->nama_negara }}
                    </option>
                @endforeach
            </optgroup>

            <optgroup label="Misi Asing untuk ASEAN" data-tipe-mitra="misi_asing_asean" hidden>
                @foreach ($misiAsingAsean as $mitra)
                    <option value="{{ $mitra->id_mitra }}" @selected(old('id_mitra', $acaraDki->id_mitra ?? null) == $mitra->id_mitra)>
                        {{ $mitra->nama_negara }}
                    </option>
                @endforeach
            </optgroup>

            <optgroup label="Misi Permanen Negara ASEAN" data-tipe-mitra="misi_permanen_asean" hidden>
                @foreach ($misiPermanenAsean as $mitra)
                    <option value="{{ $mitra->id_mitra }}" @selected(old('id_mitra', $acaraDki->id_mitra ?? null) == $mitra->id_mitra)>
                        {{ $mitra->nama_negara }}
                    </option>
                @endforeach
            </optgroup>

            <optgroup label="Non Perwakilan Negara Asing" data-tipe-mitra="non_pna" hidden>
                @foreach ($nonPerwakilanNegaraAsing as $mitra)
                    <option value="{{ $mitra->id_mitra }}" @selected(old('id_mitra', $acaraDki->id_mitra ?? null) == $mitra->id_mitra)>
                        {{ $mitra->nama_non_perwakilan_negara_asing }}
                    </option>
                @endforeach
            </optgroup>
        </select>
        @error('id_mitra')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Acara DKI"
            name="acara_dki"
            rows="10"
            :value="$acaraDki->acara_dki ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            :value="$acaraDki->rangkuman ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$acaraDki->catatan ?? null"
            :required="true"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Tanggal Diterima"
            name="tanggal_diterima"
            type="date"
            :value="optional($acaraDki->tanggal_diterima ?? null)->format('Y-m-d')"
            :required="true" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Tanggal Selesai"
            name="tanggal_selesai"
            type="date"
            hint="Jika acara masih berjalan, harap kosongkan tanggal selesai."
            :value="optional($acaraDki->tanggal_selesai ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-3 mb-3">
        <x-form-input-text
            label="Tanggal Awal Pelaksanaan"
            name="tanggal_awal_pelaksanaan"
            type="date"
            :value="optional($acaraDki->tanggal_awal_pelaksanaan ?? null)->format('Y-m-d')" />
    </div>

    <div class="col-lg-3 mb-3">
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
            :value="$acaraDki->triwulan_acara_dki ?? null"
            :required="true" />
    </div>

    <div class="col-lg-6 mb-3">
        <x-form-input-select
            label="Status Acara DKI"
            name="status_acara_dki"
            :options="\App\Models\AcaraDKI::STATUS_OPTIONS"
            :value="$acaraDki->status_acara_dki ?? null"
            :required="true" />
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

@php
    $tipeMitraAwal = match (true) {
        isset($acaraDki) && $acaraDki->mitra?->kedutaanBesar => 'kedutaan_besar',
        isset($acaraDki) && $acaraDki->mitra?->misiAsingAsean => 'misi_asing_asean',
        isset($acaraDki) && $acaraDki->mitra?->misiPermanenAsean => 'misi_permanen_asean',
        isset($acaraDki) && $acaraDki->mitra?->nonPerwakilanNegaraAsing => 'non_pna',
        default => null,
    };
@endphp

@push('scripts')
    <script>
        (function() {
            const selectTipe = document.getElementById('tipe_mitra_pilihan');
            const selectMitra = document.getElementById('id_mitra');
            const optgroups = selectMitra.querySelectorAll('optgroup');

            function tampilkanOptgroupSesuaiTipe(tipe) {
                optgroups.forEach(function(optgroup) {
                    optgroup.hidden = optgroup.dataset.tipeMitra !== tipe;
                });

                if (tipe) {
                    selectMitra.disabled = false;
                } else {
                    selectMitra.disabled = true;
                    selectMitra.value = '';
                }
            }

            selectTipe.addEventListener('change', function() {
                selectMitra.value = '';
                tampilkanOptgroupSesuaiTipe(this.value);
            });

            const tipeMitraAwal = @json($tipeMitraAwal);
            if (tipeMitraAwal) {
                selectTipe.value = tipeMitraAwal;
                tampilkanOptgroupSesuaiTipe(tipeMitraAwal);
            }
        })();
    </script>
@endpush
