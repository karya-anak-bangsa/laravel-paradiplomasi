{{--
    Partial grid "Mitra Paling Aktif".
    Variabel yang harus dikirim via @include(..., [...]):
    - $daftarMitra : Collection objek dengan kode_negara, nama_resmi, url_profil, total_aktivitas (lihat DashboardController)

    Seluruh kartu jadi area klik ke halaman profil + Riwayat Diplomasi mitranya
    lewat `stretched-link` — pola yang sama dengan x-stat-card. Penanda bisa
    diklik saat hover: kartu terangkat + berbayang (kelas bawaan Tabler
    `card-link card-link-pop`), garis tepi & nama mitra berwarna primary.
--}}
@push('styles')
    <style>
        .kartu-mitra-aktif:hover {
            border-color: var(--tblr-primary);
        }

        /* !important: .text-secondary & .text-reset bawaan Bootstrap juga !important */
        .kartu-mitra-aktif:hover .nama-mitra-aktif,
        .kartu-mitra-aktif:hover .nama-mitra-aktif a {
            color: var(--tblr-primary) !important;
        }
    </style>
@endpush

<div class="row row-cards">
    @forelse ($daftarMitra as $mitra)
        <div class="col-lg-3 d-flex align-items-stretch">
            <div class="card card-link card-link-pop kartu-mitra-aktif w-100">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <span class="flag flag-md flag-country-{{ $mitra->kode_negara }} flex-shrink-0 me-2"></span>
                        <div>
                            <div class="fw-semibold">{{ $mitra->total_aktivitas }} Catatan Data</div>
                            <div class="text-secondary nama-mitra-aktif" style="min-height: 2.5rem; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;">
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
