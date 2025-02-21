<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Response;
use Spatie\RouteAttributes\Attributes\Get;

class PlaygroundController extends Controller
{
    #[Get(uri: '/play', name: 'playground.index')]
    public function profile(): Response

    {

        $user = User::findOrFail(10);
        $user->posts()->create([
            'title' => 'My Second Post',
            'content' => 'This is another post content.',
        ]);

        return new Response([
            'message' => 'Post created successfully',
        ]);
    }
}
