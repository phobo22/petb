<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;
use DateTime;

class ReviewPolicy
{
    /**
     * Create a new policy instance.
     */
    public function rating(User $user, Review $review) {
        $createdAt = new DateTime($review->created_at);
        $expiredAt = $createdAt->modify('+20 seconds');

        return $review->user->is($user) && (new DateTime() < $expiredAt);
    }
}
