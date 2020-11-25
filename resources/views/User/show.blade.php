@extends('layouts.extranet')
@section('script')
    
@endsection

@section('content')
    <div id="profile " class="d-flex w-100">
        <div class="col-sm-6">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        @if(!empty($user->provider_id))
                        <img src="{{($user->user_details->avatar)}}" class="card-img" alt="{{$user->name}}">
                        @else
                        <img src="/storage/{{($user->user_details->avatar)}}" class="card-img" alt="{{$user->name}}">
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
