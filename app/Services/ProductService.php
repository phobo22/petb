<?php

namespace App\Services;

use App\Models\Product;

class ProductService {
    public function getRating(Product $product) {
        $reviews = $product->reviewss;
        if (count($reviews) === 0) {
            return 0;
        }

        $rating = 0;
        foreach ($reviews as $review) {
            $rating += $review->rating;
        }

        return (int)($rating / count($reviews));
    }
}
