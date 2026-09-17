{{--
    Partial grid "Mitra Paling Aktif" untuk satu tipe mitra.
    Variabel yang harus dikirim via @include(..., [...]):
    - $daftarMitra   : Collection hasil withCount + total_aktivitas (lihat DashboardController)
    - $labelNamaResmi: nama kolom nama resmi pada model subtype (misal 'nama_kedutaan_besar_id')
--}}
<div class="row row-cards">
    @forelse ($daftarMitra as $mitra)
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="flag flag-md flag-country-{{ $mitra->kode_negara }}"></span>
                        </div>
                        <div class="col-auto">
                            <div class="fw-semibold">{{ $mitra->total_aktivitas }} Catatan Data</div>
                            <div class="text-secondary">{{ $mitra->{$labelNamaResmi} }}</div>
                        </div>
                    </div>
                </div>
                {{-- card-body --}}
            </div>
            {{-- card --}}
        </div>
        {{-- col --}}
    @empty
        <div class="col-12 text-center text-secondary py-3">
            Belum ada riwayat diplomasi yang tercatat.
        </div>
    @endforelse
</div>
{{-- row --}}
