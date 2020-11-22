@extends('layouts.extranet')   

@section('content')


<div id="reviews" class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Apartment</th>
                    <th scope="col">Received</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                </tr> 
            </thead>
            <tbody> 
                @foreach ($allmessages as $message)
                <tr>
                    <td scope="row"><img class="rounded rev-img" src="{{$message->imgurl}}" alt="image"></td>
                    <td>{{$message->created_at}}</td>
                    <td>{{$message->email}}</td>
                    <td>{{$message->message}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection