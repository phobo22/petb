<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query();

        if ($request->category) {
            $query->category($request->category);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        $products = $query
            ->filter([
                'dog' => $request->dog,
                'cat' => $request->cat, 
                'price' => $request->price,
                'rating' => $request->rating,
                ])
            ->paginate(12);

        return view('products.index', [
            'products' => $products,
            'dog' => $request->dog,
            'cat' => $request->cat,
            'sort' => $request->price === 'asc' ? 'Price: Low to High' : (
                        $request->price === 'desc' ? 'Price: High to Low' : (
                        $request->rating === 'asc' ? 'Rating: Low to High' : (
                        $request->rating === 'desc' ? 'Rating: High to Low' : ''
            ))),
        ]);
    }

    public function show(Product $product) {
        $query = Product::query();
        //$query->search($product->name);
        $query->category($product->category);

        $relatedProducts = $query->whereNot('id', $product->id)->paginate(8);

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
