{{-- Slot opsional $actions: tombol di kanan header kartu, berseberangan dengan judul (sama dengan x-page-body-table) — mis. Ekspor pada kartu Riwayat Diplomasi profil mitra. --}}
<div class="row row-cards mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">{{ $title }}</h3>
                @isset($actions)
                    <div class="card-actions">{{ $actions }}</div>
                @endisset
            </div>
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
        {{-- card --}}
    </div>
    {{-- col --}}
</div>
{{-- row --}}
