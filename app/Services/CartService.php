<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartService {
    public function resolve(Request $request) {
        if (Auth::check()) {
            $user = $request->user();
            $cart = $user->cart()->with('items.product')->first();
            return $cart;
        }

        $cartToken = $request->cookie('cart_token');
        if (!$cartToken) {
            return null;
        }

        $cart = Cart::where('cart_token', $cartToken)->with('items.product')->first();
        return $cart;
    }

    public function processData($cart) {
        if ($cart !== null) {
            $cartItems = $cart->items;

            if ($cartItems !== null) {
                $totalPrice = 0;
                foreach ($cartItems as $item) {
                    $item['subtotal'] = bcmul($item->product->price, $item->quantity, 2);
                    $totalPrice += $item['subtotal'];
                }

                return ['items' => $cartItems, 'totalPrice' => $totalPrice,];
            }
        }

        return ['items' => null, 'totalPrice' => 0];
    }

    public function addProduct($cart, $productId, $quantity) {
        if ($cart !== null) {
            $cartItems = $cart->items;
            $existingItem = $cartItems->firstWhere('product_id', $productId);
            
            // if item is existed in cart
            if ($existingItem) {
                $existingItem->increment('quantity', $quantity);
                return;
            }
            
            // if item is not existed in cart
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);

            return;
        }
        
        $cartToken = Str::uuid()->toString();
        $newCart = Cart::create(['cart_token' => $cartToken]);
        Cookie::queue('cart_token', $cartToken, 10, null, null, false, true);

        CartItem::create([
            'cart_id' => $newCart->id,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);

        return;
    }

    public function mergeCart(User $user) {
        $cartToken = FacadesRequest::cookie('cart_token');
        
        if (!$cartToken) return;

        $guestCart = Cart::where('cart_token', $cartToken)->with('items')->first();
        if (count($guestCart->items) === 0) {
            Cookie::queue(Cookie::forget('cart_token'));
            $guestCart->delete();
            return;
        }

        $userCart = $user->cart()->with('items')->first();
        foreach ($guestCart->items as $item) {
            $existing = $userCart->items->where('product_id', $item->product_id)->first();

            if ($existing) {
                $existing->increment('quantity', $item->quantity);
            } else {
                $item->cart_id = $userCart->id;
                $item->save();
            }
        }

        Cookie::queue(Cookie::forget('cart_token'));
        $guestCart->delete();
        return;
    }

    public function removeItemAfterOrder(User $user, array $productsId) {
        $user->cart->items()->whereIn('product_id', $productsId)->delete();
        return;
    }

}
