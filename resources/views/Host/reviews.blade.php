@extends('layouts.extranet')   

@section('content')

<span id="under">My Reviews</span>

<div id="reviews" class="container">
    <h1 class="text-primary">My Reviews</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="d-none d-md-table-cell" scope="col">Apartment</th>
                    <th class="d-none d-lg-table-cell" scope="col">Received</th>
                    <th class="" scope="col">Name</th>
                    <th class="" scope="col">Text</th>
                    <th class="d-none d-md-table-cell" scope="col">Vote</th>
                </tr> 
            </thead>
            <tbody> 
                @foreach ($reviews as $review)
                <tr>
                    <td class="d-none d-md-table-cell" scope="row"><img class="rounded rev-img" src="{{$review->imgurl}}" alt="image"></td>
                    <td class="d-none d-lg-table-cell">{{$review->created_at}}</td>
                    <td class="">{{$review->name}}</td>
                    <td class="">{{$review->message}}</td>
                    <td class="d-none d-md-table-cell">{{$review->vote}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection