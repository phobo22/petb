@props(['sort'])

<button class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Sorting - {{ $sort }}</button>
<ul class="dropdown-menu" aria-labelledby="pages">
    <form method="GET" action="{{ url()->current() }}" onclick="this.submit()">
        <input type="hidden" name="price" value="asc">
        @foreach(request()->except(['price', 'rating']) as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <li><a class="dropdown-item">Price - Low to High</a></li>
    </form>

    <form method="GET" action="{{ url()->current() }}" onclick="this.submit()">
        <input type="hidden" name="price" value="desc">
        @foreach(request()->except(['price', 'rating']) as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <li><a class="dropdown-item">Price - High to Low</a></li>
    </form>
</ul>