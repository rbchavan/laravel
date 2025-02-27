<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Where;


class UserPostController
{
    #[Post(uri: '/user/{id}/posts/create', name: 'user.posts.create')]
    public function createUserPosts(Request $request, int $id)
    {

        $validated = $request->validate([
            'title' => 'required|string|min:10|max:255',
            'content' => 'required|string|min:10|max:500',
        ]);



        $user = User::findOrFail($id);
        $user->posts()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    #[Get(uri: '/user/posts/{user}', name: 'user.posts.index',middleware:['can:manageUser,user'])]
    #[Where('id', '\d+')]
    public function getUserPosts(User $user)
    {


        $posts = $user->posts()->latest()->paginate(10);

        return view('user_posts.index', compact('user', 'posts'));
    }
}
