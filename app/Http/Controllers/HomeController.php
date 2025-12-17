<?php

namespace App\Http\Controllers;
use App\Models\Product;

class HomeController extends Controller
{
    public function index() {
        $clothProducts = Product::category('cloth')->paginate(8);
        $foodProducts = Product::category('food')->paginate(8);
        $toyProducts = Product::category('toy')->paginate(8);

        return view('home', [
            'cloth' => $clothProducts,
            'food' => $foodProducts,
            'toy' => $toyProducts,
        ]);
    }
}
