<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderReceived;
use App\Services\ReviewService;

class CreateRatingAfterReceivedOrder
{
    /**
     * Create the event listener.
     */
    public function __construct(private ReviewService $reviewService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderReceived $event): void
    {
        $order = $event->order;
        $this->reviewService->createRating($order);
    }
}
