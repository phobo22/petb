@props(['products', 'dog', 'cat', 'sort'])

@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="my-5 overflow-hidden">
        <div class="container pb-5">
            <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <div>
                    <x-filter :dog="$dog" :cat="$cat" />
                </div>
                <div>
                    <x-sort :sort="$sort" />
                </div>
            </div>

            <div class="products-carousel swiper">
                <div class="swiper-wrapper">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
            <div class="mt-5">{{ $products->links('pagination::bootstrap-5') }}</div>
        </div>
    </section>

@endsection
    