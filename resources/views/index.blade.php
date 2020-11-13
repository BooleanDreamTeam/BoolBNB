@extends('layouts.app') 

@section('title')
    Boolbnb
@endsection

@section('content')

  <!-- FORM DI RICERCA -->

    <section id="search" class="d-flex justify-content-center">
        <form class="d-flex align-items-center">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Dove" />
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Numero Ospiti" />
                </div>

                <button type="submit" class="btn btn-dark ml-2">Cerca</button>
            </div>
        </form>
    </section>


    <div class="container col-md-8">


        {{-- Blocco di immagini per appartamenti in evidenza --}}

        <section id="highlighted" class="pt-4">

            <h2>Sponsorizzati</h2>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-5">

                @foreach ($sponsored as $apartment)

                    <div class="col mb-4 d-flex">
                        <div class="card flex-grow-1 wow animate__animated animate__fadeInUp">
                            <img src="https://picsum.photos/300/300" class="card-img-top" alt="{{ $apartment->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $apartment->title }}</h5>

                            </div>
                            <footer class="card-footer">
                                <p class="card-text">
                                    <small class="text-muted">Stanze: {{ $apartment->n_rooms }}</small>
                                </p>
                            </footer>
                        </div>
                    </div>

                @endforeach

            </div>

        </section>

        {{-- Blocco di immagini per appartamenti NON in evidenza--}}
        
        <section id="simple-ap" class="pt-4">

            <h2>Appartmenti</h2>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-5">

                @foreach ($apartments as $apartment)

                    <div class="col mb-4 d-flex">
                        <div class="card flex-grow-1 wow animate__animated animate__fadeInUp">
                            <img src="https://picsum.photos/300/300" class="card-img-top" alt="{{ $apartment->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

        </section>

    </div>
@endsection


