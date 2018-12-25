<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Świat czytania @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main-layout.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @guest
            <div class="mt-2">
                @yield('content')
            </div>
        @else
            <nav class="navbar navbar-light bg-white">
            <a href="{{ route('home') }}" class="navbar-brand">
                <h3>Świat czytania</h3>
            </a>
                <form class="form-inline">
                    <div class="header-buttons">
                        <a href="{{ route('profile.index') }}" class="btn btn-primary">Twój profil</a>
                        @if(Auth::user()->role == 1)
                            <a href="{{ route('clipboard.index') }}" class="btn btn-primary">Panel administratora</a>
                        @elseif(Auth::user()->role == 2)
                            <a href="{{ route('clipboard.index') }}" class="btn btn-primary">Panel administratora</a>
                        @endif()
                        <a href="{{ route('logout') }}" class="btn btn-primary">Wyloguj się</a>
                    </div>
                </form>
            </nav>
            <div class="container-fluid gedf-wrapper">
                <div class="row">
                    <div class="col-md-9 gedf-main">
                        @yield('content')
                    </div>
                    <div class="col-md-3">
                        <div class="card gedf-card">
                            <div class="card-body">
                                <h5 class="card-title">Witaj, {{ Auth::user()->profile->full_name }}</h5>
                                <p>
                                    <span class="fa fa-user" aria-hidden="true"></span>
                                    <a href="{{ route('profile.index') }}">Twój profil</a>
                                </p>
                                <p>
                                    <span class="fa fa-home" aria-hidden="true"></span>
                                    <a href="{{ route('home') }}">Aktualności</a>
                                </p>
                                <p>
                                    <span class="fa fa-search" aria-hidden="true"></span>
                                    <a href="{{ route('search.index') }}">Wyszukiwarka książek</a>
                                </p>
                                <p>
                                    <span class="fa fa-folder-open" aria-hidden="true"></span>
                                    <a href="{{ route('clipboard.index') }}">Schowek</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
</body>
</html>
