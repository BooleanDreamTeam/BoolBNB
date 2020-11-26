@extends('layouts.extranet')
@section('script')
    
@endsection

@section('content')

    <span id="under">{{Auth::user()->name}}</span>

    <div id="profile " class="d-flex w-100">
        <div class="col-sm-6">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                         @if (!empty(Auth::user()->provider_id))
                            <img class="card-img" src="{{Auth::user()->user_details->avatar}}" alt="profile-img">
                        @else
                            @if(strpos(Auth::user()->user_details->avatar, 'storage') !== false)
                                <img class="card-img" src="{{Auth::user()->user_details->avatar}}" alt="profile-img">
                            @else
                                <img class="card-img" src="storage/{{Auth::user()->user_details->avatar}}" alt="profile-img">
                            @endif
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
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
        </div>
    </div>
@endsection
