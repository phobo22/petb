@props(['product'])

<div class="swiper-slide">
    <div class="card position-relative">
        <a href="single-product.html">
            <img src="{{ asset('storage/products/' . $product->image) }}" class="img-fluid rounded-4" alt="image">
        </a>
        <div class="card-body p-0">
            <a href="single-product.html">
                <h3 class="card-title pt-4 m-0">{{ $product->name }}</h3>
            </a>
            <div class="card-text">
                <span class="rating secondary-font">
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->reviews > 0 ? 'text-primary' : '' }}"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->reviews > 1 ? 'text-primary' : '' }} }}"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->reviews > 2 ? 'text-primary' : '' }} }}"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->reviews > 3 ? 'text-primary' : '' }} }}"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="{{ $product->reviews > 4 ? 'text-primary' : '' }} }}"></iconify-icon>
                    {{ $product->reviews }}.0
                </span>
                <h3 class="secondary-font text-primary">$18.00</h3>
                <div class="d-flex flex-wrap mt-3">
                    <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                        <h5 class="text-uppercase m-0">Add to Cart</h5>
                    </a>
                    <a href="#" class="btn-wishlist px-4 pt-3 ">
                        <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>