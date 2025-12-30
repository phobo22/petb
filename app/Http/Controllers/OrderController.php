<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\CartItem;
use App\Jobs\SendConfirmOrderMail;
use App\Events\OrderPlaced;

class OrderController extends Controller
{
    private function handle(Request $request, string $status) {
        $user = $request->user();
        $orders = $user->orders()
                        ->where('status', $status)
                        ->with(['details.product', 'shippingInfo'])
                        ->orderBy('order_at', 'desc')
                        ->get();
        return $orders;
    }

    public function waiting(Request $request) {
        $data = $this->handle($request, 'in_progress');
        return view('order.index', ['orders' => $data]);
    }

    public function done(Request $request) {
        $data = $this->handle($request, 'done');
        return view('order.index', ['orders' => $data]);
    }

    public function store(Request $request) {
        if (empty($request->shipping_address)) {
            return back()->with('addr_failed', 'Please select an address');
        }

        if (empty($request->payment_method)) {
            return back()->with('payment_method_failed', 'Please select an payment method to continue');
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'shipping_info_id' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'order_at' => date('Y-m-d'),
            'total' => $request->totalPrice,
        ]);

        $cartItemsId = $request->input('cartItemsId', []);
        $cartItems = CartItem::whereIn('id', $cartItemsId)->get();

        foreach($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        SendConfirmOrderMail::dispatch($order);
        event(new OrderPlaced($order));
        return redirect()->route('order.waiting')->with('success', 'Order successfully !!');
    }

    public function update(Order $order) {
        $order->update(['status' => 'done']);
        $order->save();
        return back();
    }

    public function destroy(Order $order) {
        $order->delete();
        return back()->with('success', 'Your order has been deleted !!');
    }
}
