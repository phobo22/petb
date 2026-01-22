<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use DateTime;

class ReviewController extends Controller
{
    public function unrated(Request $request) {
        $threeDaysAgo = (new DateTime())->modify('-20 seconds');

        $user = $request->user();
        $reviews = $user->reviews()
                        ->with('product')
                        ->where('status', 'unrated')
                        ->where('created_at', '>', $threeDaysAgo)
                        ->paginate(5);

        foreach($reviews as $review) {
            $now = new DateTime();
            $createdAt = new DateTime($review->created_at);
            $diff = $createdAt->diff($now); 

            if ($diff->days > 1) {
                $review['rest_time'] = $diff->days . 'days';
            } 
            
            else {
                if ($diff->h > 1) $review['rest_time'] = $diff->h . ' hours';
                else $review['rest_time'] = $diff->i . ' minutes';
            }
        }
                    
        return view('review.index', ['reviews' => $reviews]);
    }

    public function rated(Request $request) {
        $user = $request->user();
        $reviews = $user->reviews()
                        ->with('product')
                        ->where('status', 'rated')
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
                    
        //return $reviews;
        return view('review.index', ['reviews' => $reviews]);
    }

    public function edit(Review $review) {
        return view('review.edit', ['review' => $review]);
    }

    public function update(Request $request, Review $review) {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'string|nullable',
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'status' => 'rated',
            'created_at' => new DateTime(),
        ]);

        $review->save();
        return redirect()->route('rating.rated');
    }
}
