<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $password = $request->input('password');
        $password2 = $request->input('password2');

        // Şifrelerin uyuşması kontrolü
        if ($password != $password2) {
            return redirect('/register')
                ->withErrors(['password' => 'Passwords do not match']);
        }

        // E-posta adresinin geçerli olup olmadığını kontrolü
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect('/register')
                ->withErrors(['email' => 'Invalid email address']);
        }

        // Şifre uzunluk kontrolü
        if (strlen($password) < 8) {
            return redirect('/register')
                ->withErrors(['password' => 'Password must be at least 8 characters long']);
        }

        // Girilen email adresinin sistemde olup olmadığının kontrolü
        if (User::where('email', $email)->exists()) {
            return redirect('/register')
                ->withErrors(['email' => 'This email is already registered']);
        }

        // Girilen kullanıcı adının sistemde olup olmadığını kontrol edin
        if (User::where('name', $name)->exists()) {
            return redirect('/register')
                ->withErrors(['name' => 'This username is already taken']);
        }

        // Kullanıcıyı oluştur
        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => bcrypt($password),
        ]);

        if ($user) {
            return redirect('/login');
        }
    }

}
