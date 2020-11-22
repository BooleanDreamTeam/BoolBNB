<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')

    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand p-0" href="{{ url('/') }}">
                    <img src="{{Storage::url('img/logo.png')}}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <li class="nav-item" style="display: flex;">
                                <button class="btn-nav mr-3">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </button>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <button class="btn-nav">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </button>
                                </li>
                            @endif
                        @else
                            <li class="nav-item p-0 dropdown">
                                <a id="navbarDropdown" class="nav-link p-0 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (!empty(Auth::user()->provider_id))
                                        <img class="avatar rounded-circle" src="{{Auth::user()->user_details->avatar}}" alt="profile-img">
                                    @elseif (!(DB::table('user_details')->select('avatar')->where('user_details.user_id','=', Auth::id())->get()))
                                        <img class="avatar rounded-circle" src="{{Auth::user()->user_details->avatar}}" alt="profile-img">
                                    @else
                                    <img class="avatar rounded-circle" src="" alt="profile-img">
                                    @endif

                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right wow animate__animated animate__bounceInDown" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->user_type->name == 'Host')
                                        <a class="dropdown-item" href="{{route('dashboard')}}">
                                            DashBoard
                                        </a>
                                    @elseif (Auth::user()->user_type->name == 'User')
                                        <a class="dropdown-item" href="{{route('firstapartment.create')}}">
                                            Inserisci un Appartamento
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main>
            @yield('content')
        </main>
    </div>
    @yield('script')
    @include('partials.footer')
</body>
</html>
