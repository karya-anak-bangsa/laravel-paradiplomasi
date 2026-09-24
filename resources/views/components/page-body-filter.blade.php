@props(['statusOptions' => [], 'tahunOptions' => []])

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
                </form>
            </div>
        </div>
        {{-- card --}}
    </div>
    {{-- col --}}
</div>
{{-- row --}}
