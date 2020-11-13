@extends('layouts.app') 
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

                <button type="submit" class="btn btn-dark ml-10">Cerca</button>
            </div>
        </form>
    </section>

<div class="container col-md-8">
    

        {{-- Blocco di immagini per appartamenti in evidenza --}}

    <section id="highlighted" class="pt-4">
        
        <div class="card-deck">
            <div class="row">
                @foreach ($apartments as $apartment)
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
         
    </section>
</div>
@endsection


