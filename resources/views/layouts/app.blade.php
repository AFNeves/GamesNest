<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>{{ config('app.name', 'GamesNest') }}</title>

        <!-- Styles -->
        <link href="{{ url('css/tailwind.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jaro:opsz@6..72&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script type="text/javascript"></script>
        <script type="text/javascript" src={{ url('js/app.js') }} defer></script>
    </head>
    <body>
        <!-- Header -->
        <header>
            <div class="flex flex-wrap items-center mx-auto min-h-14 my-2.5 {{ !View::hasSection('search-bar') && !View::hasSection('header-context') ? 'justify-center' : 'justify-between' }}">
                <!-- Logo -->
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/games-nest-icon.png') }}" class="w-28 h-28" alt="GamesNest Logo" />
                    <span class="font-jaro text-4xl self-center whitespace-nowrap">GamesNest</span>
                </a>

                @hasSection('search-bar')
                    <!-- Search Bar -->
                    @yield('search-bar')
                @endif

                @hasSection('header-context')
                    <!-- Login / User ID -->
                    @yield('header-context')
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="flex flex-wrap items-center justify-between py-4 text-sm">
                <div class="flex items-center">
                    <img src="{{ asset('images/games-nest-icon.png') }}" class="w-16 h-16" alt="GamesNest Logo" />
                    <span class="font-jaro text-2xl self-center whitespace-nowrap">GamesNest</span>
                </div>

                <ul class="flex flex-wrap items-center">
                    <li>
                        <span class="gn-footer-li">About</span>
                    </li>
                    <li>
                        <span class="gn-footer-li">Services</span>
                    </li>
                    <li>
                        <span class="gn-footer-li">FAQ</span>
                    </li>
                    <li>
                        <span class="gn-footer-li">Contact</span>
                    </li>
                </ul>

                <span class="mr-3">© 2024 GamesNest™</span>
            </div>
        </footer>
    </body>
</html>
