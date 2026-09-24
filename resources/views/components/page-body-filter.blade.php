@props(['statusOptions' => [], 'tahunOptions' => [], 'modul' => null])

@php
    // Filter yang sedang aktif ikut dibawa ke tombol ekspor, supaya isi file
    // sama dengan tabel yang sedang dilihat.
    $filterAktif = array_filter(request()->only(['status', 'tahun']));
@endphp

<div class="row row-cards mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-lg">
                        <label class="form-label mb-1">Status</label>
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            @foreach ($statusOptions as $value => $label)
                                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg">
                        <label class="form-label mb-1">Tahun</label>
                        <select name="tahun" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            @foreach ($tahunOptions as $tahun)
                                <option value="{{ $tahun }}" @selected((string) request('tahun') === (string) $tahun)>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($modul)
                        <div class="col-lg-auto">
                            <div class="btn-list">
                                <a href="{{ route('ekspor.excel', ['modul' => $modul->slug(), ...$filterAktif]) }}" class="btn btn-success">
                                    <i class="fa-solid fa-file-excel me-2"></i>Excel
                                </a>
                                <a href="{{ route('ekspor.pdf', ['modul' => $modul->slug(), ...$filterAktif]) }}" class="btn btn-danger">
                                    <i class="fa-solid fa-file-pdf me-2"></i>PDF
                                </a>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        {{-- card --}}
    </div>
    {{-- col --}}
</div>
{{-- row --}}
