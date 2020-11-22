@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('title')
    Boolbnb
@endsection

@section('content')


<section class="search-apartment">

    <div class="sx">

      <form class="btn-group-search d-flex justify-content-center align-items-center">
          <div class="btn-group m-4 dropdown">
            <button type="button" class="btn dropdown-toggle mr-4" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Servizi
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($services as $service)
                <div class="dropdown-item">
                  <input type="checkbox" name="services[]" id="{{$service->name}}" value="{{$service->id}}">
                  <label for="{{$service->name}}">{{$service->name}}</label>
                </div>
                @endforeach
            </div>
          </div>  

          <div class="btn-group m-4 dropdown">
            <button type="button" class="btn dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Stanze
            </button>
            <div class="dropdown-menu p-2">
              <label for="Stanze">N. Stanze</label>
              <div class="range d-flex justify-content-between">
                <span>{{$RangeRooms[0]}}</span>
                <input type="range" class="input_range_service" name="stanze" min="{{$RangeRooms[0]}}" max="{{$RangeRooms[1]}}" step="1" id="">
                <span>{{$RangeRooms[1]}}</span>
              </div>
            </div>
          </div>

          <div class="col-md-4 p-2">
            <div class="range d-flex justify-content-between">
              <input id="address-input" type="text" value="{{$addressSearch}}" class="p-4" name="address">
              <input type="hidden" name="cordinates" id="cordinates" value="{{$arrayCordinates[0]}},{{$arrayCordinates[1]}}">
            </div>
          </div>


          <div class="btn-group m-4 dropdown">
            <button type="button" class="btn dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Posti Letto
            </button>
            <div class="dropdown-menu p-2">
              <label for="Stanze">N. Letti</label>
              <div class="range d-flex justify-content-between">
                <span>{{$RangeBeds[0]}}</span>
                <input type="range" class="input_range_service" name="postiletto" min="{{$RangeBeds[0]}}" max="{{$RangeBeds[1]}}" step="1" id="">
                <span>{{$RangeBeds[1]}}</span>
              </div>
            </div>
          </div>
        
        
        <div class="btn-group m-4 dropdown">
          <button type="button" class="btn dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Raggio
          </button>
          <div class="dropdown-menu p-2">
            <label for="Stanze">Raggio</label>
            <div class="range d-flex justify-content-between">
              <span>1</span>
              <input type="range" class="input_range_service" name="range" min="1" max="100" step="1" id="">
              <span>100</span>
            </div>
          </div>
        </div>  
      </form>  

      <div class="bs-example m-4 rounded">
          @foreach ($apartments as $apartment)

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

          @endforeach
      </div>
    </div>

    <div class="dx">

            <div class="col" >
                <div id="map_container" data-lat="{{$lat}}" data-lng="{{$lng}}">

                </div>
            </div>
    </div>

    {{-- TEMPLATE HANDLEBARS --}}

<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

<script id="template" type="text/x-handlebars-template">

      <div class="card card_apartment_search" data-lat="@{{latitude}}" data-lng="@{{longitude}}">
          <div class="row no-gutters">
              <div class="col-sm-5">
                <img src="@{{cover}}" class="card-img-top img-fluid" alt="@{{cover}}">
              </div>
              <div class="col-sm-7">
                  <div class="card-body">
                      <h5 class="card-title">@{{title}}</h5>
                      <p class="card-text">@{{description}}</p>
                      <a href="#" class="btn btn-primary stretched-link">View Profile</a>
                  </div>
              </div>
          </div>
      </div>

</script>

</section>
@endsection
