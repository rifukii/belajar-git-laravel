<?php

use Illuminate\Support\Facades\Route;
use App\Models\Fasum;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    $fasums = Fasum::all();
    return view('hello', compact('fasums'));
});

Route::get('/hello', function () {
    return view('hello');
});
