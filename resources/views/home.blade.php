@props(['products'])

@extends('layouts.app')

@section('content')
    <section id="banner" style="background: #F9F3EC;">
        <div class="container">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="images/banner-img.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <h2 class="banner-title display-1 fw-normal">Best destination for
                                    <span class="text-primary">your pets's nutrition</span>
                                </h2>
                                <a href="{{ route('products', 'food') }}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="images/banner-img3.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <h2 class="banner-title display-1 fw-normal">Best destination for
                                    <span class="text-primary">your pets's hobbies</span>
                                </h2>
                                <a href="{{ route('products', 'toy') }}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide py-5">
                        <div class="row banner-content align-items-center">
                            <div class="img-wrapper col-md-5">
                                <img src="images/banner-img4.png" class="img-fluid">
                            </div>
                            <div class="content-wrapper col-md-7 p-5 mb-5">
                                <h2 class="banner-title display-1 fw-normal">Best destination for
                                    <span class="text-primary">your pets's fashion</span>
                                </h2>
                                <a href="{{ route('products', 'cloth') }}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                                    shop now
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination mb-5"></div>
            </div>
        </div>
    </section>

    <x-product-section type="cloth" typeTitle="Pet Clothing" :products="$products"/>
    <x-product-section type="food" typeTitle="Pet Food" :products="$products"/>
    <x-product-section type="toy" typeTitle="Pet Toy" :products="$products"/>

    <section id="banner-2" class="my-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="row flex-row-reverse banner-content align-items-center">
                <div class="img-wrapper col-12 col-md-6">
                    <img src="images/banner-img2.png" class="img-fluid">
                </div>
                <div class="content-wrapper col-12 offset-md-1 col-md-5 p-5">
                    <div class="secondary-font text-primary text-uppercase mb-3 fs-4">Thanks For Visiting Our Shop</div>
                    <h2 class="banner-title display-1 fw-normal" style="font-size:55px;">Your Satisfaction is Our Honor !!!</h2>
                </div>
            </div>
        </div>
    </section>

@endsection
