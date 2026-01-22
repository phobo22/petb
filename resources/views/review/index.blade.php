@props(['reviews'])

@extends('layouts.app')

@section('title', 'My Ratings')

@section('content')
<div class="container py-5" style="max-width: 1000px;">
    <div class="d-flex justify-content-between">
        <h2 class="mb-4">🧾 My Ratings</h2>
        <div>
            <a href="{{ route('order.waiting') }}" class="btn btn-outline-secondary btn-sm">Not Received</a>
            <a href="{{ route('order.done') }}" class="btn btn-outline-secondary btn-sm">Received</a>
            <a href="{{ route('rating.unrated') }}" class="btn btn-outline-secondary btn-sm">Not Rated</a>
            <a href="{{ route('rating.rated') }}" class="btn btn-outline-secondary btn-sm">Rated</a>
        </div>
    </div>

    @if (count($reviews) === 0)
        <div class="d-flex justify-content-evenly">
            <p style="font-size:25px;color:chocolate;">You have not rated any product.</p>
        </div>
    @endif

    @foreach ($reviews as $review)
        <div class="card mb-4 border border-dark">
            <div class="card-header fw-bold bg-dark text-white d-flex justify-content-between">
                <div><span>{{ $username }}</span></div>
                @if ($review->status === 'unrated')
                    <div>
                        <a href="{{ route('rating.edit', $review) }}" class="btn btn-outline-secondary text-white">Rating</a>
                    </div>
                @endif
            </div>
                
            <div class="card-body p-0 mt-2 ms-5 me-5">
                @if ($review->status === 'rated')
                    <div>
                        <div>
                            <label class="fw-bold">Rating at: </label>
                            {{ $review->created_at }}
                        </div>
                        <div>
                            <span class="rating secondary-font">
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 0 ? 'text-primary' : '' }}"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 1 ? 'text-primary' : '' }}"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 2 ? 'text-primary' : '' }}"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 3 ? 'text-primary' : '' }}"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="{{ $review->rating > 4 ? 'text-primary' : '' }}"></iconify-icon>
                            </span>
                        </div>
                        <div>
                            <label class="fw-bold">Comment: </label>
                            {{ $review->comment }}
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/products/' . $review->product->image) }}"
                            width="70"
                            class="me-3 rounded">
                        {{ $review->product->name }}
                    </div>
                </div>
                
                @if ($review->status === 'unrated')
                    <div class="alert alert-warning">
                        You have {{ $review->rest_time }} left to rating this product.
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    <div class="mt-5">{{ $reviews->links('pagination::bootstrap-5') }}</div>
</div>
@endsection