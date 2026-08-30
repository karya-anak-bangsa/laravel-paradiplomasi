<div class="row align-items-center">
    <div class="col">
        <h2 class="page-title">{{ $title }}</h2>
    </div>
    <div class="col-auto">
        @if ($action)
            <a class="btn btn-success" href="{{ route($action) }}">
                <i class="fa-solid fa-plus me-1"></i>Tambah Data
            </a>
        @endif
    </div>
</div>
