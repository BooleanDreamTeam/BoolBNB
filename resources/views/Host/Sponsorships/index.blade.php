@extends('layouts.extranet')

@section('content')
<span id="under">Sponsorships</span>

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


    
    <div id="sponsorships" class="container">
    <h1 class="text-primary">My Sponsorships</h1>

        <div class="row col-md-12 d-flex flex-wrap">

    
            @foreach ($apartments as $apartment)
            @if (count($apartment->sponsorships) > 0)
            <div class="s-card p-0 rounded">
                <div class="s-image rounded" style="background-image: url({{$apartment->cover->imgurl}})">

                </div>
                <div class="title d-flex justify-content-center align-items-center">
                    <strong class="card-text text-white">{{$apartment->title}}</strong>
                </div>
                <div class="card-body">
                    <p class="card-text">{{$apartment->address}}</p>
                @foreach ($apartment->sponsorships as $sponsor)
                    <p class="card-text">Sponsorizzazione: {{$sponsor->name}}</p>
                    <p class="card-text">Scadenza: {{$sponsor->pivot->expiration_date}}</p>
                @endforeach
                </div>
                <div class="s-time d-flex justify-content-center align-items-center">
                    <i class="fas fa-hourglass-half pr-3"></i>
                    <span>05:04:00</span>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

@endsection