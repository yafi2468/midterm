<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('page.login');
});

route::get('/dashboard', function () {
    return view('page.dashboard');
})->middleware('auth');

route::get('/profile', function () {
    return view('page.profile');
})->middleware('auth');