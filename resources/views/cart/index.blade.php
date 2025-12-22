@props(['items', 'totalPrice'])

@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
    <div class="container py-5" style="width:1100px;">
        <h2 class="mb-4">🛒 Shopping Cart</h2>

        @if($items === null || count($items) === 0)
            <div class="d-flex justify-content-evenly">
                <p style="font-size:25px;color:chocolate;">Your cart is empty</p>
            </div>
        @else
            <table class="table align-middle">
                @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
                <thead>
                    <tr>
                        <th>Product</th>
                        <th width="200">Quantity</th>
                        <th class="text-end">Subtotal</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                        width="150" height="150"
                                        class="me-3 rounded">

                                    <div style="font-size:20px;">
                                        <a href="{{ route('products.show', $item->product) }}">
                                            <div class="fw-bold">{{ $item->product->name }}</div>
                                        </a>
                                        <small>${{ $item->product->price }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('cart.update', ['method' => 'minus', 'cartItem' => $item]) }}" class="btn btn-outline-secondary btn-sm btn-minus">−</a>

                                    <input type="text"
                                        class="form-control text-center mx-2 quantity-input"
                                        value="{{ $item['quantity'] }}"
                                        style="width: 50px;"
                                        readonly>

                                    <a href="{{ route('cart.update', ['method' => 'plus', 'cartItem' => $item]) }}" class="btn btn-outline-secondary btn-sm btn-plus">+</a>
                                </div>
                            </td>
                            <td class="text-end fw-bold subtotal">${{ $item->subtotal }}</td>
                            <td class="text-end">
                                <form action="{{ route('cart.delete', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="container-fluid"><hr class="m-0"></div>
            
            <div class="d-flex justify-content-end mt-4">
                <div class="card p-3" style="width: 300px;">
                    <div class="d-flex justify-content-between mb-2 fw-bold" style="font-size:22px;">
                        <span>Total</span>
                        <strong id="cart-total">${{ $totalPrice }}</strong>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
