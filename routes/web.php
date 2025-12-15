<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PasswordResetController;

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
    Route::get('/user/{profile}', 'show')->name('profile.show')
        ->middleware('auth')
        ->can('view-profile', 'profile');

    Route::get('/user/{profile}/edit', 'edit')->name('profile.edit')
        ->middleware('auth')
        ->can('view-profile', 'profile');

    Route::put('/user/{profile}', 'update')->name('profile.update')
        ->middleware('auth')
        ->can('view-profile', 'profile');
});

Route::controller(PasswordResetController::class)->group(function () {
    Route::get('/forgot-password', 'forgot')
        ->middleware('guest')
        ->name('password.forgot');

    Route::post('/forgot-password', 'send')
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', 'reset')
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', 'update')
        ->middleware('guest')
        ->name('password.update');
});
