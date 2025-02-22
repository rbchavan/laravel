<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\Get;

class PlaygroundController extends Controller
{
    #[Get(uri: '/play', name: 'playground.index')]
    public function profile(): View

    {
        $posts = Post::with('user')->simplePaginate(3);



        return view('playground', compact('posts'));
    }
}
