<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mobil; // Pastikan untuk mengimpor model Mobil

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Jika Anda ingin mengirim data mobil ke view
        $mobils = Mobil::all(); // Ambil data mobil dari database

        return view('auth.login', compact('mobils')); // Kirim variabel ke view
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); // Ganti dengan rute yang sesuai
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}