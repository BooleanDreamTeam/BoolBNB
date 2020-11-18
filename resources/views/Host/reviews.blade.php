@extends('layouts.extranet')   

@section('content')
<div class="col-xl-12 p-3 d-flex" id="reviews">
            <div class="d-flex flex-column">
                @foreach ($reviews as $review)
                    <div class="review p-1 d-flex"> 
                        <div class="image-rev mr-3">
                            <img class="rounded rev-img" src="{{$review->imgurl}}" alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="review-text">
                            <div class="text">
                                <p class="text-wrap">{{$review->message}}</p>
                            </div>
                            <div class="small text-gray-500">{{$review->name}}</div>
                        </div>
            
                    </div>

                @endforeach
            </div>

@endsection