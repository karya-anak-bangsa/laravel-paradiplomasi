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
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $daftarAkun = [
            'admin@mail.com' => [
                'password' => '2026paradiplomasi2026',
                'nama' => 'Administrator',
                'role' => 'admin',
            ],
            'guest@mail.com' => [
                'password' => '2026paradiplomasi2026',
                'nama' => 'Tamu Biro KSD',
                'role' => 'guest',
            ],
        ];

        $akun = $daftarAkun[$request->email] ?? null;

        if ($akun && $akun['password'] === $request->password) {
            $request->session()->regenerate();
            session([
                'auth_email' => $request->email,
                'auth_nama' => $akun['nama'],
                'auth_role' => $akun['role'],
            ]);

            return redirect()->route('dashboard.index');
        }

        // Pesan yang sama dipasang di kedua kolom supaya input email DAN password
        // sama-sama diberi border merah — pengguna tidak perlu ditebak-tebak mana
        // yang salah ketik (dan kita tidak membocorkan apakah emailnya terdaftar).
        // Input sengaja TIDAK dikembalikan (tanpa withInput) — kedua kolom kosong lagi.
        $pesan = 'Email atau kata sandi salah.';

        return back()->withErrors(['email' => $pesan, 'password' => $pesan]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
