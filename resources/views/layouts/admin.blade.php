<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <!-- Styles -->
    @yield('styles')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm head">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="../images/logo.png" width="170" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" class="fons btn btn-primary mr-2 text-white navbar-brand" data-toggle="modal"
                                    data-target="#createPx">
                                    Crear Paciente
                                </a>
                                <a class="fons btn btn-primary mr-2 text-white navbar-brand"
                                    href="{{ route('paciente.index') }}">
                                    Pacientes
                                </a>
                            </li>
                            <br>
                            <br>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <input type="checkbox" id="check">
        <label for="check">

        </label>
        <div class="mobile_nav">
            <div class="nav_bar">
                <i class="fa fa-bars nav_btn"></i>
            </div>
            <div class="mobile_nav_items">
                <a href="#" data-toggle="modal" data-target="#sv"><i class="fas fa-stethoscope"></i><span>Crear
                        Servicio</span></a>
                <a href="#" data-toggle="modal" data-target="#cdolor"><i
                        class="fas fa-notes-medical"></i><span>Ingresos</span></a>
                <a href="#" data-toggle="modal" data-target="#cestudio"><i class="fas fa-x-ray"></i><span>Crear
                        Usuario</span></a>
                <a href=""><i class="fas fa-file-medical"></i><span>Ver Usuarios</span></a>
                <a href=""><i class="fas fa-arrow-left"></i><span>Regresar</span></a>
            </div>
        </div>
        <!--mobile navigation bar end-->
        <!--sidebar start-->
        <div class="sidebar">
            <div class="profile_info">
                <h4>Panel de Administracion</h4>
                <h4>{{ auth()->user()->name }}</h4>
                {{-- <h6 class="colorb">Edad: {{ $hc->edad }}</h6>
                <h6 class="colorb">Dx: {{ $hc->diagnostico }}</h6>
                <h6 class="colorb">Enfermedad: {{ $hc->antecedentes_patologicos }}</h6> --}}
            </div>

            <a href="#" data-toggle="modal" data-target="#cservicio"><i class="fas fa-stethoscope"></i><span>Crear
                    Servicio</span></a>
            <a href="{{ route('admin.ingreso') }}"><i
                    class="fas fa-notes-medical"></i><span>Ingresos</span></a>
            <a href="#" data-toggle="modal" data-target="#cestudio"><i class="fas fa-x-ray"></i><span>Crear
                    Usuario</span></a>
            <a href=""><i class="fas fa-file-medical"></i><span>Ver Usuarios</span></a>
            <a href=""><i class="fas fa-arrow-left"></i><span>Regresar</span></a>
        </div>
        <!--sidebar end-->

        <main class="conten">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/signature_pad.js') }}" defer></script>
</body>

</html>
