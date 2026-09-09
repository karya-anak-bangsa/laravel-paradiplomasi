@extends('template.app')

{{-- content --}}
@section('nav-undangan', 'active')
@section('page-header')
    <x-page-header
        title="Modul Undangan">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Undangan</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('undangan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- kedutaan besar --}}
                        <div class="hr-text hr-text-start">Kedutaan Besar</div>
                        <div class="mb-3">
                            <label class="form-label">Negara</label>
                            <select name="id_kedutaan_besar" class="form-select">
                                <option value="" selected disabled>-- Pilih Kedutaan Besar --</option>
                                @foreach ($kedutaanBesar as $item)
                                    <option value="{{ $item->id_kedutaan_besar }}">{{ $item->nama_negara }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- kedutaan besar --}}

                        {{-- status & jadwal --}}
                        <div class="hr-text hr-text-start">Status & Jadwal</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Triwulan</label>
                                <select name="triwulan_undangan" class="form-select">
                                    <option value="TW I">TW I</option>
                                    <option value="TW II">TW II</option>
                                    <option value="TW III">TW III</option>
                                    <option value="TW IV">TW IV</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Diterima</label>
                                <input type="date" name="tanggal_diterima" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control">
                                <small class="form-hint text-danger">Kosongkan jika undangan masih berjalan.</small>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Status Undangan</label>
                                <select name="status_undangan" class="form-select">
                                    <option value="Berjalan">Berjalan</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Tunda">Tunda</option>
                                    <option value="Batal">Batal</option>
                                    <option value="Regret">Regret</option>
                                </select>
                            </div>
                        </div>
                        {{-- status & jadwal --}}

                        {{-- detail undangan --}}
                        <div class="hr-text hr-text-start">Detail Undangan</div>
                        <div class="mb-3">
                            <label class="form-label">Acara</label>
                            <textarea name="acara" class="form-control" rows="5" placeholder="Tuliskan acara undangan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rangkuman</label>
                            <textarea name="rangkuman" class="form-control" rows="12" placeholder="Rangkuman singkat undangan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="12" placeholder="Catatan tambahan (opsional)"></textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">File Dokumen</label>
                            <input type="file" name="file_dokumen" class="form-control">
                            <small class="form-hint text-danger">Ukuran file maksimal 25MB.</small>
                        </div>
                        {{-- detail undangan --}}

                        {{-- kontak pic --}}
                        <div class="hr-text hr-text-start">Kontak PIC</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama PIC</label>
                                <input type="text" name="nama_pic" class="form-control" placeholder="Nama penanggung jawab">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor PIC</label>
                                <input type="text" name="nomor_pic" class="form-control" placeholder="Nomor kontak penanggung jawab">
                            </div>
                        </div>
                        {{-- kontak pic --}}

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('undangan.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-rotate-left me-1"></i>Batal
                            </a>
                            <a href="{{ route('undangan.index') }}" class="btn btn-success">
                                <i class="fa-solid fa-save me-1"></i>Simpan
                            </a>
                        </div>

                    </form>

                </div>
            </div>
            {{-- card --}}
        </div>
        {{-- col --}}
    </div>
    {{-- row --}}

@endsection
