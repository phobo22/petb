<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Services\ProductService;

class HomeController extends Controller
{
    public function index(ProductService $productService) {
        $clothProducts = Product::category('cloth')->paginate(8);
        $foodProducts = Product::category('food')->paginate(8);
        $toyProducts = Product::category('toy')->paginate(8);

        foreach($clothProducts as $product) {
            $product['rating'] = $productService->getRating($product);
            $product['sales'] = $productService->getProductSold($product);
        }

        foreach($foodProducts as $product) {
            $product['rating'] = $productService->getRating($product);
            $product['sales'] = $productService->getProductSold($product);
        }

        foreach($toyProducts as $product) {
            $product['rating'] = $productService->getRating($product);
            $product['sales'] = $productService->getProductSold($product);
        }

        return view('home', [
            'cloth' => $clothProducts,
            'food' => $foodProducts,
            'toy' => $toyProducts,
        ]);
    }
}
