<?php

namespace App\Http\Controllers;

use App\Jobs\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class RegisterController extends Controller
{
    #[Get(uri: '/register', name: 'register.index')]
    public function register()
    {


        return view('auth.register');
    }

    #[Post(uri: '/register', name: 'register.store')]
    public function storeNewUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->assignRole('user');
        $user->save();

        WelcomeEmail::dispatch($user);

        return redirect()->route('login');
    }
}
