@extends('layouts.extranet')        
        
@section('content')
    <div class="box col-12 col-sm-6 col-md-8  col-lg-9 col-xl-9 d-flex">
        @foreach($apartments as $key=>$apartment)
            <div class="col-lg-3 mt-4 d-flex">
                <div class="card card-e">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $apartment->title }}</h6>
                    </div>
                    <img src="{{$cover[$key]->imgurl}}" class="card-img-top card-e-img-top" alt="{{ $apartment->title }}">
                    <div class="card-body">
                        
                    </div>
                    <a class="btn btn-primary" href="{{route('apartments.edit',$apartment->id)}}">MODIFICA</a>
                    <form action="{{route('apartments.destroy',$apartment->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">ELIMINA</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>






@endsection
