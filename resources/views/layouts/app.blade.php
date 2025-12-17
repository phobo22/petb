<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'PeTB')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="PTB">
    <meta name="keywords" content="Pet">
    <meta name="description" content="Pet Shop">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    @vite([
        'resources/css/app.css',
        'resources/css/vendor.css',
        'resources/js/app.js',
        'resources/js/script.js',
    ])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chilanka&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
</head>

<body>
    <x-svg />
    <x-header />

    <div class="container-fluid"><hr class="m-0"></div>
    @yield('content')
    <div class="container-fluid"><hr class="m-0"></div>

    <x-services />
    <x-insta />
    <x-footer />

    <div id="footer-bottom">
        <div class="container">
            <hr class="m-0">
            <div class="row mt-3">
                <div class="col-md-6 copyright">
                    <p class="secondary-font">© 2023 Waggy. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="secondary-font">Free HTML Template by <a href="https://templatesjungle.com/" target="_blank"
                        class="text-decoration-underline fw-bold text-black-50"> TemplatesJungle</a> Distributed by <a href="https://themewagon.com/" target="_blank"
                        class="text-decoration-underline fw-bold text-black-50"> ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>
</html>