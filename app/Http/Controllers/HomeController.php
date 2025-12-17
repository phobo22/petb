<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request) {
        // if (Auth::check()) {
        //     $user = $request->user();
        //     $cart = $user->cart;
        //     $cartData = CartItem::where('cart_id', $cart->id)->pluck('quantity', 'product_id');
        //     // $cartProducts = [
        //     //     'product' => Product::where('id', $cartData->product_id)->get(),
        //     //     'quantity' => $cartData->quantity,
        //     // ];
        //     $cartProducts = null;
        //     foreach ($cartData as $key => $value) {
        //         $cartProducts[] = [
        //             'product' => Product::where('id', $key)->pluck('name')->first(),
        //             'quantity' => $value,
        //         ];
        //     }
        //     return $cartProducts;
        // }
        
        $clothProducts = Product::category('cloth')->paginate(8);
        $foodProducts = Product::category('food')->paginate(8);
        $toyProducts = Product::category('toy')->paginate(8);

        return view('home', [
            'cloth' => $clothProducts,
            'food' => $foodProducts,
            'toy' => $toyProducts,
        ]);
    }
}
