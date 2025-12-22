<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Services\CartService;

class CartItemController extends Controller
{
    public function index(Request $request, CartService $cartService) {
        $cart = $cartService->resolve($request);
        $cartData = $cartService->processData($cart);

        return view('cart.index', [
            'items' => $cartData['items'],
            'totalPrice' => $cartData['totalPrice'],
        ]);
    }

    public function store(Request $request, CartService $cartService) {
        $request->validate([
            'quantity' => 'required|integer',
            'product_id' => 'required|integer',
        ]);

        // get cart and add product
        $cart = $cartService->resolve($request);
        $cartService->addProduct($cart, $request->product_id, $request->quantity);
        
        return back()->with('success', 'Item is added to cart !!');
    }

    public function update(string $method, CartItem $cartItem) {
        if ($method === 'minus') {
            if ($cartItem->quantity === 1) {
                $cartItem->delete();
            } else {
                $cartItem->decrement('quantity');
            }
            return back();
        }

        $cartItem->increment('quantity');
        return back();
    }

    public function destroy(CartItem $cartItem) {
        $cartItem->delete();
        return back()->with('success', 'Remove items successfully !!');
    }
}
