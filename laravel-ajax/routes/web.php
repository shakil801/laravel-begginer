<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('url-data',function(){
    return 'ajax-view';
})->name('data.url');
