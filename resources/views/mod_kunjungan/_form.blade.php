<div class="row">
    <div class="col-lg-6 mb-3">
        <label class="form-label" for="tipe_mitra_pilihan">Tipe Mitra</label>
        <select class="form-select border-dark" id="tipe_mitra_pilihan">
            <option value="" selected>Pilih tipe mitra</option>
            <option value="kedutaan_besar">Kedutaan Besar</option>
            <option value="misi_asing_asean">Misi Asing untuk ASEAN</option>
            <option value="misi_permanen_asean">Misi Permanen Negara ASEAN</option>
        </select>
        <small class="form-text">Pilih tipe mitra terlebih dahulu untuk menampilkan daftar negaranya.</small>
    </div>

    <div class="col-lg-6 mb-3">
        <label class="form-label" for="id_mitra">Nama Negara</label>
        <select class="form-select border-dark" name="id_mitra" id="id_mitra" disabled>
            <option value="" selected>Pilih tipe mitra terlebih dahulu</option>

            <optgroup label="Kedutaan Besar" data-tipe-mitra="kedutaan_besar" hidden>
                @foreach ($kedutaanBesar as $mitra)
                    <option value="{{ $mitra->id_mitra }}" @selected(old('id_mitra', $kunjungan->id_mitra ?? null) == $mitra->id_mitra)>
                        {{ $mitra->nama_negara }}
                    </option>
                @endforeach
            </optgroup>

            <optgroup label="Misi Asing untuk ASEAN" data-tipe-mitra="misi_asing_asean" hidden>
                @foreach ($misiAsingAsean as $mitra)
                    <option value="{{ $mitra->id_mitra }}" @selected(old('id_mitra', $kunjungan->id_mitra ?? null) == $mitra->id_mitra)>
                        {{ $mitra->nama_negara }}
                    </option>
                @endforeach
            </optgroup>

            <optgroup label="Misi Permanen Negara ASEAN" data-tipe-mitra="misi_permanen_asean" hidden>
                @foreach ($misiPermanenAsean as $mitra)
                    <option value="{{ $mitra->id_mitra }}" @selected(old('id_mitra', $kunjungan->id_mitra ?? null) == $mitra->id_mitra)>
                        {{ $mitra->nama_negara }}
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

@php
    $tipeMitraAwal = match (true) {
        isset($kunjungan) && $kunjungan->mitra?->kedutaanBesar => 'kedutaan_besar',
        isset($kunjungan) && $kunjungan->mitra?->misiAsingAsean => 'misi_asing_asean',
        isset($kunjungan) && $kunjungan->mitra?->misiPermanenAsean => 'misi_permanen_asean',
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
