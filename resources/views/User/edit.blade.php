@extends('layouts.extranet')

@section('script')
<script src="{{ asset('js/uservalidation.js') }}"></script>
@endsection

@section('content')
<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 jumbotron">

                {{-- validazione campi  --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>  
                        @endforeach
                    </ul>
                </div>
                @endif
                    <form id="form" method="post" action="{{ route('user.update', ['user' => Auth::id()])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name"  minlength="2" id="name" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Modifica la tua password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        <div class="form-group">
                            <label for="password">Conferma la modifica</label>
                            <input type="password" class="form-control" name="password_confirmation" autocomplete="password"  id="password_confirm">
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Data di nascita:</label>
                            <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ $user->user_details->birth_date }}">
                        </div>

                        <div class="form-group">
                            <label for="Address">Indirizzo:</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $user->user_details->address }}">
                        </div>

                        <div class="form-group">
                            <label for="phone_n">Telefono:</label>
                            <input type="text" class="form-control" name="phone_n" id="phone_n" value="{{ $user->user_details->phone_n }}">
                        </div>
                        @if (empty($user->provider_id))
                        <div class="form-group">
                            <label for="avatar">Inserisci una foto</label>
                            <input type="file" class="form-control-file" name="avatar" id="avatar">
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary" id="send">Invia modifiche</button>
                    </form>
            </div>
        </div>


@endsection('content')