


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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extranet.css') }}" rel="stylesheet">
   
</head>
<body>
    <!-- sidebar -->
<div class="row">
    <div class="sidebar-nav d-flex pl-4 pt-3 col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" >
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img class="img-fluid" id="logo" src="{{Storage::url('img/logo.png')}}" alt="logo">
                <img class="img-fluid" id="bnb" src="{{Storage::url('img/boolbnb-white.png')}}" alt="Boolbnb">
            </a>
            <div class="hr  mt-4 mb-4 mr-auto ml-auto"></div>
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <div class="hr  mt-4 mb-4 mr-auto ml-auto"></div>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>Profile</span>
            </a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                <i class="fas fa-fw fa-envelope"></i>    
                <span>Messages</span>
            </a>
            <a class="nav-link" id="v-pills-apartments-tab" data-toggle="pill" href="#v-pills-apartments" role="tab" aria-controls="v-pills-apartments" aria-selected="false">
                <i class="fas fa-fw fa-home"></i>    
                <span>My Apartments</span>
            </a>
            <a class="nav-link" id="v-pills-sponsorship-tab" data-toggle="pill" href="#v-pills-sponsorship" role="tab" aria-controls="v-pills-sponsorship" aria-selected="false">
                <i class="fas fa-fw  fa-ad"></i>
                <span>Advise</span>
            </a>
            <a class="nav-link" id="v-pills-analitics-tab" data-toggle="pill" href="#v-pills-analitics" role="tab" aria-controls="v-pills-analitics" aria-selected="false">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Analitics</span>
            </a>
        </div>
    </div>

    <div class="rightside d-none d-sm-block flex-column col-12 col-sm-6 col-md-8 col-lg-9 col-xl-10">
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

                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
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
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="">
                                Completa il tuo profilo
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
            
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="dashboard content p-4">
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-12 d-flex">

                            <!-- apartments -->
                            @foreach($apartments as $apartment)
                                <div class="col-2 mt-4 d-flex">
                                    <div class="card card_index">
                                        <img src=https://picsum.photos/300/300?random={{$apartment->id}}" class="card-img-top" alt="{{ $apartment->title }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $apartment->title }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="profile content">

                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <div class="messages content">

                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-apartments" role="tabpanel" aria-labelledby="v-pills-apartments-tab">
                <div class="my-apartments content">
                @foreach($apartments as $apartment)
                    <div class="col-2 mt-4 d-flex">
                        <div class="card card_index">
                            <img src=https://picsum.photos/300/300?random={{$apartment->id}}" class="card-img-top" alt="{{ $apartment->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-sponsorship" role="tabpanel" aria-labelledby="v-pills-sponsorship-tab">
                <div class="advise content">

                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-analitics" role="tabpanel" aria-labelledby="v-pills-analitics-tab">
                <div class="advise content">

                </div>
            </div>
        </div>


    </div>

 

</div>
</body>
</html>





