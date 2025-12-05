<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::all();
    return view('home', ['products' => $products]);
})->name('home');
