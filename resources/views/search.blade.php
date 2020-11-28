@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection
@section('js')
    <script src="https://cdn-webgl.wrld3d.com/wrldjs/dist/latest/wrld.js"></script>
@endsection
@section('title')
    Boolbnb
@endsection
@section('content')
<section class="search-apartment">
    <div class="sx">
      <form oninput='outputStanze.value = stanze.valueAsNumber,outputPostiletto.value = postiletto.valueAsNumber,outputRange.value = range.valueAsNumber' class="btn-group-search d-flex justify-content-center align-items-center flex-wrap">
          <div class="btn-group m-4 dropdown">
            <button type="button" class="btn dropdown-toggle mr-4" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Servizi
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($services as $service)
                <div class="dropdown-item">
                  <input type="checkbox" name="services" id="{{$service->name}}" value="{{$service->id}}">
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
                <input type="range" class="input_range_service" name="stanze" value="1" min="{{$RangeRooms[0]}}" max="{{$RangeRooms[1]}}" step="1" id="stanze">
                <span>{{$RangeRooms[1]}}</span>
              </div>
              <div class="text-center">
                <i class="fas fa-door-open"></i>
                <output name="outputStanze" for="stanze"></output>
              </div>
            </div>
          </div>
          <div class="col-md-4 p-2">
            <div class="range range-address d-flex justify-content-between">
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
                <input type="range" class="input_range_service" name="postiletto" value="1" min="{{$RangeBeds[0]}}" max="{{$RangeBeds[1]}}" step="1" id="">
                <span>{{$RangeBeds[1]}}</span>
              </div>
              <div class="text-center">
                <i class="fas fa-bed"></i>
                <output name="outputPostiletto" for="postiletto"></output>
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
              <span>-</span>
              <input type="range" class="input_range_service" value="50" name="range" min="1" max="100" step="1" id="">
              <span>+</span>
            </div>
            <div class="text-center">
              <i class="fas fa-street-view"></i>
              <output name="outputRange" for="range"></output>
            </div>
          </div>
        </div>
      </form>

      <div class="bs-example apartment_searched m-4 rounded">

        @if (count($apartments) <= 0)
                
              <h3 class="text-center wow animate__animated animate__pulse">Non ci sono risultati..<i class='far fa-grin-beam-sweat'></i></h3>

        @endif

        @foreach ($sponsored as $apartment)
            
        <div class="card card_apartment_search my-5 position-relative" data-lat="{{$apartment->latitude}}" data-lng="{{$apartment->longitude}}" data-id="{{$apartment->id}}"
          data-img="{{$apartment->cover->imgurl}}"
          data-title="{{$apartment->title}}" data-description="{{$apartment->description}}" data-address="{{$apartment->address}}" data-beds="{{$apartment->n_beds}}" data-rooms="{{$apartment->n_rooms}}" data-bathrooms="{{$apartment->n_bathrooms}}">
            <div class="star-sponsored p-3 position-absolute">
              <span>Sponsorizzato</span>
              <i class="fas fa-star"></i>
            </div>
            <div class="row no-gutters">
                <div class="card-img-search col-lg-7 col-md-7 col-sm-7 card-img-top img-fluid" style="background-image: url('{{$apartment->cover->imgurl}}')">

                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 d-flex flex-column justify-content-between">

                        <h3 class="card-title ml-3 mt-3">{{$apartment->title}}</h3>
                        <p class="card-text ml-3">{{substr($apartment->description, 0, 100 ).'....'}}</p>
                        <ul class="list-inline ml-3 list-icon-card-search p-2">
                            <li class="list-inline-item"><i class="fas fa-bed"></i> {{$apartment->n_beds}}</li>
                            <li class="list-inline-item"><i class="fas fa-door-open"></i> {{$apartment->n_rooms}}</li>
                            <li class="list-inline-item"><i class="fas fa-toilet"></i> {{$apartment->n_bathrooms}}</li>
                        </ul>
                        <ul class="list-inline ml-3">
                          @foreach ($apartment->services as $service)
                            <li class="list-inline-item text-uppercase">{{$service->name}}</li>
                          @endforeach
                        </ul>


                </div>
            </div>
        </div>

        @endforeach

          @foreach ($apartments as $apartment)

            <div class="card card_apartment_search my-5" data-lat="{{$apartment->latitude}}" data-lng="{{$apartment->longitude}}" data-id="{{$apartment->id}}"
              data-img="{{$apartment->cover->imgurl}}"
              data-title="{{$apartment->title}}" data-description="{{$apartment->description}}" data-address="{{$apartment->address}}" data-beds="{{$apartment->n_beds}}" data-rooms="{{$apartment->n_rooms}}" data-bathrooms="{{$apartment->n_bathrooms}}">
                <div class="row no-gutters">
                    <div class="card-img-search col-lg-7 col-md-7 col-sm-7 card-img-top img-fluid" style="background-image: url('{{$apartment->cover->imgurl}}')">

                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 d-flex flex-column justify-content-between">

                            <h3 class="card-title ml-3 mt-3">{{$apartment->title}}</h3>
                            <p class="card-text ml-3">{{substr($apartment->description, 0, 100 ).'....'}}</p>
                            <ul class="list-inline ml-3 list-icon-card-search p-2">
                                <li class="list-inline-item"><i class="fas fa-bed"></i> {{$apartment->n_beds}}</li>
                                <li class="list-inline-item"><i class="fas fa-door-open"></i> {{$apartment->n_rooms}}</li>
                                <li class="list-inline-item"><i class="fas fa-toilet"></i> {{$apartment->n_bathrooms}}</li>
                            </ul>
                            <ul class="list-inline ml-3">
                              @foreach ($apartment->services as $service)
                                <li class="list-inline-item text-uppercase">{{$service->name}}</li>
                              @endforeach
                            </ul>


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
      <div class="card card_apartment_search my-5" data-lat="@{{latitude}}" data-lng="@{{longitude}}" data-id="@{{id}}">
          <div class="row no-gutters">
              <div class="card-img-search col-lg-7 col-md-7 col-sm-7 card-img-top img-fluid " style="background-image: url('@{{cover}}')">

              </div>
              <div class="col-lg-5 col-md-5 col-sm-5 d-flex flex-column justify-content-between">

                      <h3 class="card-title ml-3 mt-3">@{{title}}</h3>
                      <p class="card-text ml-3">@{{description}}</p>
                      <ul class="list-inline ml-3 list-icon-card-search p-2">
                          <li class="list-inline-item"><i class="fas fa-bed"></i> @{{beds}}</li>
                          <li class="list-inline-item"><i class="fas fa-door-open"></i> @{{rooms}}</li>
                          <li class="list-inline-item"><i class="fas fa-toilet"></i> @{{bathrooms}}</li>
                      </ul>
                      <ul class="list-inline ml-3">
                          <li class="list-inline-item text-uppercase">@{{servizi}}</li>
                      </ul>
              </div>
          </div>
      </div>
</script>
</section>
@endsection
