<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CartItem;

class CartItemController extends Controller
{
    private function getCartItems(Request $request) {
        if (Auth::check()) {
            $user = $request->user();
            $cart = $user->cart()->with('items.product')->first();
            return $cart->items;
        }
    }

    public function index(Request $request) {
        $cartItems = $this->getCartItems($request);
        foreach ($cartItems as $item) {
            $item['subtotal'] = bcmul($item->product->price, $item->quantity, 2);
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['subtotal'];
        }

        return view('cart.index', [
            'items' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        $cartItems = $this->getCartItems($request);
        $existingItem = $cartItems->firstWhere('product_id', $request->product_id);
        
        if ($existingItem) {
            $existingItem->increment('quantity', $request->quantity);
            return back()->with('success', 'Item is added to cart !!');
        } 

        else {
            CartItem::create([
                'cart_id' => $request->user()->cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
            return back()->with('success', 'Item is added to cart !!');
        }
    }

    public function update(string $method, CartItem $cartItem) {
        if ($method === 'minus') {
            if ($cartItem->quantity === 1) {
                $cartItem->delete();
            } else {
                $cartItem->decrement('quantity');
            }
        }

        $cartItem->increment('quantity');
        return back();
    }
}
