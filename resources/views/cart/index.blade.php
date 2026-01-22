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
            <form method="POST" action="{{ route('checkout.select') }}" id="checkoutForm">
                @csrf
            </form>

            <table class="table align-middle">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-warning">{{ session('error') }}</div>
                @endif

                <thead class="card-header fw-bold bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th width="180">Quantity</th>
                        <th class="text-end">Subtotal</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr class="border border-dark">
                            <td>
                                <input style="border:1px solid black;" 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="cartItems[]" 
                                        value="{{ $item->id }}"
                                        form="checkoutForm">
                            </td>
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
                                    <a href="{{ route('cart.update', ['method' => 'minus', 'cartItem' => $item]) }}" 
                                        class="btn btn-outline-secondary btn-sm btn-minus">−</a>

                                    <input type="text"
                                        class="form-control text-center mx-2 quantity-input"
                                        value="{{ $item['quantity'] }}"
                                        style="width: 50px;"
                                        readonly>

                                    <a href="{{ route('cart.update', ['method' => 'plus', 'cartItem' => $item]) }}" 
                                        class="btn btn-outline-secondary btn-sm btn-plus">+</a>
                                </div>
                            </td>
                            <td class="text-end fw-bold subtotal">${{ $item->subtotal }}</td>
                            <td class="text-end">
                                <form action="{{ route('cart.delete', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr class="border border-dark">
                        <td></td>
                        <td></td>
                        <td class="mb-2 fw-bold ms-5" style="font-size:22px;">
                            <span>Total</span>
                        </td>
                        <td class="text-end">
                            <span class="mb-2 fw-bold ms-4" style="font-size:22px;">
                                ${{ $totalPrice }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="submit" class="btn btn-primary" style="font-size:20px;" form="checkoutForm" name="action" value="checkout">
                                Checkout
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        @endif
    </div>
@endsection
