<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mt-5">

        @foreach ($apartments as $apartment)

            <div class="col mb-4 d-flex click card-p">
                <a href="{{route('apartment.show',['id' => $apartment->id])}}">
                    <div data-id="{{$apartment->id}}" class="card card_index flex-grow-1 wow animate__animated animate__fadeInUp">
                    <div class="img-box">
                        @if($apartment->cover)
                        <img src="{{$apartment->cover->imgurl}}" class="img-fluid card-img-top" alt="{{ $apartment->title }}">
                    @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>

                        </div>
                        <footer class="card-footer">
                            <p class="card-text">
                                <small class="text-muted">stanze: {{ $apartment->n_rooms }}</small>
                            </p>
                        </footer>
                    </div>
                </a>
            </div>

        @endforeach

    </div>
