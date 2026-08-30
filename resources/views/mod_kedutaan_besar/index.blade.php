@extends('template.app')

@section('nav-kedutaan-besar', 'active')
@section('page-header')
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Data Kedutaan Besar</h2>
            <span class="text-secondary">Daftar perwakilan negara asing yang terdaftar</span>
        </div>
        <div class="col-auto">
            <a class="btn btn-success" href="{{-- route('kedutaan-besar.create') --}}">
                <i class="fa-solid fa-plus me-1"></i>Tambah Data
            </a>
        </div>
    </div>
@endsection

@section('page-content')

    {{-- <div class="row row-cards">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header"> </div>
                <div class="card-body"> </div>
                <div class="card-footer"> </div>
            </div>

        </div>
    </div> --}}

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-kedutaan-besar" class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kedutaan</th>
                            <th>Negara</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kedutaanBesar as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold">{{ $item->nama_negara }}</div>
                                    {{-- CEK: sesuaikan field nama, misal $item->nama_kedutaan --}}
                                </td>
                                <td>{{ $item->negara_negara }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    {{-- CEK: sesuaikan dengan accessor array telepon kamu --}}
                                    @if (!empty($item->telepon_kantor_array))
                                        {{ implode(', ', $item->telepon_kantor_array) }}
                                    @else
                                        <span class="text-secondary">-</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-list flex-nowrap justify-content-end">
                                        <a href="{{-- route('kedutaan-besar.show',$item->id) --}}"
                                            class="btn btn-sm btn-outline-primary" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{-- route('kedutaan-besar.edit',$item->id) --}}"
                                            class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{-- route('kedutaan-besar.destroy',$item->id) --}}"
                                            method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Sengaja dikosongkan: DataTables akan menampilkan pesan "No data available" --}}
                            {{-- bawaannya sendiri saat tbody kosong, jadi tidak perlu <tr> manual di sini. --}}
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#table-kedutaan-besar').DataTable({
                // Kolom "No" dan "Aksi" tidak perlu ikut logic sort DataTables:
                // - kolom 0 (No) urutannya harus tetap mengikuti urutan render server, bukan hasil sort
                // - kolom terakhir (Aksi) berisi tombol, sort di situ tidak bermakna
                columnDefs: [{
                    orderable: false,
                    targets: [0, 5]
                }],
                order: [], // tidak ada sort default, tampilkan sesuai urutan data dari server
                language: {
                    // DataTables default berbahasa Inggris; ini terjemahan Indonesia manual
                    // supaya tidak perlu load file bahasa terpisah dari CDN
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(disaring dari _MAX_ total data)',
                    zeroRecords: 'Data tidak ditemukan',
                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Selanjutnya',
                        previous: 'Sebelumnya'
                    }
                }
            });
        });

        // Konfirmasi sebelum hapus. Sengaja pakai confirm() bawaan browser dulu
        // (bukan modal Tabler/SweetAlert) supaya tidak menambah dependensi baru
        // di tengah proses migrasi ke DataTables ini. Bisa diganti nanti.
        document.querySelectorAll('.form-delete').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                if (!confirm('Yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
