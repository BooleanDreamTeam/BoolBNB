@extends('layouts.extranet')   

@section('content')

<span id="under">My messages</span>

<div id="reviews" class="container">
    <h1 class="text-primary">My Messages</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="d-none d-lg-table-cell" scope="col">Apartment</th>
                    <th class="d-none d-md-table-cell" scope="col">Received</th>
                    <th class="d-none d-lg-table-cell" scope="col">Email</th>
                    <th scope="col">Message</th>
                </tr> 
            </thead>
            <tbody> 
                @foreach ($allmessages as $message)
                <tr>
                    <td class="d-none d-lg-table-cell" scope="row"><img class="rounded rev-img" src="{{$message->imgurl}}" alt="image"></td>
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