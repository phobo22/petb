<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(string $category) {
        $query = Product::query();
        $query->category($category);
        $products = $query->paginate(4);
        return view('products', [
            'products' => $products,
            'fors' => null,
        ]);
    }
}
