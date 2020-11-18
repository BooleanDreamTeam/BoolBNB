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
                                    <input type="text" name="email" id="form-email" class="form-control">
                                    <label for="form-email">Your email</label>
                                </div>

                                <div class="md-form">
                                    <i class="fas fa-pencil-alt prefix grey-text"></i>
                                    <textarea id="form-text" name="message" class="form-control md-textarea" rows="3"></textarea>
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
@endsection
