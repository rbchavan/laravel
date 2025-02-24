<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Where;

class UserPostController extends Controller
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

    #[Get(uri: '/user/posts/{id}', name: 'user.posts.index')]
    #[Where('id', '\d+')]
    public function getUserPosts($id)
    {

        $user = User::withCount('posts')->findOrFail($id);
        $posts = $user->posts()->latest()->paginate(10);

        return view('user_posts.index', compact('user', 'posts'));
    }
}
