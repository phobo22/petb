<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/test/{ver}', [HomeController::class, 'test'])->name('test');


Route::get('/products/{category}', [ProductController::class, 'index'])->name('category');
Route::get('/products', [ProductController::class, 'index'])->name('products');