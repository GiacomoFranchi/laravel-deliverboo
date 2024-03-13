<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/images/favicon.svg')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app" style="background-color: rgb(197 170 106)">

        <header class="navbar navbar-dark sticky-top flex-md-nowrap p-2 shadow" style="background-color: rgb(47 38 38)">
            <div class="row justify-content-between">
                <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">
                    <img class="logo" src="{{ Vite::asset("resources/images/deliveboo-logo2.svg") }}" alt="">
            </a>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap ms-2">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <div class="container-fluid vh-100" >
            <div class="row h-100">
                <!-- Definire solo parte del menu di navigazione inizialmente per poi
        aggiungere i link necessari giorno per giorno
        -->
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block navbar-dark sidebar collapse" style="background-color: rgb(47 38 38)">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-white"
                                    href="{{ route('dashboard') }}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw" style="color: rgb(242 200 2);"></i> <strong>
                                        Dashboard
                                    </strong>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link text-white"
                                href="{{ route('admin.restaurants.index') }}">
                                    <i class="fa-solid fa-utensils fa-lg fa-fw" style="color: rgb(242 200 2);"></i> <strong>
                                        Restaurants
                                    </strong>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.orders.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('admin.orders.index') }}"> 
                                    <i class="fa-solid fa-receipt fa-lg fa-fw" style="color: rgb(242 200 2);"></i> <strong>
                                        Orders
                                        </strong>
                                    
                                    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.restaurants.statistics.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('admin.restaurants.statistics.index') }}"> 
                                    <i class="fa-solid fa-chart-simple ms-1" style="color: rgb(242 200 2);"></i> <span class="ms-1">
                                        <strong>Stats</strong></span>
                                    
                                    
                                </a>
                            </li>
                        </ul>


                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="background-color: rgb(197 170 106)">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>

    @yield('scripts')
</body>

</html>

