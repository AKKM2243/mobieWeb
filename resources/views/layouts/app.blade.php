<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:ital,wght@;0,600;0,900;1,400;1,800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">

</head>
<body class="bg-dark">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="img-fluid mlogo" src="logo/ML.png" alt="movie logo">
                    <a class="text-danger text-decoration-none fs-3" href="/">{{ config('app.name', 'Laravel') }}</a>
                </a>
                {{-- <a href="#" class="navbar-brand">
                    <img class="img-fluid logo" src="{{ asset('logo/FB.png') }}" alt="fb-logo">
                </a>
                <a href="#" class="navbar-brand">
                    <img class="img-fluid logo" src="{{ asset('logo/IG.png') }}" alt="ig-logo">
                </a> --}}

                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <form action="{{ route('msearch.index') }}" method="GET" class="">
                                <div class="search-container" >
                                    <input type="text" class="search-box winput" placeholder="Search movies..." name="query" value="{{ request('query') }}">
                                    <div class="input-group-append">
                                        <span class="material-icons-outlined search-icon">
                                            search
                                        </span>
                                      </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="{{ route('movies.index') }}">Movies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white me-3" href="{{ route('movies.atseries') }}">Series</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4 bg-dark">
            @yield('content')
        </main>
    </div>
    <script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </script>
</body>
</html>
