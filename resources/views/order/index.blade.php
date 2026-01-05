@props(['orders'])

@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5" style="max-width: 1000px;">
    <div class="d-flex justify-content-between">
        <h2 class="mb-4">🧾 My Orders</h2>
        <div>
            <a href="{{ route('order.waiting') }}" class="ms-5">In Progress</a>
            <a href="{{ route('order.done') }}" class="ms-5">Done</a>
        </div>
    </div>
        @if (count($orders) === 0)
            <div class="d-flex justify-content-evenly">
                <p style="font-size:25px;color:chocolate;">You don't have any orders yet.</p>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @foreach ($orders as $order)
            {{-- ================= ORDER DETAILS ================= --}}
            <div class="card mb-5 border border-dark">
                <div class="card-header fw-bold text-white d-flex justify-content-between" 
                    style="background-color:{{ $order->status === 'in_progress' ? '#DEAD6F' : '#439E3A' }};
                            font-size:20px;">

                    <div>
                        <span>Date Order:</span>
                        <span class="ms-2" style="font-size:16px;">{{ $order->order_at }}</span>
                    </div>
                    @can('update', $order)
                        <div class="d-flex">
                            <form method="POST" action="{{ route('order.update', $order) }}" 
                                    onsubmit="return confirm('Are you sure that you have received the order ?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn">Received</button>
                            </form>

                            <form method="POST" action="{{ route('order.destroy', $order) }}" 
                                    onsubmit="return confirm('Are you sure to cancel this order ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Cancel</button>
                            </form>
                        </div>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="ms-5">
                        <div>
                            <label class="fw-bold">Fullname: </label>
                            {{ $order->shippingInfo->receiver_fullname}}
                        </div>
                        
                        <div>
                            <label class="fw-bold">Phone Number: </label>
                            {{ $order->shippingInfo->phone }}
                        </div>

                        <div>
                            <label class="fw-bold">To: </label>
                            {{ $order->shippingInfo->address }}
                        </div>
                    </div>

                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                                width="90"
                                                class="me-3 rounded">
                                            {{ $item->product->name }}
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}
                                    <td class="text-end">${{ $item->product->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot class="table-light">
                            <tr>
                                <td colspan="2" class="text-end fw-bold">Total</td>
                                <td class="text-end fw-bold fs-5">${{ $order->total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endforeach
</div>
@endsection
