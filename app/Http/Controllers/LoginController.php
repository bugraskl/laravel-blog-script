<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        // Validasyon işlemi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kimlik bilgilerini doğrulama
        if (Auth::attempt($credentials)) {
            // Oturumu başlat ve kullanıcıyı giriş yapmış olarak tanımla
            $request->session()->regenerate();

            // Başarılı girişten sonra ana sayfaya yönlendirme
            return redirect('/')->with('success', 'Login successful!');
        }

        // Eğer kimlik bilgileri yanlışsa, hata mesajını döndür
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
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
