<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Goocrux Shop</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="z-index: 1;">
            <div class="container">
                <a class="navbar-brand neon-button" href="{{ url('/') }}">
                    Shop
                </a>

                <a class="navbar-brand neon-button" href="{{ url('/') }}">
                    Goocrux
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <form class="d-flex mt-3" method="GET" action="{{ route('search') }}">
                            <input class="form-control me-2 w-100" type="search" placeholder="Search"
                                aria-label="Search" id="search" name="search">
                            <button class="btn btn-outline-success ml-2" type="submit">Search</button>
                        </form>
                    </ul>

                    @guest

                    @else
                        <ul class="navbar-nav ml-5">
                            <a class="nav-link text-light" href="{{ route('pujarProducte') }}">
                                <h4><i class="bi bi-plus-circle"></i></h4>
                            </a>
                            <div class="dropdown">
                                <a id="navbarDropdown" class="nav-link text-light dropdown-toggle" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropright" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('config') }}">
                                        Config
                                    </a>
                                    <a class="dropdown-item" href="{{ route('configPassword') }}">
                                        Password
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </ul>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i
            class="fa fa-chevron-up"></i></a>
</body>

</html>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });
    });

</script>
