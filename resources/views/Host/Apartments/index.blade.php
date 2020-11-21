@extends('layouts.extranet') 

@section ('css')
<link href="{{ asset('css/partials/_cardsap.css') }}" rel="stylesheet">
@endsection

        
@section('content')
<h2 >My Appartments</h2>
    <div id="apartment"class="apartments container d-flex flex-column">
    @foreach($apartments as $apartment)


       
            <div class="d-flex i-card-e mb-3 rounded ">
                <div class="i-card-e-img-top" style="background-image: url({{$apartment->imgurl}}"></div>
              
                <div class="i-card-body p-2 d-flex ">
                    <div class="i-left d-flex flex-column justify-content-between">
                        <div class="i-top-card">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $apartment->title }}</h6>
                        </div>
                        <div class="det-ap d-flex flex-column justify-content-between">
                            <small>Numero stanze {{$apartment->n_rooms}}</small>
                            <small>Numero letti {{$apartment->n_beds}}</small>
                            <small>Numero bagni {{$apartment->n_bathrooms}}</small>
                        </div>


                    </div>

                    <div class="i-right d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-end w-100">
                            <div class="i-vote text-center rounded">{{round($apartment->vote, 1)}}</div>
                        </div>
                        
                        <div class="buttons">
                            <a class="btn btn-primary" href="{{route('apartments.edit',$apartment->id)}}">MODIFICA</a>
                            <form action="{{route('apartments.destroy',$apartment->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn w-100 btn-danger">ELIMINA</button>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

    @endforeach
    </div>
@endsection
