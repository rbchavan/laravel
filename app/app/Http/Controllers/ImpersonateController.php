<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class ImpersonateController extends Controller
{

    #[Post(uri: '/impersonate', name: 'impersonate.start')]
    public function impersonate(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        Auth::user()->impersonate($user);
        return redirect()->back();
    }
    #[Post(uri: '/stop/impersonate', name: 'impersonate.leave')]
    public function stopImpersonate()
    {
        Auth::user()->leaveImpersonation();
        return redirect()->back();
    }
}
