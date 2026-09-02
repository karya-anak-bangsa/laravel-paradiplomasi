<div class="card">
    <div class="card-body py-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">{{ $title }}</h2>
            </div>
            <div class="col-auto">
                @if ($action && session('auth_role') === 'admin')
                    <a class="btn btn-success" href="{{ route($action) }}">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Data
                    </a>
                @elseif ($backRoute)
                    <a class="btn btn-secondary" href="{{ route($backRoute) }}">
                        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
