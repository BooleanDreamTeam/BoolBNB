<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 mt-4">

        @foreach ($apartments as $apartment)

            <div class="col p-2 mb-4 d-flex click card-p">
                <a href="{{route('apartment.show',['id' => $apartment->id])}}">
                    <div data-id="{{$apartment->id}}" class="card card_index flex-grow-1 wow animate__animated animate__fadeInUp">

                    @if($apartment->cover)
                    <div class="card-img-top card-img-bg d-flex justify-content-end" style="background-image: url('{{$apartment->cover->imgurl}}')">
                        <div class="voto pt-2 pl-1 m-2">
                        @if($apartment->rating() < 1)
                            <div class="d-vote px-2 py-1 rounded d-flex justify-content-center align-items-center">
                                <span class="p-1">{{ $apartment->rating() }}</span>
                                <i class="fas fa-poo"></i>
                            </div>          
                        @elseif ($apartment->rating() < 2 )
                            <div class="d-vote px-2 py-1 rounded d-flex justify-content-center align-items-center">
                                <span class="p-1">{{ $apartment->rating() }}</span>
                                <i class="far fa-sad-cry"></i>
                            </div>
                        @elseif ($apartment->rating() < 3 )
                            <div class="d-vote px-2 py-1 rounded d-flex justify-content-center align-items-center">
                                <span class="p-1">{{ $apartment->rating() }}</span>
                                <i class="far fa-sad-tear"></i>
                            </div>
                        @elseif ($apartment->rating() < 4 )
                            <div class="d-vote px-2 py-1 rounded d-flex justify-content-center align-items-center">
                                <span class="p-1">{{ $apartment->rating() }}</span>
                                <i class="far fa-meh"></i>
                            </div>
                        @elseif ($apartment->rating() < 5 )
                            <div class="d-vote px-2 py-1 rounded d-flex justify-content-center align-items-center">
                                <span class="p-1">{{ $apartment->rating() }}</span>
                                <i class="far fa-smile"></i>
                            </div>
                        @else 
                            <div class="d-vote px-2 py-1 rounded d-flex justify-content-center align-items-center">
                                <span class="p-1">{{ $apartment->rating() }}</span>
                                <i class="far fa-laugh-beam"></i>
                            </div>
                        @endif
                        </div>
                    </div>
                    @endif
                    

                    <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>

                        </div>
                        <footer class="card-footer">
                            <p class="card-text">
                                <small class="text-muted text-capitalize"><i class="fas fa-map-marker-alt" ></i> {{ $apartment->address}}</small>
                            </p>
                        </footer>
                    </div>
                </a>
            </div>

        @endforeach

</div>
