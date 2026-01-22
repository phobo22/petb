<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function select(Request $request) {
        if ($request->action === 'checkout') {
            $cartItems = $request->input('cartItems', []);

            if (empty($cartItems)) {
                return back()->with('error', 'Please select at least one item');
            }

            Cookie::queue('cart_items_id', json_encode($cartItems), 10, null, null, false, true);
            return redirect()->route('checkout.preview');
        }
        
        else {
            $validated = $request->validate([
                'product_id' => 'required',
                'quantity' => 'required|min:1|integer',
            ]);

            Cookie::queue('product', json_encode($validated), 10, null, null, false, true);
            return redirect()->route('checkout.preview');
        }
    }

    private function handleCheckout(Request $request) {
        $cartItems = json_decode($request->cookie('cart_items_id'), true);

        if (empty($cartItems)) {
            return back()->with('error', 'Please select at least one item');
        }

        Cookie::queue(Cookie::forget('cart_items_id'));

        $cartItems = CartItem::whereIn('id', $cartItems)->with('product')->get();
        $totalPrice = 0;

        $items = [];
        foreach ($cartItems as $item) {
            $item['subtotal'] = bcmul($item->quantity, $item->product->price, 2);
            $totalPrice += $item['subtotal'];

            $items[] = [
                'id' => $item->product->id,
                'name' => $item->product->name,
                'image' => $item->product->image,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'subtotal' => $item['subtotal'],
            ];
        };

        return ['items' => $items, 'totalPrice' => $totalPrice];
    }

    private function handleBuyNow(Request $request) {
        $dataFromCookie = json_decode($request->cookie('product'), true);
        Cookie::queue(Cookie::forget('product'));

        $product = Product::where('id', $dataFromCookie['product_id'])->first();
        $totalPrice = bcmul($dataFromCookie['quantity'], $product->price, 2);

        $items[] = [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'quantity' => $dataFromCookie['quantity'],
            'subtotal' => $totalPrice,
        ];

        return ['items' => $items, 'totalPrice' => $totalPrice];
    }

    public function preview(Request $request) {
        $user = $request->user();
        $userAddr = $user->shippingAddresses;

        if (count($userAddr) === 0) {
            return redirect()
                ->setIntendedUrl(route('checkout.preview'))
                ->route('address.create');
        }

        if ($request->hasCookie('cart_items_id')) {
            $items = $this->handleCheckout($request);
        } else {
            $items = $this->handleBuyNow($request);
        }
        
        $userAddrInfo = $user->shippingAddresses;

        return view('checkout.preview', [
            'shippingInfo' => $userAddrInfo,
            'items' => $items['items'],
            'totalPrice' => $items['totalPrice'],
        ]);
    }
}
