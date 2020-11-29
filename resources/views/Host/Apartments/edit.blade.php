@extends('layouts.extranet')

@section('title')
Modifica Appartamento
@endsection


@section('script')
    <script src="{{ asset('js/input-validation.js') }}"></script>
    <script src="{{ asset('js/extranet.js') }}"></script>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
@endsection

@section('content')

@if (session('status'))
<div class="alert alert-success status mx-auto fixed-top m-5">
    {{ session('status') }}
</div>
@endif

    {{-- MODIFY APARTMENT --}}

    <div class="advise content w-100">
        <div class="container-fluid">
            <form method="post" action="{{ route('apartments.update', $apartment->id) }}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Titolo">Titolo</label>
                        <input type="text" class="form-control" name="title" id="Titolo" value="{{ $apartment->title }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="Stanze">N.Stanze</label>
                        <input type="number" class="form-control" name="n_rooms" id="Stanze"
                            value="{{ $apartment->n_rooms }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Letti">N.Letti</label>
                        <input type="number" class="form-control" name="n_beds" id="Letti" value="{{ $apartment->n_beds }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Bagni">N.Bagni</label>
                        <input type="number" class="form-control" name="n_bathrooms" id="Bagni"
                            value="{{ $apartment->n_bathrooms }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Metri-Quadrati">M.quadrati</label>
                        <input type="number" class="form-control" name="squaremeters" id="Metri-Quadrati"
                            value="{{ $apartment->squaremeters }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="Indirizzo">Indirizzo</label>
                        <input type="text" class="form-control" name="address" id="Indirizzo"
                            value="{{ $apartment->address }}">
                        <input type="hidden" name="latlng" value="" id="cordinates" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Immagine">Immagine</label>
                        <input type="file" class="form-control" id="Immagine" name="images[]" accept="image/*" name="images"
                            size="20" multiple="multiple" required>

                    </div>
                </div>
                <div class="form-row">

                    <div class="apartment-images">
                        <div class="row">
                            @foreach ($apartmentImages as $image)
                                <div class="col-3">
                                    <div class="apartment-image">

                                        <a href="{{ route('delete-image', $image->id) }}"
                                            class="btn btn-delete-img apartment-image-delete">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <div class="apartment-image-bg"
                                            style="background-image: url('{{ $image->imgurl }}')"></div>

                                        <label>
                                            <input {{ $image->cover ? 'checked' : '' }} type="radio"
                                                value="{{ $image->id }}" name="cover_image_id" />
                                            Cover
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Descrizione">Descrizione</label>
                        <textarea rows="5" class="form-control" name="description"
                            id="Descrizione" required>{{ $apartment->description }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        @foreach ($services as $service)
                            <input class="form-check-input-inline" type="checkbox" name="services[]" value="{{ $service->id }}"
                                {{ $apartment->services->contains($service->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridCheck">
                                {{ $service->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-primary">Modifica</button>
                </div>
            </form>
        </div>
    </div>
    {{-------------}}

@endsection
