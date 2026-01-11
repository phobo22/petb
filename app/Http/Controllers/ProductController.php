<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index(Request $request, ProductService $productService) {
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
                ])
            ->paginate(12);
            
        foreach($products as $product) {
            $product['rating'] = $productService->getRating($product);
        }

        return view('products.index', [
            'products' => $products,
            'dog' => $request->dog,
            'cat' => $request->cat,
            'sort' => $request->price === 'asc' ? 'Price: Low to High' : (
                        $request->price === 'desc' ? 'Price: High to Low' : ''),
        ]);
    }

    public function show(Product $product, ProductService $productService) {
        $query = Product::query();
        $query->category($product->category);

        $relatedProducts = $query->whereNot('id', $product->id)->paginate(8);
        foreach($relatedProducts as $relatedProduct) {
            $relatedProduct['rating'] = $productService->getRating($relatedProduct);
        }

        $reviews = $product->reviewss()->with('user.profile')->get();
        foreach ($reviews as $review) {
            $review['username'] = $review->user->profile->firstname . ' ' . $review->user->profile->lastname;
        }

        return view('products.show', [
            'product' => $product,
            'reviews' => $reviews,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
