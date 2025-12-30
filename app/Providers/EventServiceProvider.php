<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Events\OrderPlaced;
use App\Listeners\MergeCartAfterLogin;
use App\Listeners\RemoveCartItemAfterOrder;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            MergeCartAfterLogin::class,
        ],
        OrderPlaced::class => [
            RemoveCartItemAfterOrder::class,
        ],
    ];
}
