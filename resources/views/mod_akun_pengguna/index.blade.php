@extends('template.app')

{{-- content --}}
@section('nav-pengaturan', 'active')
@section('page-header')
    <x-page-header title="Akun Pengguna" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-table title="Daftar Akun Pengguna (Placeholder)">
        <x-slot name="thead">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Status</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            <tr>
                <td>Admin Sistem</td>
                <td>admin@paradiplomasi-jakarta.id</td>
                <td><span class="badge bg-red-lt">Administrator</span></td>
                <td class="text-center"><span class="badge bg-success-lt">Aktif</span></td>
            </tr>
            <tr>
                <td>Perwakilan Kemlu RI</td>
                <td>kemlu@paradiplomasi-jakarta.id</td>
                <td><span class="badge bg-purple-lt">Kementerian Luar Negeri</span></td>
                <td class="text-center"><span class="badge bg-success-lt">Aktif</span></td>
            </tr>
            <tr>
                <td>Kepala Biro KSD</td>
                <td>kabiro.ksd@jakarta.go.id</td>
                <td><span class="badge bg-blue-lt">Kepala Biro KSD</span></td>
                <td class="text-center"><span class="badge bg-success-lt">Aktif</span></td>
            </tr>
            <tr>
                <td>Kabag Kerja Sama Luar Negeri</td>
                <td>kabag.ksln@jakarta.go.id</td>
                <td><span class="badge bg-azure-lt">Kepala Bagian Kerja Sama Luar Negeri</span></td>
                <td class="text-center"><span class="badge bg-success-lt">Aktif</span></td>
            </tr>
            <tr>
                <td>Kasubbag Fasilitasi Korps Diplomatik</td>
                <td>kasubbag.fkd@jakarta.go.id</td>
                <td><span class="badge bg-cyan-lt">Kepala Sub Bagian Fasilitasi Korps Diplomatik</span></td>
                <td class="text-center"><span class="badge bg-success-lt">Aktif</span></td>
            </tr>
            <tr>
                <td>OPD DKI Jakarta</td>
                <td>opd@jakarta.go.id</td>
                <td><span class="badge bg-teal-lt">Organisasi Perangkat Daerah DKI Jakarta</span></td>
                <td class="text-center"><span class="badge bg-success-lt">Aktif</span></td>
            </tr>
            <tr>
                <td>Tamu Biro KSD</td>
                <td>tamu@paradiplomasi-jakarta.id</td>
                <td><span class="badge bg-secondary-lt">Tamu Biro KSD</span></td>
                <td class="text-center"><span class="badge bg-success-lt">Aktif</span></td>
            </tr>
        </x-slot>
    </x-page-body-table>
@endsection
