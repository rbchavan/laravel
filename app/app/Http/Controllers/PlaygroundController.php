<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Spatie\RouteAttributes\Attributes\Get;

class PlaygroundController extends Controller
{
    #[Get(uri: '/play', name: 'playground.index')]
    public function profile(): array
    {


        $array = [
            ['id' => 1, 'name' => 'Apple'],
            ['id' => 2, 'name' => 'Banana'],
            ['id' => 3, 'name' => 'Cherry'],
            ['id' => 4, 'name' => 'Date'],
        ];
        $firstItem = Arr::first($array, fn ($array) => $array['id'] == 4);
        
        if (!$firstItem) {
            abort(404);
        } 

        return $firstItem;
    }
}
