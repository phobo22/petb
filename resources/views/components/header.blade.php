<header>
    <div class="container py-2">
        <div class="row py-4 pb-0 pb-sm-4 align-items-center justify-content-between">
            <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                <div class="main-logo">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                <div class="search-bar border rounded-2 px-3 border-dark-subtle">
                    <form id="search-form" class="text-center d-flex align-items-center" action="{{ request()->is('/') ? route('products.index') : url()->current() }}" method="GET">
                        <input type="text" name="search" class="form-control border-0 bg-transparent"
                            placeholder="Search for more than 10,000 products" />
                        @foreach (request()->except('search') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                            d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                        </svg>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid"><hr class="m-0"></div>

    <div class="container">
        <nav class="main-menu d-flex navbar navbar-expand-lg ">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header justify-content-center">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body justify-content-between">
                    <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link active">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown"
                                aria-expanded="false">Products</a>
                            <ul class="dropdown-menu" aria-labelledby="pages">
                                <li><a href="{{ route('products.category', 'cloth') }}" class="dropdown-item">Cloth</a></li>
                                <li><a href="{{ route('products.category', 'food') }}" class="dropdown-item">Food</a></li>
                                <li><a href="{{ route('products.category', 'toy') }}" class="dropdown-item">Toy</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#service" class="nav-link">Services</a>
                        </li>
                        <li class="nav-item">
                            <a href="#footer" class="nav-link">Contact</a>
                        </li>
                    </ul>

                    <div class="d-none d-lg-flex align-items-end">
                        <ul class="d-flex justify-content-end list-unstyled m-0">
                            <li class="nav-item dropdown">
                                @auth
                                    <a class="nav-link" role="button" id="pages" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="pages">
                                        <li><a href="{{ route('profile.index') }}" class="dropdown-item">Settings</a></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST" onclick="this.submit()">
                                                @csrf
                                                <a class="dropdown-item">Logout</a>
                                            </form> 
                                        </li>
                                    </ul>
                                @endauth

                                @guest
                                    <a href="{{ route('login.page') }}" class="nav-link" id="pages" aria-expanded="false">
                                        <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                    </a>
                                @endguest
                            </li>

                            <li>
                                <a href="{{ route('cart.index') }}" class="mx-3">
                                    <iconify-icon icon="mdi:cart" class="fs-4 position-relative"></iconify-icon>
                                    <span class="position-absolute translate-middle badge rounded-circle bg-primary pt-2">03</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>