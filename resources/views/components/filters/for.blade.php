@props(['dog', 'cat'])

<div class="m-3">
    <h5 class="card-title mb-3 fw-bold">Filter By Pet</h5>
    <div class="form-check mb-2">
        <input style="border:1px solid black;" class="form-check-input" type="checkbox" name="dog" value="dog"
            {{ $dog === 'dog' ? 'checked' : '' }}>
        <label class="form-check-label">Dog</label>
    </div>
    <div class="form-check mb-2">
        <input style="border:1px solid black;" class="form-check-input" type="checkbox" name="cat" value="cat"
            {{ $cat === 'cat' ? 'checked' : '' }}>
        <label class="form-check-label">Cat</label>
    </div>
</div>