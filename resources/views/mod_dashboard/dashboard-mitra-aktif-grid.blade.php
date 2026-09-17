{{--
    Partial grid "Mitra Paling Aktif" untuk satu tipe mitra.
    Variabel yang harus dikirim via @include(..., [...]):
    - $daftarMitra   : Collection hasil withCount + total_aktivitas (lihat DashboardController)
    - $labelNamaResmi: nama kolom nama resmi pada model subtype (misal 'nama_kedutaan_besar_id')
--}}
<div class="row row-cards">
    @forelse ($daftarMitra as $mitra)
        <div class="col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <span class="flag flag-md flag-country-{{ $mitra->kode_negara }} flex-shrink-0 me-2"></span>
                        <div>
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
