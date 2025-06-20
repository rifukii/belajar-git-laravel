<?php

use Illuminate\Support\Facades\Route;
use App\Models\Fasum;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    $fasums = Fasum::paginate(10);
    return view('hello', compact('fasums'));
});
