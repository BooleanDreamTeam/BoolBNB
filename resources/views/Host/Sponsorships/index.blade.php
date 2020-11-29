@extends('layouts.extranet')

@section('title')
I tuoi appartamenti in Evidenza
@endsection

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
    <div class="d-flex justify-content-between">
        <h1 class="text-primary">My Sponsorships</h1>
        <a href="{{ route('sponsorship.create') }}" class="btn btn-primary m-auto">METTI IN EVIDENZA UN ALTRO APPARTAMENTO</a>

    </div>

        <div class="row col-md-12 d-flex flex-wrap">

    
            @foreach ($apartments as $apartment)
            @if (count($apartment->sponsorships) > 0)
            <div class="s-card p-0 m-2 rounded col-lg-4">
                <div class="s-image rounded" style="background-image: url({{$apartment->cover->imgurl}})">

                </div>
                <div class="title d-flex justify-content-center align-items-center">
                    <strong class="card-text text-white">{{$apartment->title}}</strong>
                </div>
                <div class="card-body">
                    <p class="card-text">{{$apartment->address}}</p>
                @foreach ($apartment->sponsorships as $sponsor)
                    <p class="card-text">Sponsorizzazione: {{$sponsor->name}}</p>
                    <p class="card-text"></p>
                @endforeach
                    <div class="s-time d-flex justify-content-center align-items-center">
                        <i class="fas fa-hourglass-half pr-3"></i>
                        @if ($sponsor->pivot->expiration_date < now())
                            <span class="expiration_date_output">SCADUTO!</span> 
                        @elseif(now()->diff($sponsor->pivot->expiration_date)->format('%D') >= 1)
                            <span class="expiration_date_output">Scade tra circa {{now()->diff($sponsor->pivot->expiration_date)->format('%D')}} giorni</span>
                        @elseif(now()->diff($sponsor->pivot->expiration_date)->format('%H') > 1 && now()->diff($sponsor->pivot->expiration_date)->format('%H') < 24)
                            <span class="expiration_date_output">Scade tra circa {{now()->diff($sponsor->pivot->expiration_date)->format('%H')}} ore</span>    
                        @elseif(now()->diff($sponsor->pivot->expiration_date)->format('%H') <= 1)
                        <span class="expiration_date_output">Scade tra circa {{now()->diff($sponsor->pivot->expiration_date)->format('%I')}} minuti</span>
                        @elseif(now()->diff($sponsor->pivot->expiration_date)->format('%I') < 1 )
                            <span class="expiration_date_output">Scade tra qualche secondo..</span>                             
                        @else
                            <span class="expiration_date_output">Scade tra circa {{now()->diff($sponsor->pivot->expiration_date)->format('%H')}} ore</span>    
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

@endsection