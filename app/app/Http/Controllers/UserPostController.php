<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\RouteAttributes\Attributes\Get;

class UserPostController extends Controller
{
    #[Get(uri: '/user/posts/{id}', name: 'user.posts')]
    public function profile($id)
    {
        $user = User::withCount('posts')->findOrFail($id);
        $posts = $user->posts()->latest()->paginate(10);

        return view('user_posts', compact('user', 'posts'));
    }
}
