@props(['review'])

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

    <div class="card mb-4 border border-dark">
        <div class="card-header fw-bold bg-dark text-white d-flex justify-content-between">
            <div><span>{{ $username }}</span></div>
        </div>
                
        <div class="card-body p-0 mt-2 ms-5 me-5">
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/products/' . $review->product->image) }}"
                        width="70"
                        class="me-3 rounded">
                    {{ $review->product->name }}
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-4 mb-5 my-form" style="width:650px;">
            <form action="{{ route('rating.update', $review) }}" method="POST">
                @csrf
                @method('PUT')
                <h3 class="text-center mb-4 mt-3 fw-bold">Rating</h3>

                <div class="mb-3">
                    <label for="rating" class="form-label fw-bold">Star Rating</label>
                    <div class="d-flex justify-content-evenly">
                        <span><input type="radio" id="rating" name="rating" value="1"> 1</span>
                        <span><input type="radio" id="rating" name="rating" value="2"> 2</span>
                        <span><input type="radio" id="rating" name="rating" value="3"> 3</span>
                        <span><input type="radio" id="rating" name="rating" value="4"> 4</span>
                        <span><input type="radio" id="rating" name="rating" value="5"> 5</span>
                    </div>
                    @error('rating')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label fw-bold">Comment</label>
                    <input type="text" class="form-control my-field" id="comment" name="comment">
                    @error('comment')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Confirm</button>
            </form>
        </div>
    </div>
</div>
@endsection