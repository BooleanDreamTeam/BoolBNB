@extends('layouts.extranet')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>   
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
@endsection

@section('script')
    <script src="{{ asset('js/extranet.js') }}"></script>
@endsection

@section('content')
    
    {{-- INSERT APARTMENT --}}

    <div>
        <div class="advise content">
            <div class="container">
                <form method="post" action="{{route('apartments.store')}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Titolo">Titolo</label>
                        <input type="text" class="form-control" name="title" id="Titolo" placeholder="Titolo..">
                    </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="Stanze">N.Stanze</label>
                            <input type="number" class="form-control" name="n_rooms" id="Stanze">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Letti">N.Letti</label>
                            <input type="number" class="form-control" name="n_beds" id="Letti">
                        </div>    
                        <div class="form-group col-md-3">
                            <label for="Bagni">N.Bagni</label>
                            <input type="number" class="form-control" name="n_bathrooms" id="Bagni">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Metri-Quadrati">M.quadrati</label>
                            <input type="number" class="form-control" name="squaremeters" id="Metri-Quadrati">
                        </div>
                    </div>    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Indirizzo">Indirizzo</label>
                            <input type="text" class="form-control" name="address" id="Indirizzo">
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
                        <div class="form-group col-md-6">
                            <label for="Descrizione">Descrizione</label>
                            <textarea rows="5" class="form-control" name="description" id="Descrizione"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        @foreach ($services as $service)
                            <input class="form-check-input-inline" type="checkbox" name="services[]" value="{{$service->id}}">
                            <label class="form-check-label" for="gridCheck">
                                {{$service->name}}
                            </label>
                        @endforeach 
                    </div>
                    <button type="submit" class="btn btn-primary">Inserisci</button>
                </form>
            </div>
        </div>
    </div>

    {{-------------}}

@endsection


