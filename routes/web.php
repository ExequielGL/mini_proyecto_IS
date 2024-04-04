<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('register', [AuthController::class, 'register'])->name('register');


Route::get('products', [ProductController::class, 'index'])->name('products');
