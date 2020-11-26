@extends('layouts.extranet')

@section ('css')

@endsection


@section('content')

<span id="under">My Apartments</span>

<div id="apartment" class="apartments col-12">
<h1 class="text-primary">My Apartments</h2>
    <div class="row d-flex flewx-wrap">
    @foreach($apartments as $apartment)

    <div class="i-card-e mb-3 rounded p-0 d-flex align-items-start col-12 col-lg-6">
        <div class="i-card-e-img-top" style="background-image: url({{$apartment->cover->imgurl}}"></div>
        <div class="i-card-body p-2 w-100 d-flex justify-content-between">
            <div class="i-left d-flex flex-column justify-content-between">
                <div class="i-top-card">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $apartment->title }}</h6>
                </div>
                <div class="det-ap d-flex flex-column ">
                    <small>Numero stanze {{$apartment->n_rooms}}</small>
                    <small>Numero letti {{$apartment->n_beds}}</small>
                    <small>Numero bagni {{$apartment->n_bathrooms}}</small>
                    <strong class="text-primary m-0 p-0">Indirizzo {{$apartment->address}}</strong>
                </div>
            </div>
            <div class="i-right d-flex flex-column justify-content-between align-items-end ">
                <div class="d-flex align-items-center">
                    <span>Voto medio </span>
                    <div class="i-vote text-center rounded ml-2">{{$apartment->rating()}}</div>
                </div>
                <div class="buttons">
                    <form id="form" method="post" action="{{route('active', $apartment->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @if ($apartment->is_active == true)
                        <input type="hidden" class="form-control" name="is_active" id="Stanze" value="0">
                        <button type="submit" class="btn btn-outline-secondary w-100">Disattiva</button>
                        @else
                        <input type="hidden" class="form-control" name="is_active" id="Stanze" value="1">
                        <button type="submit" class="btn btn-outline-success w-100">Attiva</button>
                        @endif
                    </form>
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
    
</div>

    
@endsection
