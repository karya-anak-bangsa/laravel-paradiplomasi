{{--
    Partial grid "Mitra Paling Aktif".
    Variabel yang harus dikirim via @include(..., [...]):
    - $daftarMitra : Collection objek dengan kode_negara, nama_resmi, url_profil, total_aktivitas (lihat DashboardController)

    Seluruh kartu jadi area klik ke halaman profil + Riwayat Diplomasi mitranya
    lewat `stretched-link` — pola yang sama dengan x-stat-card.
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
                            <div class="text-secondary" style="min-height: 2.5rem; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;">
                                <a href="{{ $mitra->url_profil }}" class="text-reset text-decoration-none stretched-link">{{ $mitra->nama_resmi }}</a>
                            </div>
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
