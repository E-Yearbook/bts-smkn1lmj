<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        // Rate Limiter: Maksimal 5 kali percobaan
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->with('error', "Terlalu banyak percobaan login. Silakan coba lagi dalam $seconds detik.");
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            RateLimiter::hit($throttleKey);
            return back()->with('error', 'Email tidak terdaftar.');
        }

        // Logic login berdasarkan role
        // 'password' di form akan diisi NIS jika role user, dan password biasa jika admin
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            RateLimiter::clear($throttleKey);

            return redirect()->intended('/dashboard'); // Sesuaikan route dashboardmu
        }

        RateLimiter::hit($throttleKey);
        return back()->with('error', 'Login gagal! Periksa kembali Email dan Password/NIS anda.');
    }
}
