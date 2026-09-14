@extends('template.app')

{{-- content --}}
@section('nav-pengaturan', 'active')
@section('page-header')
    <x-page-header title="Riwayat Aktivitas" />
@endsection

{{-- content --}}
@section('page-content')
    <x-page-body-table title="Log Aktivitas Pengguna (Placeholder)">
        <x-slot name="thead">
            <tr>
                <th>Waktu</th>
                <th>Pengguna</th>
                <th>Aktivitas</th>
                <th>Modul</th>
            </tr>
        </x-slot>
        <x-slot name="tbody">
            <tr>
                <td>14 Sep 2026, 09:12 WIB</td>
                <td>Admin Sistem</td>
                <td>Login ke sistem</td>
                <td>-</td>
            </tr>
            <tr>
                <td>13 Sep 2026, 10:15 WIB</td>
                <td>Admin Sistem</td>
                <td>Menambahkan data Kerjasama baru</td>
                <td>Kerjasama</td>
            </tr>
            <tr>
                <td>13 Sep 2026, 11:47 WIB</td>
                <td>Kepala Biro KSD</td>
                <td>Melihat dashboard statistik</td>
                <td>Dashboard</td>
            </tr>
            <tr>
                <td>12 Sep 2026, 14:40 WIB</td>
                <td>Kepala Biro KSD</td>
                <td>Mengubah data Kedutaan Besar</td>
                <td>Kedutaan Besar</td>
            </tr>
            <tr>
                <td>12 Sep 2026, 15:30 WIB</td>
                <td>Kabag Kerja Sama Luar Negeri</td>
                <td>Mengubah status Kolaborasi menjadi Selesai</td>
                <td>Kolaborasi</td>
            </tr>
            <tr>
                <td>11 Sep 2026, 09:05 WIB</td>
                <td>Kabag Kerja Sama Luar Negeri</td>
                <td>Melihat detail Kolaborasi</td>
                <td>Kolaborasi</td>
            </tr>
            <tr>
                <td>11 Sep 2026, 13:20 WIB</td>
                <td>Kasubbag Fasilitasi Korps Diplomatik</td>
                <td>Mengubah jadwal Audiensi</td>
                <td>Audiensi</td>
            </tr>
            <tr>
                <td>10 Sep 2026, 16:22 WIB</td>
                <td>Kasubbag Fasilitasi Korps Diplomatik</td>
                <td>Menambahkan Undangan baru</td>
                <td>Undangan</td>
            </tr>
            <tr>
                <td>10 Sep 2026, 08:05 WIB</td>
                <td>Perwakilan Kemlu RI</td>
                <td>Melihat data Kunjungan</td>
                <td>Kunjungan</td>
            </tr>
            <tr>
                <td>09 Sep 2026, 17:45 WIB</td>
                <td>Perwakilan Kemlu RI</td>
                <td>Mengunduh laporan Riwayat Diplomasi</td>
                <td>Kedutaan Besar</td>
            </tr>
            <tr>
                <td>09 Sep 2026, 08:50 WIB</td>
                <td>Tamu Biro KSD</td>
                <td>Login ke sistem</td>
                <td>-</td>
            </tr>
            <tr>
                <td>08 Sep 2026, 10:30 WIB</td>
                <td>Tamu Biro KSD</td>
                <td>Melihat daftar Mitra PNA</td>
                <td>Kedutaan Besar</td>
            </tr>
            <tr>
                <td>08 Sep 2026, 14:10 WIB</td>
                <td>OPD DKI Jakarta</td>
                <td>Melihat jadwal Tanggal Penting</td>
                <td>Tanggal Penting</td>
            </tr>
            <tr>
                <td>07 Sep 2026, 11:00 WIB</td>
                <td>OPD DKI Jakarta</td>
                <td>Melihat detail Audiensi</td>
                <td>Audiensi</td>
            </tr>
            <tr>
                <td>07 Sep 2026, 09:25 WIB</td>
                <td>Admin Sistem</td>
                <td>Menambahkan Kunjungan baru</td>
                <td>Kunjungan</td>
            </tr>
            <tr>
                <td>06 Sep 2026, 16:55 WIB</td>
                <td>Kepala Biro KSD</td>
                <td>Mengubah data Kerjasama</td>
                <td>Kerjasama</td>
            </tr>
            <tr>
                <td>06 Sep 2026, 13:12 WIB</td>
                <td>Kabag Kerja Sama Luar Negeri</td>
                <td>Login ke sistem</td>
                <td>-</td>
            </tr>
            <tr>
                <td>05 Sep 2026, 10:40 WIB</td>
                <td>Kasubbag Fasilitasi Korps Diplomatik</td>
                <td>Menambahkan data Kolaborasi baru</td>
                <td>Kolaborasi</td>
            </tr>
            <tr>
                <td>05 Sep 2026, 08:15 WIB</td>
                <td>Perwakilan Kemlu RI</td>
                <td>Mengubah status Undangan menjadi Batal</td>
                <td>Undangan</td>
            </tr>
            <tr>
                <td>04 Sep 2026, 15:05 WIB</td>
                <td>Tamu Biro KSD</td>
                <td>Melihat dashboard statistik</td>
                <td>Dashboard</td>
            </tr>
        </x-slot>
    </x-page-body-table>
@endsection
