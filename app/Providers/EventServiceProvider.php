<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Events\OrderPlaced;
use App\Events\OrderReceived;
use App\Listeners\MergeCartAfterLogin;
use App\Listeners\RemoveCartItemAfterOrder;
use App\Listeners\CreateRatingAfterReceivedOrder;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            MergeCartAfterLogin::class,
        ],
        OrderPlaced::class => [
            RemoveCartItemAfterOrder::class,
        ],
        OrderReceived::class => [
            CreateRatingAfterReceivedOrder::class,
        ],
    ];
}
