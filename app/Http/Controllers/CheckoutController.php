<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\CartItem;

class CheckoutController extends Controller
{
    public function select(Request $request) {
        $cartItems = $request->input('cartItems', []);

        if (empty($cartItems)) {
            return back()->with('error', 'Please select at least one item');
        }

        Cookie::queue('cart_items_id', json_encode($cartItems), 10, null, null, false, true);
        return redirect()->route('checkout.preview');
    }

    public function preview(Request $request) {
        $user = $request->user();
        $userAddr = $user->shippingAddresses;
        if (count($userAddr) === 0) {
            return redirect()
                ->setIntendedUrl(route('checkout.preview'))
                ->route('address.create');
        }

        $cartItems = json_decode($request->cookie('cart_items_id'), true);

        if (empty($cartItems)) {
            return back()->with('error', 'Please select at least one item');
        }

        Cookie::queue(Cookie::forget('cart_items_id'));

        $items = CartItem::whereIn('id', $cartItems)->with('product')->get();
        $totalPrice = 0;

        foreach ($items as $item) {
            $item['subtotal'] = bcmul($item->quantity, $item->product->price, 2);
            $totalPrice += $item['subtotal'];
        };

        $userAddrInfo = $user->shippingAddresses;

        return view('checkout.preview', [
            'shippingInfo' => $userAddrInfo,
            'items' => $items,
            'totalPrice' => $totalPrice,
        ]);
    }
}
