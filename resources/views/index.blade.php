@extends('layouts.app')

@section('title')
    Boolbnb
@endsection

@section('content')

  <!-- FORM DI RICERCA -->

    <section id="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image: url('{{ Storage::url('img/home-slide1.jpeg') }}')">
                </div>
                <div class="carousel-item" style="background-image: url('{{ Storage::url('img/home-slide2.jpeg') }}')">
                </div>
                <div class="carousel-item" style="background-image: url('{{ Storage::url('img/home-slide4.jpeg') }}')">

                </div>
            </div>
        </div>
        <div class="search-wrapper d-flex flex-column justify-content-center align-items-center">
            <h2 id="smart-write"></h2>
            <form id="search" action="{{route('search')}}" method="get" class=" search_bar wow animate__animated animate__bounceInUp">
                <div class="search-box">
                    <div class="form-row">
                        <div class="col d-flex justify-content-around col-md-12">
                            @csrf
                            <input type="search" id="address-input" name="address" class="form-control" placeholder="Dove vuoi andare" required/>
                            <input type="hidden" name="cordinates" id="cordinates" >
                            <button type="submit" class="btn btn-primary ml-3 btn-search">
                                <i class="fas fa-search-location"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>



<div class="container col-md-8">


{{-- Blocco di immagini per appartamenti in evidenza --}}

    <section id="highlighted" class="pt-4">

        <div class="d-flex flex-row featured">

            <h2 class="d-flex flex-row text-center">
                <i class="far fa-star"></i>
                Sponsorizzati
                <span><i class="far fa-star"></i></span>
            </h2>

        </div>

        @include('partials.apartments-row', ['apartments'=> $sponsored])

    </section>
</div>

<div class="promo mt-4 pt-4">
    <div class="title">
        <h2 class="text-center">Vai alla scoperta con BoolBnB</h2>
        <h6 class="text-center">BoolBnB offre annunci in oltre 191 paesi</h6>
    </div>
    <div class="col-md-3 d-flex justify-content-center">

        <p>testo sotto</p>
    </div>
</div>

<div class="container col-md-8">

{{-- Blocco di immagini per appartamenti NON in evidenza--}}

    <section id="simple-ap" class="pt-4">

        <h2 class="text-center">Appartamenti</h2>

        @include('partials.apartments-row', ['apartments'=> $apartments])

    </section>

</div>

{{-- @include('partials.footer') --}}

@endsection


