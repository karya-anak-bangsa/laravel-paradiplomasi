<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-flag me-1"></i>
            Mitra Diplomatik Paling Aktif
        </h3>
    </div>
    <div class="card-body">
        <div class="row row-cards">
            @forelse ($mitraAktif as $kedutaan)
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="flag flag-md flag-country-{{ $kedutaan->kode_negara }}"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="fw-semibold">{{ $kedutaan->total_aktivitas }} Catatan Data</div>
                                    <div class="text-secondary">{{ $kedutaan->nama_negara }}</div>
                                </div>
                            </div>
                        </div>
                        {{--     card-body --}}
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
    </div>
    {{-- card-body --}}
</div>
{{-- card --}}
