<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta Tags -->
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
        <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script type="text/javascript"></script>
        <script type="text/javascript" src="{{ url('js/app.js') }}" defer></script>
    </head>
    <body>
        <header class="{{ !View::hasSection('search-bar') && !View::hasSection('header-options') ? 'justify-center' : 'justify-between' }}">
            <a href="/" class="flex items-center h-1/2 space-x-2">
                <img src="{{ asset('images/logo.svg') }}" alt="" class="h-full w-auto"/>
                <span class="header-logo-text">GamesNest</span>
            </a>

            @hasSection('search-bar')
                @yield('search-bar')
            @endif

            @hasSection('header-options')
                @yield('header-options')
            @endif
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="{{ !View::hasSection('footer-logo') && !View::hasSection('footer-nav') ? 'justify-center bg-transparent' : 'justify-between' }}">
            @hasSection('footer-logo')
                @yield('footer-logo')
            @endif

            @hasSection('footer-nav')
                @yield('footer-nav')
            @endif

            <span class="copyright">© 2024 GamesNest™</span>
        </footer>
    </body>
</html>
