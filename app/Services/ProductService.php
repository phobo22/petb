<?php

namespace App\Services;

use App\Models\Product;

class ProductService {
    public function getRating(Product $product) {
        $reviews = $product->reviews()->where('status', 'rated')->get();

        if (count($reviews) === 0) {
            return 0;
        }

        $rating = 0;
        foreach ($reviews as $review) {
            $rating += $review->rating;
        }

        return (int)($rating / count($reviews));
    }

    public function getProductSold(Product $product) {
        $orderDetails = $product->orderDetails()
                                ->whereHas('order', function ($query) {
                                    $query->where('status', 'done');
                                })
                                ->get();

        $productSoldQuantity = count($orderDetails);
        if ($productSoldQuantity >= 1000) {
            $productSoldQuantity = floor($productSoldQuantity / 1000);
            return $productSoldQuantity . 'k+';
        }

        return (string)$productSoldQuantity;


        // $a = OrderDetail::where('product_id', 4)->whereHas('order', function ($q) {
        //     $q->where('status', 'done');
        // })->get();
    }
}
