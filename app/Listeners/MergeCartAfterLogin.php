<?php

namespace App\Listeners;

use App\Services\CartService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;

class MergeCartAfterLogin
{
    public function __construct(private CartService $cartService) {}

    public function handle(Login $event)
    {
        $this->cartService->mergeCart($event->user);
    }
}
