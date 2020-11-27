<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Extranet</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extranet.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body>
    <!-- sidebar -->
    <div class="row row-main d-flex" id="all">
        <div id="sidebar" class="sidebar-nav d-flex px-sm-1 px-md-3 px-lg-4 col-2 col-sm-4 col-lg-3 col-xl-2">
            <div class="nav flex-column align-center nav-pills" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <a class="navbar-brand m-0 d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                    <img class="" src="{{ Storage::url('img/logo.png') }}" alt="logo">
                    <!-- <img class="img-fluid write d-none d-sm-block" id="bnb" src="{{ Storage::url('img/boolbnb-white.png') }}" alt="Boolbnb"> -->
                </a>

                <a href="{{ Route('dashboard') }}" class="nav_item nav-link active" id="v-pills-home-tab" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span class="d-none d-sm-inline">Dashboard</span>
                </a>
                            
                <a href="{{route('user.show', ['user' => Auth::id()])}}" class="nav-link" id="v-pills-profile-tab" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span class="d-none d-sm-inline">Profile</span>
                </a>
                <a href="{{ Route('mymessages') }}" class="nav-link" id="v-pills-messages-tab" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span class="d-none d-sm-inline">Messages</span>
                </a>
                <a href="{{ Route('apartments.index') }}" class="nav-link" id="v-pills-apartments-tab" role="tab"
                    aria-controls="v-pills-apartments" aria-selected="false">
                    <i class="fas fa-fw fa-home"></i>
                    <span class="d-none d-sm-inline">My Apartments</span>
                </a>
                <a href="{{ route('sponsorship.index') }}" class="nav-link" id="v-pills-sponsorship-tab" role="tab"
                    aria-controls="v-pills-sponsorship" aria-selected="false">
                    <i class="fas fa-star"></i>
                    <span class="d-none d-sm-inline">Sponsorships</span>
                </a>
                <a href="{{ route('myreviews') }}" class="nav-link id=" v-pills-reviews-tab" href="#v-pills-reviews"
                    role="tab" aria-controls="v-pills-reviews" aria-selected="false">
                    <i class="fas fa-fw fa-pencil-alt"></i>
                    <span class="d-none d-sm-inline">Reviews</span>
                </a>

            </div>
        </div>

        <div class="rightside flex-column col-10 col-sm-8 col-lg-9 col-xl-10">
            <!-- topbar -->
            <nav class="topbar pd-2 navbar navbar-expand navbar-light bg-white mb-4 static-top shadow">


                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1 d-flex align-items-center">
                        <div class="nav-link">Hi {{ Auth::user()->name }}</div>
                        <a class="nav-link messages dropdown-toggle" href="#" id="messagesDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="little-env fas fa-envelope fa-fw"></i>

                            <!-- Counter - Messages -->
                            <!-- <span class="badge badge-danger badge-counter">7</span> -->
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow"
                            aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            
                            @if(empty($messages))
                            <p>Non ci sono messaggi</p>
                            @else
                            @foreach ($messages as $message)
                                <a class="messages dropdown-item d-flex align-items-center" href="{{route('mymessages')}}">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded app-img" src="{{ $message->imgurl }}" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="message-text">
                                        <div class="text">
                                            <p class="text-wrap">{{ $message->message }}</p>
                                        </div>
                                        <div class="small text-gray-500">{{ $message->email }}</div>
                                    </div>
                                </a>
                            @endforeach
                            @endif
                        </div>
                    </li>



                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item" style="display: flex;">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (!empty(Auth::user()->provider_id))
                                        <img class="avatar rounded-circle" src="{{Auth::user()->user_details->avatar}}" alt="profile-img1">
                                @else
                                    @if(strpos(Auth::user()->user_details->avatar, 'storage') !== false)
                                        <img class="avatar rounded-circle" src="{{Auth::user()->user_details->avatar}}" alt="profile-img2">
                                    @else
                                        <img class="avatar rounded-circle" src="{{Storage::url(Auth::user()->user_details->avatar)}}" alt="profile-img3">
                                    @endif
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <a class="dropdown-item" href="">
                                    Completa il tuo profilo
                                </a>
                                <a class="dropdown-item" href="{{ route('apartments.create') }}">
                                    Nuovo Appartamento
                                </a>
                                <a class="dropdown-item" href="{{ route('sponsorship.create') }}">
                                    Nuova sponsorizzazione
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </nav>

            <!-- contents -->
            <div class="row col-xl-12 p-4">
                @yield('content')
            </div>
        </div>
    </div>
    @yield('script')
</body>

</html>
