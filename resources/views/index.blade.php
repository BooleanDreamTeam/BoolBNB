@extends('layouts.app') 
@section('content')

 <!-- FORM DI RICERCA -->

    <section id="search" class="d-flex justify-content-center">
        <form class="d-flex align-items-center">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Dove" />
                </div>
                {{-- <div class="col">
                    <input type="text" class="form-control" placeholder="State" />
                </div> --}}
                <div class="col">
                    <input type="text" class="form-control" placeholder="Numero Ospiti" />
                </div>

                <button type="submit" class="btn btn-dark ml-10">Cerca</button>
            </div>
        </form>
    </section>

<div class="container col-md-8">
    

        {{-- Blocco di immagini per appartamenti in highlight --}}

    <section id="highlighted" class="pt-4">
        
        <div class="card-deck">
            <div class="row">
                @foreach ($apartments as $apartment)

                    {{-- CONTROLLO SPONSOR APPARTAMENTI(NON CANCELLARE!!) --}}
                    @foreach ($apartments as $apartment)
                        @php
                            $sponsors = $apartment->sponsorships;    
                        @endphp
                        @foreach ($sponsors as $sponsor)
                            @php
                                $exp_date = ($sponsor->pivot->expiration_date);
                            @endphp
                        @endforeach
                        @if(count($apartment->sponsorships) > 0 && $exp_date > now())
                            <p>{{$apartment->title}}</p>
                        @endif
                    @endforeach
                    {{-----------}}
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                        {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                        </div>
                    </div>
                @endforeach
                

        
            

                




            </div>
        </div>
        
  
        
    </section>
</div>
@endsection
