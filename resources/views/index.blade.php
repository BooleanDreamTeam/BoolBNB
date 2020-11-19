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
                <div class="carousel-item" style="background-image: url('{{ Storage::url('img/home-slide3.jpeg') }}')">

                </div>
            </div>
        </div>
        <form id="search">
            <div class="search-box">

                <div class="form-row">
                    <div class="col">
                        <input type="search" id="address-input" class="form-control" placeholder="Dove vuoi andare" />
                    </div>

                    <button type="submit" class="btn btn-primary ml-2">Cerca</button>
                </div>

            </div>
        </form>
    </section>

<div class="bg-fluid"></div>

    <div class="container col-md-8">


{{-- Blocco di immagini per appartamenti in evidenza --}}

<section id="highlighted" class="pt-4">

    <h2 class="text-center">Appartamenti in vista</h2>

    @include('partials.apartments-row', ['apartments'=> $sponsored])

</section>

{{-- Blocco di immagini per appartamenti NON in evidenza--}}

<section id="simple-ap" class="pt-4">

    <h2 class="text-center">Appartmenti</h2>

    @include('partials.apartments-row', ['apartments'=> $apartments])

</section>

</div>

@endsection


