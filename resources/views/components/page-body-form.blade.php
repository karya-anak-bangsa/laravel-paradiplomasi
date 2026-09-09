{{-- resources/views/components/page-body-form.blade.php --}}
<div class="row row-cards mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
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
