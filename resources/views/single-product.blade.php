@props(['product', 'relatedProducts'])

@extends('layouts.app')

@section('title', $product->name ?? 'Product')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-7">
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="No image" class="img-fluid rounded-3" width=500>
        </div>

        <div class="col-md-5">
            <h1 class="h3 mb-2 fw-bold">{{ $product->name }}</h1>
                    <div class="mb-3">{{ strtoupper($product->category) }}</div>
                <div class="mb-3">
                    <span class="h4 fw-bold">${{ $product->price }}</span>
                </div>

            <form action="" method="POST" class="d-flex align-items-center justify-content-between gap-3 mb-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="input-group product-qty" style="width:120px;">
                    <button type="button" class="btn btn-outline-secondary btn-sm quantity-left-minus">-</button>
                    <input id="quantity" type="number" name="quantity" value="1" min="1" class="form-control text-center form-control-sm" />
                    <button type="button" class="btn btn-outline-secondary btn-sm quantity-right-plus">+</button>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">
                    <iconify-icon icon="mdi:cart-plus" inline></iconify-icon> Add to cart
                </button>
            </form>

            <div class="mb-4">
                <a href="#" class="me-3"><iconify-icon icon="mdi:share-variant"></iconify-icon> Share</a>
            </div>

        </div>
    </div>

    {{-- Tabs: Specs / Reviews --}}
    <div class="mt-5">
        <div class="mb-5">
            <ul class="nav nav-tabs mb-3" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button">Description</button>
                </li>
            </ul>

            <div class="tab-content ms-5">
                aiudfghsdugfsjgfsdjhgfsdhjgfhjsdgfsdjhgfsdhjgfsdjhgfsdjhgf
                sdkfjhsdkjhfsdkjfhsdkjhfskdjhfsdkjhfsdkjhfsdkjhfsdkjfhsdkjfh
                aiudfghsdugfsjgfsdjhgfsdhjgfhjsdgfsdjhgfsdhjgfsdjhgfsdjhgf
                sdkfjhsdkjhfsd
                kjfhsdkjhfskdjhfsdkjhfsdkjhfsdkjhfsdkjfhsdkjfh
                aiudfghsdugfsjgfsdjhgfsdhjgfhjsdgfsdjhgfsdhjgfsdjhgfsdjhgf
                sdkfjhsdkjhfsdkjfhsdkjhfskdjhfsdkjhfsdkjhfsdkjhfsdkjfhsdkjfh
            </div>
        </div>

        <div class="container-fluid"><hr class="m-0"></div>

        {{-- Related products --}}
        <div class="mt-5">
            <h5 class="mb-3 fw-bold">Related products</h5>
            <div class="products-carousel swiper">
                <div class="swiper-wrapper">
                    @foreach ($relatedProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
