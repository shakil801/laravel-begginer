<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Route::get('/',[TodoController::class,'index'])->name('home');
Route::post('/todo-add',[TodoController::class,'add_todo'])->name('todo.add');
Route::post('/completed',[TodoController::class,'completed']);
Route::post('/delete',[TodoController::class,'delete']);
