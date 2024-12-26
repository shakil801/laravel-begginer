<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',function(){
    return view('home');
})->middleware('isAuthenticate');

Route::get('/login',function(){
    return view('login');
});
Route::post('/login',[LoginController::class,'post_login'])->name('post.login');

Route::get('/register',[RegisterController::class,'showRegistrationForm']);
Route::post('register', [RegisterController::class, 'register'])->name('register');


Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/dashboard',function(){
    return view('dashboard');
})->name('dashboard')->middleware(['auth','verified']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');