@props(['product', 'reviews', 'relatedProducts'])

@extends('layouts.app')

@section('title', $product->name ?? 'Product')

@section('content')
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row g-4">
            <div class="col-md-7">
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="No image" class="img-fluid rounded-3" width=500>
            </div>

            <div class="col-md-5">
                <h1 class="h3 mb-2 fw-bold">{{ $product->name }}</h1>
                <div class="mb-3">{{ strtoupper($product->category) }}</div>
                <div class="mb-3"><span class="h4 fw-bold">${{ $product->price }}</span></div>

                <form action="{{ route('cart.store') }}" method="POST" class="d-flex align-items-center justify-content-between gap-3 mb-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="from" value="show">

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
            <ul class="nav nav-tabs mb-3" id="productTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active fw-bold" data-bs-toggle="tab" data-bs-target="#desc">
                        Description
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#reviews">
                        Reviews ({{ count($reviews) }})
                    </button>
                </li>
            </ul>

            <div class="tab-content ms-5">
                {{-- Description --}}
                <div class="tab-pane fade show active" id="desc">
                    {{ $product->description }}
                </div>

                {{-- Reviews --}}
                <div class="tab-pane fade" id="reviews">
                    @forelse ($reviews as $review)
                        <div class="border shadow rounded p-3 mb-3">
                            <strong class="me-3">{{ $review->username }}</strong>

                            <span class="rating secondary-font">
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 0 ? 'text-primary' : '' }}"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 1 ? 'text-primary' : '' }}"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 2 ? 'text-primary' : '' }}"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 3 ? 'text-primary' : '' }}"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 4 ? 'text-primary' : '' }}"></iconify-icon>
                            </span>

                            <p class="mb-0">{{ $review->comment }}</p>
                            <small class="text-muted">{{ $review->created_at }}</small>
                        </div>
                    @empty
                        <p>No reviews yet.</p>
                    @endforelse
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
