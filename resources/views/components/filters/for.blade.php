@props(['fors'])

<div class="m-3">
    <h5 class="card-title mb-3">Filter By Pet</h5>
    <div class="form-check mb-2">
        <input style="border:1px solid black;" class="form-check-input" type="checkbox" name="filterFor[]" value="dog"
            {{ in_array('dog', $fors ?? request('filterFor', [])) ? 'checked' : '' }}>
        <label class="form-check-label">Dog</label>
    </div>
    <div class="form-check mb-2">
        <input style="border:1px solid black;" class="form-check-input" type="checkbox" name="filterFor[]" value="cat"
            {{ in_array('cat', $fors ?? request('filterFor', [])) ? 'checked' : '' }}>
        <label class="form-check-label">Cat</label>
    </div>
</div>