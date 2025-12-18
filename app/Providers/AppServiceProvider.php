<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\CartItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-profile', function (User $user, UserProfile $profile) {
            return $profile->user->is($user);
        });

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $cart = $user->cart;
                $productCount = CartItem::where('cart_id', $cart->id)->count();
                $view->with([
                    'productCount' => $productCount,
                    'username' => $user->profile->firstname,
                ]);
            } else {
                $view->with('productCount', 0);
            }
        });
    }
}
