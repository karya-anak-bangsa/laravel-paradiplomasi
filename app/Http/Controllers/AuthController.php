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
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $daftarAkun = [
            'admin@mail.com' => [
                'password' => '2026paradiplomasi2026',
                'nama'     => 'Administrator',
            ],
            'guest@mail.com' => [
                'password' => '2026paradiplomasi2026',
                'nama'     => 'Tamu',
            ],
        ];

        $akun = $daftarAkun[$request->email] ?? null;

        if ($akun && $akun['password'] === $request->password) {
            $request->session()->regenerate();
            session([
                'auth_email' => $request->email,
                'auth_nama'  => $akun['nama'],
            ]);

            return redirect()->route('dashboard.index');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau kata sandi salah.']);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
