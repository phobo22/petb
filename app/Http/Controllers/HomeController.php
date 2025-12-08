<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function test(Request $req) {
        if ($req->ver) {
            $name = $req->name . $req->ver;
            $age = $req->age . $req->ver;
        }
        
        return view('test', [
            'name' => $name,
            'age' => $age,
        ]);
    }
}
