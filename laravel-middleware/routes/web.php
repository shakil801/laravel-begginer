<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',function(){
    return view('home');
})->middleware('isAuthenticate');

Route::get('/login',function(){
    return view('login');
});
