@extends('layouts.app')

@section('title')
    Boolbnb
@endsection

@section('content')

  <!-- FORM DI RICERCA -->

    <section id="search" class="d-flex justify-content-center">
        <form class="d-flex align-items-center">
            <div class="search-box">

                <div class="form-row">
                    <div class="col">
                        <input type="search" id="address-input" class="form-control" placeholder="Dove" />
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Numero Ospiti" />
                    </div>

                    <button type="submit" class="btn btn-primary ml-2">Cerca</button>
                </div>

            </div>
        </form>
    </section>


    <div class="container col-md-8">


{{-- Blocco di immagini per appartamenti in evidenza --}}

<section id="highlighted" class="pt-4">

    <h2>Sponsorizzati</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-5">

        @foreach ($sponsored as $apartment)

            <div class="col mb-4 d-flex click card-p">
                <a href="{{route('apartment.show',['id' => $apartment->id])}}">
                    <div data-id="{{$apartment->id}}" class="card card_index flex-grow-1 wow animate__animated animate__fadeInUp">
                    @if($apartment->cover)
                        <img src="{{$apartment->cover->imgurl}}" class="img-fluid card-img-top" alt="{{ $apartment->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>

                        </div>
                        <footer class="card-footer">
                            <p class="card-text">
                                <small class="text-muted">Stanze: {{ $apartment->n_rooms }}</small>
                            </p>
                        </footer>
                    </div>
                </a>
            </div>

        @endforeach

    </div>

</section>

{{-- Blocco di immagini per appartamenti NON in evidenza--}}

<section id="simple-ap" class="pt-4">

    <h2>Appartmenti</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-5">

        @foreach ($apartments as $apartment)

        <div class="col-lg-3 mb-4 d-flex click card-p">
            <a href="{{route('apartment.show',['id' => $apartment->id])}}">
                <div data-id="{{$apartment->id}}" class="card card_index flex-grow-1 wow animate__animated animate__fadeInUp">

                @if($apartment->cover)
                    <img src="{{$apartment->cover->imgurl}}" class="img-fluid card-img-top" alt="{{ $apartment->title }}">
                @endif
                <div class="card-body">
                <h5 class="card-title">{{ $apartment->title }}</h5>

                </div>
                <footer class="card-footer">
                    <p class="card-text">
                        <small class="text-muted">Stanze: {{ $apartment->n_rooms }}</small>
                    </p>
                </footer>
                </div>
            </a>
        </div>

        @endforeach

    </div>

</section>

</div>

@endsection


