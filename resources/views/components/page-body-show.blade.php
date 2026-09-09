<div class="row row-cards mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">{{ $title }}</h3>
                @isset($headerRight)
                    <div class="d-flex align-items-center">
                        {{ $headerRight }}
                    </div>
                @endisset
            </div>
            <div class="card-body">
                {{ $slot }}
            </div>
            <div class="card-footer"></div>
        </div>
        {{-- card --}}
    </div>
    {{-- col --}}
</div>
{{-- row --}}
