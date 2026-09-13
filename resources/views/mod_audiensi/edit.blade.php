@extends('template.app')

{{-- content --}}
@section('nav-audiensi', 'active')
@section('page-header')
    <x-page-header
        title="Modul Audiensi">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Audiensi</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('audiensi.update', $audiensi->id_audiensi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- kedutaan besar --}}
                        <div class="hr-text hr-text-start">Kedutaan Besar</div>
                        <div class="mb-3">
                            <label class="form-label">Negara</label>
                            <select name="id_kedutaan_besar" class="form-select">
                                <option value="" disabled>-- Pilih Kedutaan Besar --</option>
                                @foreach ($kedutaanBesar as $item)
                                    <option value="{{ $item->id_kedutaan_besar }}" {{ old('id_kedutaan_besar', $audiensi->id_kedutaan_besar) == $item->id_kedutaan_besar ? 'selected' : '' }}>{{ $item->nama_negara }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- kedutaan besar --}}

                        {{-- status & jadwal --}}
                        <div class="hr-text hr-text-start">Status & Jadwal</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Triwulan</label>
                                <select name="triwulan_audiensi" class="form-select">
                                    <option value="TW I" {{ old('triwulan_audiensi', $audiensi->triwulan_audiensi) == 'TW I' ? 'selected' : '' }}>TW I</option>
                                    <option value="TW II" {{ old('triwulan_audiensi', $audiensi->triwulan_audiensi) == 'TW II' ? 'selected' : '' }}>TW II</option>
                                    <option value="TW III" {{ old('triwulan_audiensi', $audiensi->triwulan_audiensi) == 'TW III' ? 'selected' : '' }}>TW III</option>
                                    <option value="TW IV" {{ old('triwulan_audiensi', $audiensi->triwulan_audiensi) == 'TW IV' ? 'selected' : '' }}>TW IV</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Diterima</label>
                                <input type="date" name="tanggal_diterima" class="form-control" value="{{ old('tanggal_diterima', optional($audiensi->tanggal_diterima)->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', optional($audiensi->tanggal_selesai)->format('Y-m-d')) }}">
                                <small class="form-hint text-danger">Kosongkan jika audiensi masih berjalan.</small>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Status Audiensi</label>
                                <select name="status_audiensi" class="form-select">
                                    <option value="Berjalan" {{ old('status_audiensi', $audiensi->status_audiensi) == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                                    <option value="Selesai" {{ old('status_audiensi', $audiensi->status_audiensi) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Tunda" {{ old('status_audiensi', $audiensi->status_audiensi) == 'Tunda' ? 'selected' : '' }}>Tunda</option>
                                    <option value="Batal" {{ old('status_audiensi', $audiensi->status_audiensi) == 'Batal' ? 'selected' : '' }}>Batal</option>
                                    <option value="Regret" {{ old('status_audiensi', $audiensi->status_audiensi) == 'Regret' ? 'selected' : '' }}>Regret</option>
                                </select>
                            </div>
                        </div>
                        {{-- status & jadwal --}}

                        {{-- detail audiensi --}}
                        <div class="hr-text hr-text-start">Detail Audiensi</div>
                        <div class="mb-3">
                            <label class="form-label">Topik</label>
                            <textarea name="topik" class="form-control" rows="5" placeholder="Tuliskan topik audiensi">{{ old('topik', $audiensi->topik) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rangkuman</label>
                            <textarea name="rangkuman" class="form-control" rows="12" placeholder="Rangkuman singkat audiensi">{{ old('rangkuman', $audiensi->rangkuman) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="12" placeholder="Catatan tambahan (opsional)">{{ old('catatan', $audiensi->catatan) }}</textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">File Dokumen</label>
                            <input type="file" name="file_dokumen" class="form-control">
                            <small class="form-hint text-danger">Ukuran file maksimal 25MB.</small>
                            @if ($audiensi->file_dokumen)
                                <small class="form-hint d-block">File saat ini: {{ basename($audiensi->file_dokumen) }}</small>
                            @endif
                        </div>
                        {{-- detail audiensi --}}

                        {{-- kontak pic --}}
                        <div class="hr-text hr-text-start">Kontak PIC</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama PIC</label>
                                <input type="text" name="nama_pic" class="form-control" placeholder="Nama penanggung jawab" value="{{ old('nama_pic', $audiensi->nama_pic) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor PIC</label>
                                <input type="text" name="nomor_pic" class="form-control" placeholder="Nomor kontak penanggung jawab" value="{{ old('nomor_pic', $audiensi->nomor_pic) }}">
                            </div>
                        </div>
                        {{-- kontak pic --}}

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('audiensi.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-rotate-left me-1"></i>Batal
                            </a>
                            <a href="{{ route('audiensi.index') }}" class="btn btn-success">
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
