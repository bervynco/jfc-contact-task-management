<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeopleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('business', BusinessController::class);
Route::resource('category', CategoryController::class);
Route::resource('people', PeopleController::class);
Route::resource('tag', TagController::class);
Route::resource('tasks', TaskController::class);