<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ url('css/milligram.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/app.css') }}" rel="stylesheet">


        <!-- toFix Temporary just to make it look less bad -->
        <style>
            #search_bar{
                color: #888;
                margin : 1px auto;
                width: 25%;
            }

            footer {
                background-color: #888;
                color: #fff;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
            }

            footer nav a {
                margin: 0 150px;
                text-decoration: none;
                color: #fff;
                font-size: 14px;
            }
        </style>

        <script type="text/javascript">
            // Fix for Firefox autofocus CSS bug
            // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
        </script>
        <script type="text/javascript" src={{ url('js/app.js') }} defer>
        </script>
    </head>
    <body>
        <main>
            <header>

                <h1><a href="{{ url('/cards') }}">GamesNest</a></h1>
                @if (Auth::check())
                    <a class="button" href="{{ url('/cart') }}"> Shopping Cart </a>
                    <a class="button" href="{{ url('/logout') }}"> Logout </a> <a href="/profile">{{ Auth::user()->username }}</a> <!-- toFix should be the username -->
                @endif
                <!--
                    toFix
                    action and value need to be changed in order to work fo shure
                -->
                <a class="forms">
                    <form id="search_bar" action="" method="GET" class="search_form">
                        <input
                                type="text"
                                name="query"
                                placeholder="Search..."
                                class="search-input"
                                value=""
                        />
                    </form>
                </a>
            </header>
            <section id="content">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </section>
        </main>
        <footer>
            <nav>
                <!-- We will need to put the references of the static pages when they are done-->
                <a href="">Contact Us</a>
                <a href="">About</a>
                <a href="">FAQ</a>
                <a href="">Services</a>
            </nav>
        </footer>
    </body>
</html>