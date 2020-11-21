@extends('layouts.extranet')    

@section('script')
    <script src="{{ asset('js/input-validation.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

        
@section('content')

{{-- ERROR --}}
    @if ($errors->any())
    <div class="alert alert-danger status mx-auto fixed-top m-5">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

@if (session('status'))
<div class="alert alert-success status mx-auto fixed-top m-5">
    {{ session('status') }}
</div>
@endif
{{-- ERROR--}}

<div class="box col-12 ">
    <div class="chart d-flex col-12">
        <!-- visualizzazioni -->
        <div class="bar col-md-6">
            <canvas class="" id="myChart"></canvas>
        </div>
        <div class="bar col-md-6">
            <canvas class="" id="myChart2"></canvas>
        </div>
    </div>
    <hr>
    <!-- appartamenti -->
    <h2>My Appartments</h2>
    <div class="apartments d-flex flew-wrap">
    @foreach($apartments as $apartment)
        <div class="d-cont d-flex">
            <div class="card-e m-2 ">
                <div class="card-e-img-top d-flex justify-content-end" style="background-image: url({{$apartment->imgurl}}">
                    <div class="pt-2 pr-1">
                        <div class="d-vote p-1 rounded">{{round($apartment->vote, 1)}}</div>
                    </div>    
                
                </div>
                <div class="d-card-header p-2">
                    <h6 class="font-weight-bold text-primary">{{ $apartment->title }}</h6>
                </div>
                <div class="d-card-body p-2 d-flex flex-column">
                    <small>{{$apartment->n_rooms}} Stanze</small>
                    <small><i class="fas fa-bed"></i> {{$apartment->n_beds}}</small>
                    <small><i class="fas fa-bath"></i> {{$apartment->n_bathrooms}}</small>
                </div>
                <a class="btn btn-primary w-100" href="{{route('apartments.edit',$apartment->id)}}">MODIFICA</a>
                <form action="{{route('apartments.destroy',$apartment->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn w-100 btn-danger">ELIMINA</button>
                </form>
            </div>
        </div>
    @endforeach
    </div>
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
    </div>
</div>
  

@endsection