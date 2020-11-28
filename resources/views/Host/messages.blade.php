@extends('layouts.extranet')   

@section('title')
Messaggi
@endsection


@section('content')

<span id="under">I miei Messaggi</span>

<div id="messages" class="container">
    <h1 class="text-primary">I miei Messaggi</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="d-none d-lg-table-cell" scope="col">Appartamento</th>
                    <th class="d-none d-md-table-cell" scope="col">Ricevuto il </th>
                    <th class="d-none d-lg-table-cell" scope="col">Email</th>
                    <th scope="col">Messaggi</th>
                </tr> 
            </thead>
            <tbody> 
                @foreach ($allmessages as $message)
                <tr>
                    <td class="d-none d-md-table-cell img rounded " scope="row" style="background-image:url('{{$message->imgurl}}')"></td>
                    <td class="d-none d-md-table-cell">{{$message->created_at}}</td>
                    <td class="d-none d-lg-table-cell">{{$message->email}}</td>
                    <td>{{$message->message}}
                        <small class="d-lg-none text-primary">{{$message->email}}</small>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection