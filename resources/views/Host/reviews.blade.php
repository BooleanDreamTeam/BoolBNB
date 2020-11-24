@extends('layouts.extranet')   

@section('content')
<div id="reviews" class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Apartment</th>
                    <th scope="col">Received</th>
                    <th scope="col">Name</th>
                    <th scope="col">Text</th>
                    <th scope="col">Vote</th>
                </tr> 
            </thead>
            <tbody> 
                @foreach ($reviews as $review)
                <tr>
                    <td scope="row"><img class="rounded rev-img" src="{{$review->imgurl}}" alt="image"></td>
                    <td>{{$review->created_at}}</td>
                    <td>{{$review->name}}</td>
                    <td>{{$review->message}}</td>
                    <td>{{$review->vote}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection