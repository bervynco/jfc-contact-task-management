<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('app');
// })
// ->name('application');

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');