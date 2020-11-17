@extends('layouts.extranet')    

        
@section('content')
    <div class="box col-12 col-sm-6 col-md-8  col-lg-9 col-xl-9 pb-3">
        <!-- appartamenti -->
        <h2>My Appartments</h2>
        <div class="apartments d-flex flex-wrap">
        
        @foreach($apartments as $key=>$apartment)
            <div class="col-lg-3 mt-4 d-flex">
                <div class="card card-e">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $apartment->title }}</h6>
                    </div>
                    <img src="{{$cover[$key]->imgurl}}" class="card-img-top card-e-img-top" alt="{{ $apartment->title }}">
                    <div class="card-body d-flex flex-column">
                        <small>Numero stanze {{$apartment->n_rooms}}</small>
                        <small>Numero letti {{$apartment->n_beds}}</small>
                        <small>Numero bagni {{$apartment->n_bathrooms}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        </div>






    </div>
  


    <div class="chart col-12 col-sm-6 col-md-4 col-lg-3 ">
        <!-- visualizzazioni -->
        <canvas id="myChart"></canvas>
        <hr>
        <canvas id="myChart2"></canvas>
        <hr>
    </div>
    
    
  




@endsection


@section('script')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection