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
    <script src="https://kit.fontawesome.com/df11a4c4b4.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.scss') }}" rel="stylesheet">


    <script src="https://kit.fontawesome.com/df11a4c4b4.js" crossorigin="anonymous"></script>



</head>
<body class="custom-fondo">
    <div id="app">
     @include('mensajes-flash')   
        <nav class="navbar navbar-expand-md navbar-dark custom-color shadow-sm">
            <div class="container" >
            
                <a class="navbar-brand ">
                    <img class="img-responsive" src="/images/logo_blanco.png" style="width: 100%; max-width: 330px; min-width: 200px" >
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links --> 
                        @guest
                                <a class="nav-item custom-titulo ">
                                    <img src="/images/ingenieria.png" width="200px" height="50px">
                                </a>
                        @else
                        <li class="nav-item "> <a class="nav-link active custom-botonmenu" href="{{route('home')}}" style="color:#ffff" >{{ __('Inicio') }}</a> </li>
                        @can('modulos.index')
                        <li class="nav-item "> <a class="nav-link active custom-botonmenu" href="{{route('modulo.index')}}" style="color:#ffff">{{ __('Módulos') }}</a> </li>
                        @endcan
                        @can('categoria.index')
                        <li class="nav-item "> <a class="nav-link active custom-botonmenu" href="{{route('categoria.index')}}" style="color:#ffff">{{ __('Categorías') }}</a> </li>  
                        @endcan  
                        @role('admin')       
                        <li class="nav-item dropdown">
                            
                            <a id="navbarDropdown" class="nav-link dropdown-toggle custom-botonmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#ffff">
                                    {{ __('Gestión de Usuarios') }} <span class="caret"></span>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item custom-botondesplegable" href="{{route('users.index')}}">
                                    {{ __('Crear / Inhabilitar') }}
                                </a> 

                                <a class="dropdown-item custom-botondesplegable" href="{{route('users.disable')}}">
                                    {{ __('Habilitar') }}
                                </a>
                                <a class="dropdown-item custom-botondesplegable" href="{{route('users.recordatorio')}}">
                                    {{ __('Recordatorio para realizar observaciónes') }}
                                </a>
                            </div>
                        </li>
                        @endrole
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle custom-botonmenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#ffff">
                                @if ((Auth::user()->imagen) == NULL)
                                    <img src="../images/def.jpg" class="imgRedonda"> 
                                @else
                                    <img src="../images/{{Auth::user()->imagen}}" class="imgRedonda"> 

                                @endif                                
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
