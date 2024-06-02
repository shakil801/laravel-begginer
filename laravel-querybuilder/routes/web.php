<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


Route::get('/',[StudentController::class,'index'])->name('student');
Route::get('/cerate',[StudentController::class,'create'])->name('student.create');
Route::post('/save',[StudentController::class,'save'])->name('student.save');
Route::get('/edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::post('/update/{id}', [StudentController::class, 'update'])->name('student.update');
Route::get('/delete/{id}',[StudentController::class,'delete'])->name('student.delete');


