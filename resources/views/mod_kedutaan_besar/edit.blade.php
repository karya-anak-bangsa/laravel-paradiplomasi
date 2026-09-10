@extends('template.app')

{{-- content --}}
@section('nav-mitra-kami', 'active')
@section('page-header')
    <x-page-header
        title="Modul Kedutaan Besar">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Kedutaan Besar</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('kedutaan-besar.update', $kedutaanBesar->id_kedutaan_besar) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- diplomasi --}}
                        <div class="hr-text hr-text-start">Diplomasi</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Kode Negara</label>
                                <input type="text" name="kode_negara" class="form-control" placeholder="Contoh: id" maxlength="2" value="{{ old('kode_negara', $kedutaanBesar->kode_negara) }}">
                                <small class="form-hint text-danger">Kode ISO 2 huruf (huruf kecil), dipakai untuk ikon bendera.</small>
                            </div>
                            <div class="col-md-9">
                                <label class="form-label">Nama Negara</label>
                                <input type="text" name="nama_negara" class="form-control" placeholder="Nama negara" value="{{ old('nama_negara', $kedutaanBesar->nama_negara) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Kedutaan (ID)</label>
                                <input type="text" name="nama_kedutaan_besar_id" class="form-control" placeholder="Nama kedutaan besar dalam Bahasa Indonesia" value="{{ old('nama_kedutaan_besar_id', $kedutaanBesar->nama_kedutaan_besar_id) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Kedutaan (EN)</label>
                                <input type="text" name="nama_kedutaan_besar_en" class="form-control" placeholder="Nama kedutaan besar dalam Bahasa Inggris" value="{{ old('nama_kedutaan_besar_en', $kedutaanBesar->nama_kedutaan_besar_en) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Diplomat</label>
                                <input type="text" name="nama_diplomat" class="form-control" placeholder="Nama duta besar/diplomat" value="{{ old('nama_diplomat', $kedutaanBesar->nama_diplomat) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jabatan Diplomat</label>
                                <input type="text" name="jabatan_diplomat" class="form-control" placeholder="Jabatan diplomat" value="{{ old('jabatan_diplomat', $kedutaanBesar->jabatan_diplomat) }}">
                            </div>
                        </div>
                        {{-- diplomasi --}}

                        {{-- format undangan --}}
                        <div class="hr-text hr-text-start">Format Undangan</div>
                        <div class="mb-0">
                            <textarea name="format_undangan" class="form-control" rows="4" placeholder="Tuliskan format undangan resmi untuk kedutaan ini">{{ old('format_undangan', $kedutaanBesar->format_undangan) }}</textarea>
                        </div>
                        {{-- format undangan --}}

                        {{-- lokasi --}}
                        <div class="hr-text hr-text-start">Lokasi</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap" value="{{ old('alamat', $kedutaanBesar->alamat) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan', $kedutaanBesar->kelurahan) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $kedutaanBesar->kecamatan) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control" value="{{ old('kota', $kedutaanBesar->kota) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', $kedutaanBesar->kode_pos) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Latitude</label>
                                <input type="text" name="latitude" class="form-control" placeholder="Contoh: -6.1751" value="{{ old('latitude', $kedutaanBesar->latitude) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="longitude" class="form-control" placeholder="Contoh: 106.8650" value="{{ old('longitude', $kedutaanBesar->longitude) }}">
                            </div>
                        </div>
                        {{-- lokasi --}}

                        {{-- kontak --}}
                        <div class="hr-text hr-text-start">Kontak</div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Telepon Kantor</label>
                                <input type="text" name="telepon_kantor" class="form-control" placeholder="Contoh: 021-1234567, 021-7654321" value="{{ old('telepon_kantor', $kedutaanBesar->telepon_kantor) }}">
                                <small class="form-hint text-danger">Pisahkan dengan koma jika lebih dari satu nomor.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Kantor</label>
                                <input type="text" name="email_kantor" class="form-control" placeholder="Contoh: info@kedutaan.go.id, protokol@kedutaan.go.id" value="{{ old('email_kantor', $kedutaanBesar->email_kantor) }}">
                                <small class="form-hint text-danger">Pisahkan dengan koma jika lebih dari satu email.</small>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Website</label>
                                <input type="text" name="website" class="form-control" placeholder="https://" value="{{ old('website', $kedutaanBesar->website) }}">
                            </div>
                        </div>
                        {{-- kontak --}}

                        {{-- status --}}
                        <div class="hr-text hr-text-start">Status</div>
                        <div class="mb-0">
                            <label class="form-label">Status Data</label>
                            <select name="is_active" class="form-select">
                                <option value="1" {{ old('is_active', $kedutaanBesar->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', $kedutaanBesar->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                        {{-- status --}}

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('kedutaan-besar.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-rotate-left me-1"></i>Batal
                            </a>
                            <a href="{{ route('kedutaan-besar.index') }}" class="btn btn-success">
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
