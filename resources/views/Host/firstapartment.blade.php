@extends('layouts.app')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>   
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
@endsection

@section('script')
    <script src="{{ asset('js/extranet.js') }}"></script>
    <script src="{{ asset('js/input-validation.js') }}"></script>
@endsection

@section('content')
    
    {{-- INSERT APARTMENT --}}

    <div>
        <div class="advise content">
            <div class="container">

                {{-- ERROR --}}
            @if ($errors->any())
            <div class="alert alert-danger status mx-auto fixed-top m-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('status'))
            <div class="alert alert-success status mx-auto fixed-top m-5">
                {{ session('status') }}
            </div>
            @endif
            {{-- ERROR--}}

                <form method="post" action="{{route('firstapartment.store')}}" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('POST')
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Titolo">Titolo</label>
                        <input type="text" class="form-control" name="title" id="Titolo" placeholder="Titolo.." required>
                        <div class="valid-feedback">
                            Titolo corretto!
                        </div>
                        <div class="invalid-feedback">
                            Titolo invalido!
                        </div>
                    </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="Stanze">N.Stanze</label>
                            <input type="number" class="form-control" name="n_rooms" id="Stanze" required>
                            <div class="valid-feedback">
                                Numero Stanze corretto!
                            </div>
                            <div class="invalid-feedback">
                                Numero Stanze Incorretto!
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Letti">N.Letti</label>
                            <input type="number" class="form-control" name="n_beds" id="Letti" required>
                            <div class="valid-feedback">
                                Numero Letti corretto!
                            </div>
                            <div class="invalid-feedback">
                                Numero Letti Incorretto!
                            </div>
                        </div>    
                        <div class="form-group col-md-3">
                            <label for="Bagni">N.Bagni</label>
                            <input type="number" class="form-control" name="n_bathrooms" id="Bagni" required>
                            <div class="valid-feedback">
                                Numero Bagni corretto!
                            </div>
                            <div class="invalid-feedback">
                                Numero Bagni Incorretto!
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Metri-Quadrati">M.quadrati</label>
                            <input type="number" class="form-control" name="squaremeters" id="Metri-Quadrati" required>
                            <div class="valid-feedback">
                                Numero Metri quadrati corretto!
                            </div>
                            <div class="invalid-feedback">
                                Numero Metri Quadrati Incorretto!
                            </div>
                        </div>
                    </div>    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Indirizzo">Indirizzo</label>
                            <input type="text" class="form-control" name="address" id="Indirizzo" required>
                            <div class="valid-feedback">
                                Indirizzo corretto!
                            </div>
                            <div class="invalid-feedback">
                                Indirizzo Incorretto!
                            </div>
                            <input type="hidden" name="latlng"
                            value="" id="cordinates">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="file" class="custom-file-input" id="Immagine" name="images[]" accept="image/*" name="images"  size="20" multiple="multiple" required>
                            <div class="valid-feedback">
                                Immaggini inserite correttamente!
                            </div>
                            <div class="invalid-feedback">
                                Inserisci almeno un immagine!
                            </div>
                            <label class="custom-file-label" for="Immagine">Choose file</label>
                            <span><em>* la prima immagine sarà l'immagine di copertina</em></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Descrizione">Descrizione</label>
                            <textarea rows="5" class="form-control" name="description" id="Descrizione" required></textarea>
                            <div class="valid-feedback">
                                Descrizione corretta!
                            </div>
                            <div class="invalid-feedback">
                                Descrizione Incorretta!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            @foreach ($services as $service)
                                <input class="form-check-input-inline" type="checkbox" name="services[]" value="{{$service->id}}">
                                <label class="form-check-label" for="gridCheck">
                                    {{$service->name}}
                                </label>
                            @endforeach 
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary">Inserisci</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


{{-------------}}

@endsection

