<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\ExceptionHandlingMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([ExceptionHandlingMiddleware::class])->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


Route::middleware([ExceptionHandlingMiddleware::class, 'auth:sanctum'])->group(function () { 
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

