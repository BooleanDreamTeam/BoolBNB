@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection
@section('title')
    Boolbnb
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('content')


<section class="search-apartment">
    <div class="sx">

        <div class="btn-group m-4">
          <button type="button" class="btn dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Servizi
          </button>
          <div class="dropdown-menu">
              @foreach ($services as $service)
              <div class="dropdown-item">
                <label for="{{$service->name}}"></label>
                <input type="checkbox" name="{{$service->name}}" id="{{$service->name}}">
              </div>
              @endforeach
          </div>

          <button type="button" class="btn dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Stanze
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>

          <button type="button" class="btn dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Posti Letto
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>

          <button type="button" class="btn dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Raggio
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>

        </div>


        @foreach ($apartments as $apartment)
        <div class="bs-example m-4 rounded">
            <div class="card card_apartment_search" data-lat="{{$apartment->latitude}}" data-lng="{{$apartment->longitude}}">
                <div class="row no-gutters">
                    <div class="col-sm-5">
                        <img src="{{$apartment->cover->imgurl}}" class="card-img-top img-fluid" alt="{{$apartment->cover->imgurl}}">
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title">{{$apartment->title}}</h5>
                            <p class="card-text">{{$apartment->description}}</p>
                            <a href="#" class="btn btn-primary stretched-link">View Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="dx">

            <div class="col" >
                <div id="map_container" data-lat="{{$lat}}" data-lng="{{$lng}}">

                </div>
            </div>
    </div>
</section>
@endsection
