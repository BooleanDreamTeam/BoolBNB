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
   
    <!-- <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extranet.css') }}" rel="stylesheet">
   
</head>
<body>
    <!-- sidebar -->
<div class="row row-main">
    <div class="sidebar-nav d-flex pl-4 pt-3 col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" >
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">

                <img class="img-fluid" id="logo" src="{{Storage::url('img/logo.png')}}" alt="logo">
                <img class="img-fluid write" id="bnb" src="{{Storage::url('img/boolbnb-white.png')}}" alt="Boolbnb">
            </a>
            <div class="hr  mt-4 mb-4 mr-auto ml-auto"></div>
            <a href="{{Route('dashboard')}}" class="nav-link active" id="v-pills-home-tab" role="tab" aria-controls="v-pills-home" aria-selected="true">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <div class="hr  mt-4 mb-4 mr-auto ml-auto"></div>
            <a href="" class="nav-link" id="v-pills-profile-tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>Profile</span>
            </a>
            <a class="nav-link" id="v-pills-messages-tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                <i class="fas fa-fw fa-envelope"></i>    
                <span>Messages</span>
            </a>
            <a href="{{Route('apartments.index')}}" class="nav-link" id="v-pills-apartments-tab" role="tab" aria-controls="v-pills-apartments" aria-selected="false">
                <i class="fas fa-fw fa-home"></i>    
                <span>My Apartments</span>
            </a>
            <a class="nav-link" id="v-pills-sponsorship-tab" href="#v-pills-sponsorship" role="tab" aria-controls="v-pills-sponsorship" aria-selected="false">
                <i class="fas fa-fw  fa-ad"></i>
                <span>Advise</span>
            </a>
            <a class="nav-link" id="v-pills-analitics-tab" href="#v-pills-analitics" role="tab" aria-controls="v-pills-analitics" aria-selected="false">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Analitics</span>
            </a>
        </div>
    </div>

    <div class="rightside d-none d-sm-block flex-column col-12 col-sm-6 col-md-8  col-lg-9 col-xl-10">
        <!-- topbar -->
        <nav class="topbar pd-2 navbar navbar-expand navbar-light bg-white mb-4 static-top shadow">
            

            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link messages dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="little-env fas fa-envelope fa-fw"></i>
                   
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        @foreach($messages as $message )
  
                        
                        <a class="messages dropdown-item d-flex align-items-center" href="">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded app-img" src="{{$message->imgurl}}" alt="">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="message-text">
                                <div class="text">
                                    <p class="text-wrap">{{$message->message}}</p>
                                </div>
                                <div class="small text-gray-500">{{$message->email}}</div>
                            </div>
                        </a>
                        @endforeach
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (!empty(Auth::user()->provider_id))
                                <img class="rounded-circle" src="{{Auth::user()->user_details->avatar}}" alt="profile-img">  
                                
                                @else

                                <img class="rounded-circle" src="{{Storage::url(Auth::user()->user_details->avatar)}}" alt="profile-img"> 
                                
                            @endif                                   
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="">
                                Completa il tuo profilo
                            </a>
                            <a class="dropdown-item" href="">
                                Nuovo Appartamento
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}">
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

