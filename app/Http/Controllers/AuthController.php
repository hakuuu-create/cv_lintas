<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('media.dashboard');
        }
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        // 1. Validasi Input Form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->has('remember');

        // 2. Proses Autentikasi Ke Database
        if (Auth::attempt($credentials, $remember)) {
            // ID Session diperbarui demi keamanan
            $request->session()->regenerate();

            // AMBIL DATA USER (Pastikan dipanggil di DALAM blok IF setelah dipastikan sukses login)
            $user = Auth::user();

            // Jika user ditemukan dan memiliki kolom role 'admin'
            if ($user && $user->role === 'admin') {
                // Sinkronisasi otomatis ke tabel Spatie jika belum terdaftar
                \Spatie\Permission\Models\Role::findOrCreate('admin');

                if (!$user->hasRole('admin')) {
                    $user->assignRole('admin');
                }
            }

            // Redirect ke dashboard tujuan
            return redirect()->intended('/dashboard');
        }

        // 3. Jika login gagal (Kredensial salah), lempar balik ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Kredensial yang Anda masukkan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing.index');
    }
}