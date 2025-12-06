<!-- PRICE RANGE -->
<div class="col-md-6">
    <label class="form-label">Price Range</label>

    <div class="card p-3">
        <div class="d-flex justify-content-between mb-2">
            <span>Min: $<span id="price-min-val">{{ request('price_min', 0) }}</span></span>
            <span>Max: $<span id="price-max-val">{{ request('price_max', 1000) }}</span></span>
        </div>

        <!-- Hidden real inputs -->
        <input type="hidden" name="price_min" id="price_min_hidden" value="{{ request('price_min', 0) }}">
        <input type="hidden" name="price_max" id="price_max_hidden" value="{{ request('price_max', 1000) }}">

        <!-- Range sliders -->
        <input type="range" class="form-range" id="range_min" min="0" max="1000" step="1"
               value="{{ request('price_min', 0) }}">

        <input type="range" class="form-range" id="range_max" min="0" max="1000" step="1"
               value="{{ request('price_max', 1000) }}">
    </div>
</div>
