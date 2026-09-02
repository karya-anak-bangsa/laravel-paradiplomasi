<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // deklarasi akun admin + guest (hardcode dulu, belum ada tabel pengguna)
        $daftarAkun = [
            'admin@mail.com' => [
                'password' => '2026paradiplomasi2026',
                'role' => 'admin',
                'nama' => 'Administrator',
            ],
            'guest@mail.com' => [
                'password' => '2026paradiplomasi2026',
                'role' => 'guest',
                'nama' => 'Tamu',
            ],
        ];

        $akun = $daftarAkun[$request->email] ?? null;

        // cek kondisi jika benar
        if ($akun && $akun['password'] === $request->password) {
            session([
                'auth_email' => $request->email,
                'auth_role' => $akun['role'],
                'auth_nama' => $akun['nama'],
            ]);
            return redirect()->route('dashboard.index');
        }

        // jika salah, ulangi (kembali ke form login dengan pesan error, email tetap terisi)
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau kata sandi salah.']);
    }

    public function logout(Request $request)
    {
        session()->flush();

        return redirect()->route('login');
    }
}
