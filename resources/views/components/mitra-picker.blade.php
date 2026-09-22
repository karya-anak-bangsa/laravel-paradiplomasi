@props([
    'name' => 'id_mitra',
    'value' => null,
    'mitra' => null,
    'kedutaanBesar',
    'misiAsingAsean',
    'misiPermanenAsean',
    'nonPerwakilanNegaraAsing',
    'required' => true,
])

@php
    $nilaiTerpilih = old($name, $value);

    $tipeAwal = match ($mitra?->tipe_mitra) {
        \App\Enums\TipeMitra::KedutaanBesar => 'kedutaan_besar',
        \App\Enums\TipeMitra::MisiAsingAsean => 'misi_asing_asean',
        \App\Enums\TipeMitra::MisiPermanenAsean => 'misi_permanen_asean',
        \App\Enums\TipeMitra::NonPNA => 'non_pna',
        default => null,
    };

    $idTipe = 'tipe-mitra-pilihan-' . $name;
@endphp

<div class="col-lg-6 mb-3">
    <label class="form-label" for="{{ $idTipe }}">Tipe Mitra</label>
    <select class="form-select border-dark" id="{{ $idTipe }}">
        <option value="" selected>Pilih tipe mitra</option>
        <option value="kedutaan_besar">Kedutaan Besar</option>
        <option value="misi_asing_asean">Misi Asing untuk ASEAN</option>
        <option value="misi_permanen_asean">Misi Permanen Negara ASEAN</option>
        <option value="non_pna">Non Perwakilan Negara Asing</option>
    </select>
    <small class="form-text">Pilih tipe mitra terlebih dahulu untuk menampilkan daftar negaranya.</small>
</div>

<div class="col-lg-6 mb-3">
    <label class="form-label" for="{{ $name }}">@if ($required)<span class="text-danger">*</span>@endif Nama Mitra</label>
    <select class="form-select border-dark" name="{{ $name }}" id="{{ $name }}" disabled>
        <option value="">Pilih tipe mitra terlebih dahulu</option>
    </select>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

@push('scripts')
    <script>
        (function() {
            const selectTipe = document.getElementById(@json($idTipe));
            const selectMitra = document.getElementById(@json($name));

            const daftarMitraPerTipe = {
                kedutaan_besar: @json($kedutaanBesar->map(fn ($m) => ['id' => (string) $m->id_mitra, 'text' => $m->nama_negara])),
                misi_asing_asean: @json($misiAsingAsean->map(fn ($m) => ['id' => (string) $m->id_mitra, 'text' => $m->nama_negara])),
                misi_permanen_asean: @json($misiPermanenAsean->map(fn ($m) => ['id' => (string) $m->id_mitra, 'text' => $m->nama_negara])),
                non_pna: @json($nonPerwakilanNegaraAsing->map(fn ($m) => ['id' => (string) $m->id_mitra, 'text' => $m->nama_non_perwakilan_negara_asing])),
            };

            const $selectMitra = $(selectMitra);
            $selectMitra.select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Pilih tipe mitra terlebih dahulu',
            });

            function terapkanTipe(tipe, nilaiTerpilih) {
                $selectMitra.empty();
                (daftarMitraPerTipe[tipe] || []).forEach(function(opsi) {
                    $selectMitra.append(new Option(opsi.text, opsi.id, false, false));
                });
                $selectMitra.prop('disabled', !tipe);
                $selectMitra.val(nilaiTerpilih || null).trigger('change');
            }

            selectTipe.addEventListener('change', function() {
                terapkanTipe(this.value, null);
            });

            const tipeAwal = @json($tipeAwal);
            const nilaiAwal = @json($nilaiTerpilih !== null ? (string) $nilaiTerpilih : null);

            if (tipeAwal) {
                selectTipe.value = tipeAwal;
                terapkanTipe(tipeAwal, nilaiAwal);
            }
        })();
    </script>
@endpush
