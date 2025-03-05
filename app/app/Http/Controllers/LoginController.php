<?php

namespace App\Http\Controllers;

use App\Rules\RecaptchaV3;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'g-recaptcha-response' => ['required', new RecaptchaV3('submit')],
        ]);

        $credentials = Arr::only($validated, ['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->two_factor_enabled) {
                session(['2fa:user:id' => $user->id]);
                Auth::logout();
                return redirect()->route('2fa.verifyForm');
            }
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
