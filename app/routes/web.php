<?php

use Illuminate\Support\Facades\Route;
use Spatie\RouteAttributes\RouteRegistrar;

Route::middleware('web')->group(function () {
    (new RouteRegistrar(app()->router))
        ->useRootNamespace('App\\Http\\Controllers') ;
        
});