<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ('Sistema Línea de Tiempo') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
      
</head>
<body class="custom-fondo">
    
    <div id="app">
        <nav class="navbar navbar-expand-md custom-color shadow-sm">
            <div class="container" >
            
                <a class="navbar-brand ">
                    <img src="../images/logo_blanco.png" width="330px" height="35px" >
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links --> 
                        @guest
                            @if (Route::has('register'))
                                <a class="nav-item custom-titulo ">
                                    <img src="../images/ingenieria.png" width="200px" height="50px">
                                </a>
                            @endif
                        @else
                        <li class="nav-item "> <a class="nav-link active custom-botonmenu" href="/home" style="color:#ffff" >{{ __('Inicio') }}</a> </li>
                        <li class="nav-item "> <a class="nav-link active custom-botonmenu" href="{{route('roles.index')}}" style="color:#ffff">{{ __('Roles') }}</a> </li>
                        <li class="nav-item "> <a class="nav-link active custom-botonmenu" href="{{route('users.index')}}" style="color:#ffff">{{ __('Usuarios') }}</a> </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle custom-botonmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#ffff">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item custom-botondesplegable" href="{{route('user.perfil',auth()->user()->id)}}">
                                        {{ __('Perfil') }}
                                    </a>
                                    <a class="dropdown-item custom-botondesplegable" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
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

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
