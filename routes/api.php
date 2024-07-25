<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use App\Http\Middleware\JwtCheckToken;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);

Route::middleware(JwtCheckToken::class)->group(function () {
    Route::resource('business', BusinessController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('people', PeopleController::class);
    Route::resource('tag', TagController::class);
    Route::resource('tasks', TaskController::class);
});