<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Forum') }}</title> <!-- look into app.php -->

    <!-- Scripts -->
    <!-- asset means pulls in from the public folder -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Styles -->
    <!-- asset means pulls in from the public folder -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- navbar-expand-sm bg-primary: A blue (primary) color horizontal navbar that becomes vertical on small screens -->
        <nav class="navbar navbar-expand-md bg-primary navbar-dark text-white" style="margin-bottom:50px">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Laravel Forum
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Using a request helper: get me the path, the path will be anything after the domain http://localhost/path ex. http://127.0.0.1:8000/about2 -->
                        <!-- So if the path is the homepage, in that case and only, echo that class current_page_item -->
                        <li class="nav-item {{ Request::path() === '' ? 'current_page_item' : '' }}"><a class="nav-link text-white" href="/home" accesskey="1" title="">HOME</a></li>
                        <li class="nav-item {{ Request::path() === 'posts' ? 'current_page_item' : '' }}"><a class="nav-link text-white" href="/posts" accesskey="3" title="">POSTS</a></li>
                        <li class="nav-item {{ Request::path() === 'create' ? 'current_page_item' : '' }}"><a class="nav-link text-white" href="/posts/create" accesskey="2" title="">CREATE A POST</a></li>
                        <li class="nav-item {{ Request::path() === 'contact' ? 'current_page_item' : '' }}"><a class="nav-link text-white" href="/contact" accesskey="3" title="">CONTACT</a></li>
                        <li class="nav-item {{ Request::path() === 'benefits' ? 'current_page_item' : '' }}"><a class="nav-link text-white" href="/benefits" accesskey="3" title="">BENEFITS</a></li>

                        <!--
                        <li class="nav-item {{ Request::path() === 'login' ? 'current_page_item' : '' }}"><a class="nav-link text-white" href="/login" accesskey="4" title="">LOGIN</a></li>
                        <li class="nav-item {{ Request::path() === 'signup' ? 'current_page_item' : '' }}"><a class="nav-link text-white" href="/register" accesskey="5" title="">REGISTER</a></li>
                        -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('LOGIN') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container pb-5"> <!-- bottom padding (3rem = 48px) -->
            @include('messages/messages') <!-- form validation error messages and other session messages -->
            @yield('content')
        </main>
    </div>

    <!-- Footer 
    <div id="copyright" class="container"><p>Developed by Marios Nowak.</p></div>  -->
</body>
</html>
