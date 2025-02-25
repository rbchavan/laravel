<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class LoginController extends Controller
{
    #[Get(uri: '/login', name: 'login')]
    public function login()
    {


        return view('auth.login');
    }


    #[Post(uri: '/login', name: 'login.verify')]
    public function loginVerify(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/users');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    #[Post(uri: '/logout', name: 'logout')]
    public function logout()
    {

        Auth::logout();
        return redirect()->route('login');
    }
}
