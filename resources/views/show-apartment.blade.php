{{-- @dd($apartment) --}}
@extends('layouts.app')

@section('css')
<link href="{{ asset('css/show.css') }}" rel="stylesheet">

@endsection

@section('title')
    {{$apartment->title}}
@endsection

@section('js')
<script src="{{ asset('js/click.js') }}"></script>
@endsection

@section('content')

        <!-- section titolo MOCKUP3 -->

        <div class="container">

            {{-- ERROR --}}
            @if ($errors->any())
            <div class="alert alert-danger status mx-auto fixed-top m-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('status'))
            <div class="alert alert-success status mx-auto fixed-top m-5">
                {{ session('status') }}
            </div>
            @endif
            {{-- ERROR--}}


            <div class="card card_show mb-3" data-lat="{{$apartment->latitude}}"  data-lng="{{$apartment->longitude}}" data-id="{{$apartment->id}}">
                @foreach ($cover as $img)
                    <img class="card-img-top img-height" src="{{$img->imgurl}}" alt="{{$img->imgurl}}">
                @endforeach
                <div class="card-body">
                    <h5 class="card-title">{{$apartment->title}}</h5>
                    {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>

        </div>

        <section class="offer bg-light">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-6 wow animate__animated animate__fadeInLeft">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                              <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                              </ol>
                              <div class="carousel-inner">
                                <div class="carousel-item active">
                                  <img class="d-block w-100" src="https://www.thespruce.com/thmb/_WJOc-34GLmc5QAzOR-3TXKumu8=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/bed-and-fireplace-in-luxury-bedroom-748316169-37b1062605034b23ab6d193be9c58ef6.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="https://www.thespruce.com/thmb/_WJOc-34GLmc5QAzOR-3TXKumu8=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/bed-and-fireplace-in-luxury-bedroom-748316169-37b1062605034b23ab6d193be9c58ef6.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="https://www.thespruce.com/thmb/_WJOc-34GLmc5QAzOR-3TXKumu8=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/bed-and-fireplace-in-luxury-bedroom-748316169-37b1062605034b23ab6d193be9c58ef6.jpg" alt="Third slide">
                                </div>
                              </div>
                              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="details wow animate__animated animate__fadeInRight">
                            <h2 class="py-3">Descrizione</h2>
                            <p>{{$apartment->description}}</p>
                        </div>



                        <div class="detail_bedroom wow animate__animated animate__fadeInRight animate__delay-1s">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-light"><i class="fas fa-bed"></i></li>
                                <li class="list-group-item list-group-item-light"><i class="fas fa-wifi"></i></li>
                                <li class="list-group-item list-group-item-light"><i class="fas fa-bed"></i></li>
                                <li class="list-group-item list-group-item-light"><i class="fas fa-wifi"></i></li>
                                <li class="list-group-item list-group-item-light"><i class="fas fa-bed"></i></li>
                            </ul>
                            {{-- <h5 class="pt-5 pl-3">Bedroom</h5>
                            <p class="pl-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p> --}}
                        </div>



                    </div>
                </div>
            </div>
        </section>

        <section class="offer bg-light">

            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-6 wow animate__animated animate__flipInX animate__delay-1s" >
                        <div id="map_container" style="height:600px;">

                        </div>
                    </div>


                    <form method="post" action="{{route('sendMessage')}}" class="col-lg-5 mb-lg-0 mb-4 wow animate__animated animate__fadeInRight animate__delay-1s">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <!-- Header -->
                                <div class="form-header blue accent-1">
                                    <h3 class="mt-2"><i class="fas fa-envelope"></i> Write to us:</h3>
                                </div>

                                <p class="dark-grey-text">We'll write rarely, but only the best content.</p>

                                  <!-- Body -->
                                <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                                <div class="md-form">
                                    <i class="fas fa-envelope prefix grey-text"></i>
                                    @guest
                                        <input type="text" name="email" id="form-email" class="form-control" required>
                                    @else
                                        <input type="text" name="email" id="form-email" value="{{Auth::user()->email}}" class="form-control" required>
                                    @endguest
                                    <label for="form-email">Your email</label>
                                </div>

                                <div class="md-form">
                                    <i class="fas fa-pencil-alt prefix grey-text"></i>
                                    <textarea id="form-text" name="message" class="form-control md-textarea" rows="3" required></textarea>
                                    <label for="form-text">Message</label>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-light-blue">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>








        <section id="up" class="container d-none d-md-flex">
            <div class="ctn-first col-6 py-2 pl-2 pr-1">
                <div class="img p-5">

                </div>
            </div>

            <div class="cont-second col-6 d-flex flex-column pl-1 pt-2 pr-2 pb-2">
                <div class="img-ret pb-1">
                    <div class="img">

                    </div>
                </div>
                <div class="img-qdr d-flex m-0">
                    <div class="col-6 uno pt-1 px-0 pr-1">
                        <div class="img">

                        </div>
                    </div>
                    <div class="col-6 due pt-1 px-0 pl-1">
                        <div class="img">

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mobile" class="container d-block d-md-none">
            <div id="carouselExampleControls" class="carousel slide p-2" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="https://q-xx.bstatic.com/xdata/images/hotel/840x460/248963502.jpg?k=309d99860c910fbf7844859b09feca1483f39c0c79a9906e65e994ab2c1daef1&o=" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://cf.bstatic.com/images/hotel/max1024x768/161/161745727.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://q-xx.bstatic.com/xdata/images/hotel/840x460/248963502.jpg?k=309d99860c910fbf7844859b09feca1483f39c0c79a9906e65e994ab2c1daef1&o=" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://q-xx.bstatic.com/xdata/images/hotel/840x460/248963502.jpg?k=309d99860c910fbf7844859b09feca1483f39c0c79a9906e65e994ab2c1daef1&o=" alt="Fourth slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
            </div>

        </section>



        <section id="" class="container  d-md-flex flex-column">
            <div class="col-lg-12 col-md-12 col-sm-12 p-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Descrione</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <h5 class="card-title">Servizi</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                    </div>
                </div>
            </div>

        </section>


        <section id="" class="container  d-md-flex flex-column">

            <div class="col-lg-12 col-md-12 col-sm-12 p-2">
                <div class="jumbotron">
                    <h2 class="display-4">MAPPA!</h2>
                    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                    <hr class="my-4">
                    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                    </p>
                </div>
            </div>
        </section>

        <section id="" class="container  d-md-flex">

            
                <div class="col-lg-6 col-md-6 col-sm-12 p-2">
                    <div class="jumbotron">
                        <h2 class="display-4">Write To Us!</h2>
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <hr class="my-4">
                        <label for="exampleFormControlTextarea1">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <a class="btn btn-primary btn-lg" href="#" role="button">Submit</a>
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 p-2">
                    <div class="jumbotron">
                        <h2 class="display-4">Write To Us!</h2>
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <hr class="my-4">
                        <label for="exampleFormControlTextarea1">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <a class="btn btn-primary btn-lg" href="#" role="button">Submit</a>
                        </p>
                    </div>
                </div>
        </section>





@endsection
