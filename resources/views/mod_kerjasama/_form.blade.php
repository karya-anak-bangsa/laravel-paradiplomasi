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
        <select class="form-select border-dark tom-select" name="id_mitra" id="id_mitra">
            <option value="" selected>Pilih tipe mitra terlebih dahulu</option>
        </select>
        @error('id_mitra')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Kerjasama"
            name="kerjasama"
            rows="10"
            :value="$kerjasama->kerjasama ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Rangkuman"
            name="rangkuman"
            rows="10"
            :value="$kerjasama->rangkuman ?? null"
            :wysiwyg="true" />
    </div>

    <div class="col-lg-12 mb-3">
        <x-form-input-textarea
            label="Catatan"
            name="catatan"
            rows="10"
            hint="Harap masukan link dokumen dibagian catatan."
            :value="$kerjasama->catatan ?? null"
            :wysiwyg="true" />
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

@php
    // Saat edit: id_mitra + tipe mitra yang sudah tersimpan (dari relasi
    // mitra yang sudah di-eager-load di controller), untuk pre-select
    // kedua dropdown. @json() tidak reliable untuk ekspresi match()
    // multi-baris, jadi dihitung dulu di sini lalu di-@json() sebagai
    // variabel biasa.
    $tipeMitraAwalPhp = match (true) {
        isset($kerjasama) && $kerjasama->mitra?->kedutaanBesar => 'kedutaan_besar',
        isset($kerjasama) && $kerjasama->mitra?->misiAsingAsean => 'misi_asing_asean',
        isset($kerjasama) && $kerjasama->mitra?->misiPermanenAsean => 'misi_permanen_asean',
        default => null,
    };
@endphp

@push('scripts')
    <script>
        (function() {
            // Data mitra per tipe, dikirim controller lewat $kedutaanBesar /
            // $misiAsingAsean / $misiPermanenAsean (masing-masing berisi
            // id_mitra dan nama_negara).
            const daftarMitraPerTipe = {
                kedutaan_besar: @json($kedutaanBesar->map(fn($m) => ['value' => (string) $m->id_mitra, 'text' => $m->nama_negara])),
                misi_asing_asean: @json($misiAsingAsean->map(fn($m) => ['value' => (string) $m->id_mitra, 'text' => $m->nama_negara])),
                misi_permanen_asean: @json($misiPermanenAsean->map(fn($m) => ['value' => (string) $m->id_mitra, 'text' => $m->nama_negara])),
            };

            // Saat edit: id_mitra + tipe mitra yang sudah tersimpan, untuk
            // pre-select kedua dropdown.
            const idMitraTerpilih = @json($kerjasama->id_mitra ?? null);
            const tipeMitraAwal = @json($tipeMitraAwalPhp);

            const selectTipe = document.getElementById('tipe_mitra_pilihan');
            const selectMitra = document.getElementById('id_mitra');
            let tomSelectMitra = null;

            function isiDropdownMitra(tipe, preselectValue) {
                if (!tomSelectMitra) return;

                tomSelectMitra.clear(true);
                tomSelectMitra.clearOptions();

                if (!tipe || !daftarMitraPerTipe[tipe]) {
                    tomSelectMitra.disable();
                    return;
                }

                tomSelectMitra.enable();
                daftarMitraPerTipe[tipe].forEach(function(mitra) {
                    tomSelectMitra.addOption(mitra);
                });
                tomSelectMitra.refreshOptions(false);

                if (preselectValue) {
                    tomSelectMitra.setValue(preselectValue, true);
                }
            }

            selectTipe.addEventListener('change', function() {
                isiDropdownMitra(this.value, null);
            });

            function tungguTomSelect() {
                // Tom Select di-init global via DOMContentLoaded (lihat
                // template/app.blade.php); tunggu sampai instance-nya siap
                // sebelum kita kendalikan opsinya dari sini.
                if (selectMitra.tomselect) {
                    tomSelectMitra = selectMitra.tomselect;

                    if (tipeMitraAwal) {
                        selectTipe.value = tipeMitraAwal;
                        isiDropdownMitra(tipeMitraAwal, idMitraTerpilih);
                    } else {
                        isiDropdownMitra(null, null);
                    }
                } else {
                    setTimeout(tungguTomSelect, 50);
                }
            }

            tungguTomSelect();
        })();
    </script>
@endpush
