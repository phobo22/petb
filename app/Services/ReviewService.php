<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Review;
use DateTime;

class ReviewService {
    public function createRating(Order $order) {
        $items = $order->details;
        foreach ($items as $item) {
            Review::create([
                'user_id' => Auth::user()->id,
                'product_id' => $item->product_id,
                'created_at' => new DateTime(),
            ]);
        }
    }
}
