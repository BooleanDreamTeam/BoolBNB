@extends('layouts.extranet')        
        
@section('content')

<div class="row">
    @foreach($apartments as $apartment)
    
        <div class="col-xs-12 col-md-3 mt-4 d-flex">
            <div class="card ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $apartment->title }}</h6>
                </div>
                <img src=https://picsum.photos/300/300?random={{$apartment->id}}" class="card-img-top" alt="{{ $apartment->title }}">
                <div class="card-body">
                    
                </div>
            </div>
        </div>

    @endforeach
</div>


@endsection
