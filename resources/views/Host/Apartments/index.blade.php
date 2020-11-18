@extends('layouts.extranet')        
        
@section('content')

@foreach($apartments as $key=>$apartment)
            <div class="col-lg-3 mt-4 d-flex">
                <div class="card card-e">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $apartment->title }}</h6>
                    </div>
                    <img src="{{$cover[$key]->imgurl}}" class="card-img-top card-e-img-top" alt="{{ $apartment->title }}">
                    <div class="card-body d-flex flex-column">
                        <small>Numero stanze {{$apartment->n_rooms}}</small>
                        <small>Numero letti {{$apartment->n_beds}}</small>
                        <small>Numero bagni {{$apartment->n_bathrooms}}</small>
                    </div>
                    <a class="btn btn-primary" href="{{route('apartments.edit',$apartment->id)}}">MODIFICA</a>
                    <form action="{{route('apartments.destroy',$apartment->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-100 btn-danger">ELIMINA</button>
                    </form>
                </div>
            </div>
        @endforeach
        
@endsection
