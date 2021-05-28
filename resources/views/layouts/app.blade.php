<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Galaxy Swiss Bourdin') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{asset('images/pill.ico')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('extra-css')

</head>
<body>
<div id="app">

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a  href="{{ url('/') }}">
                <img style="right: 50px" src="{{asset('images/logo-gsb_50_50.png')}}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><!--{{ __('Connexion') }}--></a>
                            </li>
                        @endif

                    <!--    @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                            </li>
                        @endif -->
                    @else
                        <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link" style="font-weight: bold; font-size: 14px; justify-content: center; color: #1d68a7">Tableau de bord</a>
                        </li>
                        <li class="nav-item"><a href="{{route('fichefrais.index')}}" class="nav-link" style="font-weight: bold; font-size: 14px; justify-content: center; color: #1d68a7">Créer une fiche de frais</a>
                        </li>
                        <li class="nav-item"><a href="{{route('fichefraishorsforfait.index')}}" class="nav-link" style="font-weight: bold; font-size: 14px; justify-content: center; color: #1d68a7">Créer une fiche de frais hors forfait</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" role="button" aria-expanded="false" data-toggle="dropdown" href="#" style="font-weight: bold; font-size: 14px; justify-content: center; color: #1d68a7">Consulter/Modifier des fiches</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" style="font-weight: bold; font-size: 14px; justify-content: center; color: #81b3db" href="{{route('visualisationfichefrais.show')}}">Consulter/Modifier des fiches de frais</a>
                                <a class="dropdown-item" style="font-weight: bold; font-size: 14px; justify-content: center; color: #81b3db" href="{{route('visualisationfichefraishorsforfait.show')}}">Consulter/Modifier des fiches de frais hors forfait</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" role="button" aria-expanded="false" data-toggle="dropdown" href="#" style="font-weight: bold; font-size: 14px; justify-content: center; color: #1d68a7">Téléchargement</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" style="font-weight: bold; font-size: 14px; justify-content: center; color: #81b3db" href="{{route('TelechargementFicheFrais.index')}}">Télécharger une fiche de frais</a>
                                <!-- <a class="dropdown-item" style="font-weight: bold; font-size: 14px; justify-content: center; color: #81b3db" href="#">Télécharger une fiche de frais hors forfait</a>-->
                            </div>
                        </li>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold; font-size: 14px; justify-content: center;  color: #38c172" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: #c51f1a">
                                        {{ __('Se déconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    @yield('extra-js')
</div>
</body>
</html>
