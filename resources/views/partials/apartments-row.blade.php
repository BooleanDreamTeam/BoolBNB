<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 mt-4">

        @foreach ($apartments as $apartment)

            <div class="col p-2 mb-4 d-flex click card-p">
                <a href="{{route('apartment.show',['id' => $apartment->id])}}">
                    <div data-id="{{$apartment->id}}" class="card card_index flex-grow-1 wow animate__animated animate__fadeInUp">

                    @if($apartment->cover)
                    <div class="card-img-top card-img-bg" style="background-image: url('{{$apartment->cover->imgurl}}')"></div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>

                        </div>
                        <footer class="card-footer">
                            <p class="card-text">
                                <small class="text-muted"><i class="fas fa-map-marker-alt" ></i> {{ $apartment->address}}</small>
                            </p>
                        </footer>
                    </div>
                </a>
            </div>

        @endforeach

</div>
