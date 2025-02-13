<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;

class MyController extends Controller
{
    #[Get('/profile')]
    public function profile()
    {
        return view('profile');
    }
}
