<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.head')
    </head>
    <body>
        <!-- ***** Preloader Start ***** -->
        <div id="preloader">
            <div class="jumper">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <!-- ***** Preloader End ***** -->

        <!-- Header -->
        <header class="">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <h2>{{ config('app.name', 'Laravel') }}<em>.</em></h2>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('home')? 'active' : '' }}" href="{{ route('home') }}">{{ trans('post.home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('posts')? 'active' : '' }}" href="{{ route('posts') }}">{{ trans('post.posts') }}</a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('platform.main')? 'active' : '' }}" href="{{ route('platform.main') }}">{{ trans('post.dashboard') }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('login')? 'active' : '' }}" href="{{ route('login') }}">{{ trans('post.log_in') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('register')? 'active' : '' }}" href="{{ route('register') }}">{{ trans('post.register') }}</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Page Content -->
        @yield('content')
        <!-- Page Content End -->
        <footer>
            @include('components.footer')
        </footer>

        @include('components.scripts')
    </body>
</html>
