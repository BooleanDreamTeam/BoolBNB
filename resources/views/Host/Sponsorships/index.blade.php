@extends('layouts.extranet')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger fixed-bottom">
            <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
            </ul>
        </div>
    @endif

    @if (session('success_message'))
        <div class="alert alert-success fixed-bottom">
            {{ session('success_message') }}
        </div>
    @endif

    <div class="container col-md-12 d-flex justify-content-around flex-wrap">
        @foreach ($apartments as $apartment)
            @if (count($apartment->sponsorships) > 0)
            <div class="card" style="width: 18rem;">
                <img src="{{$apartment->cover->imgurl}}" class="card-img-top img-fluid" alt="{{$apartment->cover}}">
                <div class="card-body">
                    <p class="card-text">{{$apartment->address}}</p>
                @foreach ($apartment->sponsorships as $sponsor)
                    <p class="card-text">Sponsorizzazione: {{$sponsor->name}}</p>
                    <p class="card-text">Scadenza: {{$sponsor->pivot->expiration_date}}</p>
                    </div>
                @endforeach
            </div>
            @endif
        @endforeach
    </div>

@endsection