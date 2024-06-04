<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/d',[DashboardController::class,'index']);
Route::get('/signup',[AuthController::class,'signup'])->name('signup');
Route::post('/signup',[AuthController::class,'signup_attempt'])->name('signup.post');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'login_attempt'])->name('login.post');
Route::post('/logout',[AuthController::class,'logout']);
Route::get('/check-remember-me', [AuthController::class, 'checkRememberMeToken']);
