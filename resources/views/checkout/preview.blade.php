@props(['shippingInfo', 'items', 'totalPrice'])

@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5" style="max-width: 1000px;">
    <h2 class="mb-4">🧾 Checkout</h2>
    <form method="POST" action="{{ route('order.store') }}">
        @csrf

        @if(session('addr_failed'))
            <div class="alert alert-danger">{{ session('addr_failed') }}</div>
        @endif

        {{-- ================= USER INFO ================= --}}
        <div class="card mb-5 border border-dark">
            <div class="card-header fw-bold bg-dark text-white d-flex justify-content-between">
                <label>Shipping Information</label>
                <a href="{{ route('address.index') }}" class="text-white">Edit Address</a>
            </div>
            <div class="card-body">
                @foreach ($shippingInfo as $info)
                    <div class="form-check">
                        <input class="form-check-input"
                            type="radio"
                            name="shipping_address"
                            value="{{ $info->id }}"
                            style="border: 2px solid #000">
                        <label class="form-check-label">
                            {{ $info->receiver_fullname }} - {{ $info->phone }} - {{ $info->address }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ================= ORDER DETAILS ================= --}}
        <div class="card mb-5 border border-dark">
            <div class="card-header fw-bold bg-dark text-white">Order Details</div>
            <div class="card-body p-0">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/products/' . $item['image']) }}"
                                             width="90"
                                             class="me-3 rounded">
                                        {{ $item['name'] }}
                                    </div>
                                </td>
                                <td class="text-center">{{ $item['quantity'] }}
                                <td class="text-end">${{ $item['subtotal'] }}</td>
                            </tr>

                            <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $item['id'] }}">
                            <input type="hidden" name="products[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
                        @endforeach
                    </tbody>

                    <tfoot class="table-light">
                        <tr>
                            <td colspan="2" class="text-end fw-bold">Total</td>
                            <td class="text-end fw-bold fs-5">${{ $totalPrice }}</td>
                            <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if(session('payment_method_failed'))
            <div class="alert alert-danger">{{ session('payment_method_failed') }}</div>
        @endif

        {{-- ================= PAYMENT METHOD ================= --}}
        <div class="card mb-4 border border-dark">
            <div class="card-header fw-bold bg-dark text-white">Payment Method</div>
            <div class="card-body">
                <div class="form-check mb-2">
                    <input class="form-check-input"
                           type="radio"
                           name="payment_method"
                           value="cod"
                           style="border: 2px solid #000"
                           checked>
                    <label class="form-check-label">
                        Pay when receive order (COD)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input "
                           type="radio"
                           name="payment_method"
                           value="bank_transfer"
                           style="border: 2px solid #000">
                    <label class="form-check-label">
                        Online bank transfer
                    </label>
                </div>
            </div>
        </div>

        {{-- ================= DIRECTION BUTTON ================= --}}
        <div class="d-flex justify-content-between">
            <a href="{{ url()->previous() }}" type="submit" class="btn btn-danger btn-lg">Back</a>
            <button type="submit" class="btn btn-success btn-lg">Order</button>
        </div>
    </form>
</div>
@endsection
