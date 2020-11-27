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

    @if($n > 3)
        <section id="up" class="container d-none d-md-flex">
            <div class="ctn-first col-6 py-2 pl-2 pr-1">
                <div class="img p-5" style="background-image: url({{$cover[0]->imgurl}})">

                </div>
            </div>

            <div class="cont-second col-6 d-flex flex-column pl-1 pt-2 pr-2 pb-2">
                <div class="img-ret pb-1">
                    <div class="img" style="background-image: url({{$images[0]->imgurl}})">

                    </div>
                </div>
                <div class="img-qdr d-flex m-0">
                    <div class="col-6 uno pt-1 px-0 pr-1">
                        <div class="img" style="background-image: url({{$images[1]->imgurl}})">

                        </div>
                    </div>
                    <div class="col-6 due pt-1 px-0 pl-1">
                        <div class="img" style="background-image: url({{$images[2]->imgurl}})">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="mobile" class="container d-block d-md-none p-0 mb-5">
            <div id="carouselExampleControls" class="carousel slide p-2" data-ride="carousel">
                  <div class="carousel-inner">
                    
                    @foreach ($images as $key => $image)

                        @if ($key == 0)

                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{$image->imgurl}}" alt="First slide">
                            </div>    

                        @else    
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{$image->imgurl}}" alt="First slide">
                            </div>    
                        @endif
                        

                    @endforeach

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
    @else
        <section id="mobile" class="container d-block p-0 mb-5">
            <div id="carouselExampleControls" class="carousel slide p-2" data-ride="carousel">
                <div class="carousel-inner">
                    
                    @foreach ($images as $key => $image)

                        @if ($key == 0)
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{$image->imgurl}}" alt="First slide">
                            </div>    
                        @else    
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{$image->imgurl}}" alt="First slide">
                            </div>    
                        @endif
                    @endforeach

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
    @endif
        <!-- <section id="mobile" class="container d-block d-md-none p-0 mb-5">
            <div id="carouselExampleControls" class="carousel slide p-2" data-ride="carousel">
                  <div class="carousel-inner">
                    
                    @foreach ($images as $key => $image)

                        @if ($key == 0)

                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{$image->imgurl}}" alt="First slide">
                            </div>    

                        @else    
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{$image->imgurl}}" alt="First slide">
                            </div>    
                        @endif
                        

                    @endforeach

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

        </section> -->



        <section id="" class="container  d-md-flex p-0">
            <div class="col-lg-12 col-md-12 col-sm-12 p-2">
                <div class="card card_show" data-lat="{{$apartment->latitude}}"  data-lng="{{$apartment->longitude}}" data-id="{{$apartment->id}}">
                    <div class="card-body">
                        <div class="description">
                            <h5 class="card-title">Descrizione</h5>
                            <p class="card-text">{{$apartment->description}}</p>
                        </div>
                        <div class="services mt-3">
                            <h5 class="card-title">Servizi</h5>
                            <ul class="list-group d-flex flex-row">
                                @foreach ($apartment->services as $service)
                                    
                                    <li>{{$service->name}} | </li>

                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div>
            </div>

        </section>


        <section id="" class="container  d-md-flex flex-column p-0 ">
            <div class="col-lg-12 col-md-12 col-sm-12 p-2">

                    <div id="map_container" style="height:600px;">

                    </div>
                {{-- </div> --}}
            </div>
        </section>

        <section id="" class="container  d-md-flex p-0">


                <form method="post" action="{{route('sendMessage')}}" class="col-lg-6 mb-lg-0 mb-4 p-2 wow animate__animated animate__fadeInLeft animate__delay-1s">
                    @csrf
                    <div class="jumbotron">
                        <h3 class="mt-2"><i class="fas fa-envelope"></i> Write to us:</h3>
                        @guest
                            <input type="text" name="email" id="form-email" class="form-control" required>
                        @else
                            <input type="text" name="email" id="form-email" value="{{Auth::user()->email}}" class="form-control" required>
                        @endguest
                        <hr class="my-4">
                        <i class="fas fa-pencil-alt prefix grey-text"></i>
                        <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required></textarea>
                        <button type="submit" class="btn btn-primary btn-lg mt-5" href="#" role="button">Submit</button>
                        <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                        @auth

                        <input type="hidden" name="user_name" value="{{Auth::user()->name}}">
                            
                        @endauth
                    </div>
                </form>

                <div class="col-lg-6 col-md-6 col-sm-12 p-2 wow animate__animated animate__fadeInRight animate__delay-1s">
                    <div class="jumbotron review">
                        <form oninput='outputvote.value = vote_review.valueAsNumber'>
                            <input type="hidden" id="id_apartment_review" value="{{$apartment->id}}">
                            <h3 class="">Scrivi una recesione!</h3>
                            <textarea class="form-control" name="message" id="message_review" rows="3" required></textarea>
                            <div class="text-center d-flex flex-column justify-content-center align-items-center">
                                <input type="range" name="vote_review" value="1" min="1" max="5" id="vote_review">
                                <i class="fas fa-star"></i>
                                <output name="outputvote" for="vote">1</output>
                            </div>
                            @auth
                                <input type="hidden" name="user_name_reviews" value="{{Auth::user()->name}}">
                            @endauth
                            @guest
                                <input type="hidden" name="user_name_reviews" value="sconosciuto">
                            @endguest
                                
                            <a class="btn reviews_send btn-primary btn-lg mt-5" role="button">Submit</a>
                        </form>
                        <hr class="my-4">
                        <div id="reviews" class="">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Text</th>
                                            <th scope="col">Received</th>
                                            <th scope="col">Vote</th>
                                        </tr>
                                    </thead>
                                    <tbody class="reviews_container">
                                          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

         {{-- TEMPLATE HANDLEBARS --}}

<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

<script id="template_reviews" type="text/x-handlebars-template">

    <tr>                                             
        <td>@{{name}}</td>
        <td>@{{message}}</td>
        <td>@{{created_at}}</td>
        <td>@{{vote}}</td>
    </tr>    
    

</script>





@endsection
