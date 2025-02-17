<?php

namespace App\Http\Controllers;

use App\Models\User;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;

    
class MyController extends Controller
{
    #[Get('/users')]
    public function profile()
    {
        $users = User::all();

        return view('users', ['users' => $users]);
    }
}
