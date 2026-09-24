<div class="row row-cards mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="card-title">{{ $title }}</span>
                @isset($actions)
                    <div class="card-actions">{{ $actions }}</div>
                @endisset
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-vcenter border-top datatable">
                        <thead>{{ $thead }}</thead>
                        <tbody>{{ $tbody }}</tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-danger"><x-waktu-akses /></small>
            </div>
        </div>
        {{-- card --}}
    </div>
    {{-- col --}}
</div>
{{-- row --}}
