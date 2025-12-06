@props(['fors'])

<form method="GET" class="card shadow-sm p-3 mb-4">
    <div class="d-flex flex-row">
        <x-filters.for :fors="$fors" />
    </div> 
    <button class="btn btn-primary w-100">Apply Filter</button>
</form>
