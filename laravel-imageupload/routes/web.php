<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;


Route::get('/', function () {
    return view('welcome');
});
Route::post('image/save',[UploadController::class,'upload'])->name('image.save');
