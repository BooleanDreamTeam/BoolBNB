@extends('layouts.extranet')

@section('script')
    <script src="{{ asset('js/input-validation.js') }}"></script>
@endsection

@section('content')

{{-- MODIFY APARTMENT --}}

    <div class="advise content">
        <div class="container">
            <form method="post" action="{{route('apartments.update',$apartment->id)}}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PATCH')
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Titolo">Titolo</label>
                    <input type="text" class="form-control" name="title" id="Titolo" value="{{$apartment->title}}">
                </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="Stanze">N.Stanze</label>
                        <input type="number" class="form-control" name="n_rooms" id="Stanze" value="{{$apartment->n_rooms}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Letti">N.Letti</label>
                        <input type="number" class="form-control" name="n_beds" id="Letti" value="{{$apartment->n_beds}}">
                    </div>    
                    <div class="form-group col-md-3">
                        <label for="Bagni">N.Bagni</label>
                        <input type="number" class="form-control" name="n_bathrooms" id="Bagni" value="{{$apartment->n_bathrooms}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Metri-Quadrati">M.quadrati</label>
                        <input type="number" class="form-control" name="squaremeters" id="Metri-Quadrati" value="{{$apartment->squaremeters}}">
                    </div>
                </div>    
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="Indirizzo">Indirizzo</label>
                        <input type="text" class="form-control" name="address" id="Indirizzo" value="{{$apartment->address}}">
                        <input type="hidden" name="latlng"
                        value="" id="cordinates">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Immagine">Immagine</label>
                        <input type="file" class="form-control" id="Immagine" name="images[]" accept="image/*" name="images"  size="20" multiple="multiple">
                        <span><em>* la prima immagine sarà l'immagine di copertina</em></span>
                    </div>
                </div>
                <div class="form-row">
                        
                    <div id="carouselExampleControls" class="carousel" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($apartmentImages as $image)

                                @if ($image->cover == 1)

                                <div class="carousel-item active">
                                    <img class="d-block w-100" style="height:200px" src="{{$image->imgurl}}" alt="{{$image->imgurl}}">
                                </div>

                                @else

                                <div class="carousel-item">
                                    <img class="d-block w-100" style="height:200px" src="{{$image->imgurl}}" alt="{{$image->imgurl}}">
                                </div>

                                @endif
                            @endforeach    
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Descrizione">Descrizione</label>
                        <textarea rows="5" class="form-control" name="description" id="Descrizione">{{$apartment->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    @foreach ($services as $service)
                        <input class="form-check-input-inline" type="checkbox" name="services[]" value="{{$service->id}}" {{($apartment->services->contains($service->id) ? 'checked' : '')}}>
                        <label class="form-check-label" for="gridCheck">
                            {{$service->name}}
                        </label>
                    @endforeach 
                </div>
                <button type="submit" class="btn btn-primary">Inserisci</button>
            </form>
        </div>
    </div>
{{-------------}} 
    
@endsection