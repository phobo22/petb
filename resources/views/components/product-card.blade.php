@props(['product'])

<div class="swiper-slide mb-4">
    <div class="card position-relative">
        <a href="{{ route('products.show', $product) }}">
            <img src="{{ asset('storage/products/' . $product->image) }}" class="img-fluid rounded-4" alt="image">
        </a>
        <div class="card-body p-0">
            <a href="{{ route('products.show', $product) }}">
                <h3 class="card-title pt-4 m-0">{{ $product->name }}</h3>
            </a>
            <div class="card-text">
                <span class="rating secondary-font">
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->rating > 0 ? 'text-primary' : '' }}"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->rating > 1 ? 'text-primary' : '' }}"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->rating > 2 ? 'text-primary' : '' }}"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->rating > 3 ? 'text-primary' : '' }}"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->rating > 4 ? 'text-primary' : '' }}"></iconify-icon>
                </span>
                <h3 class="secondary-font text-primary">${{ $product->price }}</h3>
            </div>
        </div>
    </div>
</div>