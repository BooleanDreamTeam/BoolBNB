@extends('layouts.extranet')

@section('title')
Il tuo profilo
@endsection

@section('script')
    
@endsection

@section('content')


    <span id="under">{{Auth::user()->name}}</span>
    <div class="container">

        <div class="row d-flex">
            <div class="col-3">
                @if (!empty(Auth::user()->provider_id))
                    <img class="card-img rounded-circle" src="{{Auth::user()->user_details->avatar}}" alt="profile-img">
                @else
                    @if(strpos(Auth::user()->user_details->avatar, 'storage') !== false)
                        <img class="card-img" src="{{Auth::user()->user_details->avatar}}" alt="profile-img">
                    @else
                        <img class="card-img" src="storage/{{Auth::user()->user_details->avatar}}" alt="profile-img">
                    @endif
                @endif
            </div>
            <div class="col-7">
                <div class="">
                    <h2 class="card-title">{{$user->name}}</h2>
                    <p class="card-text">{{$user->email}}</p>
                    <p>Data di Nascita: 
                        <span>
                        @if(!empty($user->user_details->birth_date))
                            {{$user->user_details->birth_date}}
                        @else
                            Dato non completo
                        @endif
                        </span>
                    </p>
                    <p>Indirizzo: 
                        <span>
                            @if(!empty($user->user_details->address))
                                {{$user->user_details->address}}
                            @else
                                Dato non completo
                            @endif
                        </span>
                    </p>
                    <p>Numero di telefono: 
                        <span>
                        @if(!empty($user->user_details->phone_n))
                            {{$user->user_details->phone_n}}
                        @else
                            Dato non completo
                        @endif
                        </span>
                    </p>
                    <p class="card-text"><small class="text-muted">registrato il {{$user->created_at}}</small></p>
                    
                </div>
                <a href="{{route('user.edit', ['user' => Auth::id()])}}" class="btn btn-primary">Modifica il tuo profilo</a>
            </div>
        </div>
         
       
    </div>

    
@endsection
