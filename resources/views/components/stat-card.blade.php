@props([
    'jumlah',
    'label',
    'ikon',
    'warna' => 'blue',
    'route' => null,
])

{{--
    Kartu angka ringkas untuk dashboard: avatar berikon di kiri, jumlah + label
    di kanan.

    Menggantikan 9 blok markup kembar di dashboard-akumulasi-kegiatan.blade.php
    (±20 baris masing-masing) yang dulu ditulis ulang per kartu — lihat CLAUDE.md
    Bagian 9.5.

    Kalau `route` diisi, seluruh kartu jadi area klik ke index modulnya lewat
    `stretched-link` — jadi tidak perlu menduplikasi markup kartu untuk versi
    tautan dan versi non-tautan.

    `h-100` menjaga semua kartu dalam satu baris tetap sama tinggi meski
    labelnya membungkus ke dua baris.
--}}

<div {{ $attributes->merge(['class' => 'd-flex align-items-stretch']) }}>
    <div class="card w-100 h-100">
        <div class="card-body">
            <div class="row align-items-center flex-nowrap">
                <div class="col-auto">
                    <span class="avatar bg-{{ $warna }}-lt">
                        <i class="fa-solid fa-{{ $ikon }}"></i>
                    </span>
                </div>
                <div class="col">
                    <div class="fw-semibold">{{ $jumlah }} Data</div>
                    <div class="text-secondary">
                        @if ($route)
                            <a href="{{ route($route) }}" class="text-reset text-decoration-none stretched-link">{{ $label }}</a>
                        @else
                            {{ $label }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- card-body --}}
    </div>
    {{-- card --}}
</div>
