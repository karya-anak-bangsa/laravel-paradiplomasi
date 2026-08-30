<div class="row row-cards mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="card-title">{{ $title }}</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter datatable">
                        <thead>{{ $thead }}</thead>
                        <tbody>{{ $tbody }}</tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <small class="text-danger">Data Access {{ now()->format('Y/m/d - H:i') }} WIB</small>
            </div>
        </div>
        {{-- card --}}
    </div>
    {{-- col --}}
</div>
{{-- row --}}
