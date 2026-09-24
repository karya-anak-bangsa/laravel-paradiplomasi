@extends('template.app')

{{-- content --}}
@section('nav-pengaturan', 'active')
@section('page-header')
    <x-page-header title="Restore Data" />
@endsection

{{--
    Daftar seluruh data yang sudah "dihapus" dari 16 modul (10 Mitra + 6 Riwayat
    Diplomasi). Datanya tidak pernah hilang dari database — tombol hapus di
    modul aslinya hanya menonaktifkan + men-soft-delete baris (lihat CLAUDE.md
    Bagian 9.3), sehingga admin bisa mengaktifkannya kembali dari halaman ini.

    Daftar modulnya diturunkan dari App\Enums\TipeMitra & App\Enums\ModulDiplomasi
    lewat App\Support\DataTerhapus — tidak ada nama modul yang ditulis di blade
    ini, jadi modul/jenis mitra baru otomatis ikut terpantau.
--}}

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        @foreach ($ringkasan as $grup)
            <x-stat-card
                class="col-lg-6"
                :jumlah="$grup->jumlah"
                :label="'Data '.$grup->label.' terhapus'"
                :ikon="$grup->ikon"
                :warna="$grup->warna" />
        @endforeach
    </div>
    {{-- row --}}

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" class="row g-2 align-items-end">
                        <div class="col-lg-12">
                            <label class="form-label mb-1">Modul</label>
                            <select name="modul" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Modul ({{ $ringkasan->sum('jumlah') }} data)</option>
                                @foreach ($ringkasan as $grup)
                                    <optgroup label="{{ $grup->label }}">
                                        @foreach ($grup->modul as $modul)
                                            <option value="{{ $modul->slug }}" @selected(request('modul') === $modul->slug)>
                                                {{ $modul->label }} ({{ $modul->jumlah }} data)
                                            </option>
                                        @endforeach
                                    </optgroup>
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

    @if ($baris->isEmpty())
        <div class="row row-cards mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fa-solid fa-inbox fa-2x text-secondary d-block mb-3"></i>
                        <p class="fw-bold mb-1">Tidak ada data terhapus</p>
                        <small class="text-secondary">
                            Seluruh data pada modul yang dipilih masih aktif. Data yang dihapus dari modul manapun akan muncul di sini dan bisa dipulihkan.
                        </small>
                    </div>
                </div>
                {{-- card --}}
            </div>
            {{-- col --}}
        </div>
        {{-- row --}}
    @else
        <x-page-body-table title="Daftar Data Terhapus — pulihkan satu per satu untuk mengaktifkannya kembali di modul asalnya">
            <x-slot name="thead">
                <tr>
                    <th data-orderable="true" style="width: 15%">Modul</th>
                    <th data-orderable="true" style="width: 40%">Data</th>
                    <th data-orderable="true" style="width: 15%" class="text-center">Tanggal Dibuat</th>
                    <th data-orderable="true" style="width: 20%" class="text-center">Tanggal Dihapus</th>
                    <th data-orderable="false" style="width: 10%" class="text-center">Aksi</th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($baris as $item)
                    <tr>
                        <td>
                            <span class="badge bg-{{ $item->warna }}-lt">
                                <i class="fa-solid fa-{{ $item->ikon }} me-1"></i>{{ $item->modul_label }}
                            </span>
                        </td>
                        <td>
                            <p class="fw-bold mb-0">{{ $item->identitas }}</p>
                            <small class="fst-italic text-primary">{{ $item->keterangan }}</small>
                        </td>
                        {{-- data-order: DataTables tidak bisa membaca "23 Sep 2026, 09:51 WIB"
                             sebagai tanggal sehingga mengurutkannya sebagai teks (angka hari
                             duluan, bulan & tahun terabaikan). Nilai ISO ini dipakai untuk
                             mengurutkan tanpa mengubah tampilan sel. --}}
                        <td class="text-center" data-order="{{ $item->dibuat_pada?->format('Y-m-d H:i:s') }}">{{ $item->dibuat_pada ? $item->dibuat_pada->format('d M Y, H:i').' WIB' : '-' }}</td>
                        <td class="text-center" data-order="{{ $item->dihapus_pada?->format('Y-m-d H:i:s') }}">
                            {{ $item->dihapus_pada ? $item->dihapus_pada->format('d M Y, H:i').' WIB' : '-' }}
                            <small class="d-block text-danger">{{ $item->dihapus_sejak ?? '-' }}</small>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('restore-data.update', [$item->grup, $item->modul_slug, $item->id]) }}"
                                method="post" class="confirm-submit d-inline" data-confirm="restore">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-icon btn-primary" title="Pulihkan data ini">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-page-body-table>
    @endif
@endsection
