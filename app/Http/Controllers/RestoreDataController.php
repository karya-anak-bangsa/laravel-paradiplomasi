<?php

namespace App\Http\Controllers;

use App\Support\DataTerhapus;
use Illuminate\Http\Request;

/**
 * Modul Pengaturan Sistem > Restore Data — khusus admin.
 *
 * Tombol "hapus" di seluruh modul tidak pernah menghapus data secara permanen
 * (lihat CLAUDE.md Bagian 9.3): baris hanya dinonaktifkan dan di-soft-delete.
 * Controller ini adalah satu-satunya tempat data tersebut bisa diaktifkan
 * kembali, sehingga penghapusan yang dilakukan pengguna lain tetap dapat
 * dipulihkan oleh admin.
 *
 * Data dipulihkan SATU PER SATU (tidak ada aksi massal) supaya setiap pemulihan
 * melewati konfirmasi tersendiri.
 */
class RestoreDataController extends Controller
{
    public function index(Request $request)
    {
        return view('mod_restore_data.index', [
            'baris' => DataTerhapus::baris($request->input('modul')),
            'ringkasan' => DataTerhapus::ringkasan(),
        ]);
    }

    public function update(string $grup, string $modul, string $id)
    {
        $dipulihkan = DataTerhapus::pulihkan($grup, $modul, $id);

        return redirect()->route('restore-data.index')->with('notify', [
            'type' => 'success',
            'message' => 'Data '.$dipulihkan->modul.' "'.$dipulihkan->identitas.'" berhasil dipulihkan.',
        ]);
    }
}
