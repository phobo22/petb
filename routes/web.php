<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/{category}', [ProductController::class, 'index'])
    ->where('category', '[a-zA-Z]+')
    ->name('products.category');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->where('product', '[0-9]+')
    ->name('products.show');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login.page')->middleware('guest');
    Route::post('/login', 'handleLogin')->name('login.submit')->middleware('guest');

    Route::get('/register', 'register')->name('register.page')->middleware('guest');
    Route::post('/register', 'handleRegister')->name('register.submit')->middleware('guest');

    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(UserProfileController::class)->group(function () {
    Route::get('/user/{profile}', 'show')->name('profile.show')->middleware('auth');
    Route::get('/user/{profile}/edit', 'edit')->name('profile.edit')->middleware('auth');
    Route::put('/user/{profile}', 'update')->name('profile.update')->middleware('auth');
});