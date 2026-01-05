<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderPlaced;
use App\Services\CartService;
use App\Models\Order;

class RemoveCartItemAfterOrder
{
    /**
     * Create the event listener.
     */
    public function __construct(private CartService $cartService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {   
        $user = $event->order->user;
        $orderDetails = $event->order->details;

        $productsId = [];
        foreach($orderDetails as $item) {
            $productsId[] = $item->product_id;
        }

        $this->cartService->removeItemAfterOrder($user, $productsId);
    }
}
