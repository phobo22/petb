<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

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
