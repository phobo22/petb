@props(['dog', 'cat'])

<form class="card shadow p-3 mb-4" action="{{ url()->current() }}" method="GET" onchange="this.submit()">
    @foreach (request()->except(['dog', 'cat']) as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    
    <div class="d-flex flex-row">
        <x-filters.for :dog="$dog" :cat="$cat" />
    </div>
</form>
