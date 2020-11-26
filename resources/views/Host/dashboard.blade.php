

@extends('layouts.extranet')    

@section('script')
    <script src="{{ asset('js/input-validation.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection


@section('content')


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

<div class="box col-12 ">
    <!-- appartamenti -->
    <div class="d-cont-left d-flex flex-column">
        <div id="charts" class="chart d-flex col-12 flex-column flex-md-row">
            <div class="col-sm-12 col-md-6 line">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-sm-12 col-md-6 doughnut ">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <hr>
        <h2 class="text-center">My Appartments</h2>
        <div id="apartments" class="apartments mb-4 pb-4 border-bottom card-group d-flex flex-column flex-md-row">
        @foreach($apartments as $apartment)
            <div class="d-cont d-flex col-12 col-sm-12 col-md-12 col-lg-3 text-center">
                <div class="d-card-e m-2">
                    <a href="{{route('apartment.show',['id' => $apartment->id])}}">
                    <div class="card-e-img-top d-flex justify-content-end" style="background-image: url({{ $apartment->cover->imgurl }}">
                        <div class="pt-2 pr-1">
                            @if($apartment->rating() > 3)
                                <div class="d-vote px-2 py-1 rounded d-flex justify-content-center align-items-center">
                                    <span class="p-1">{{ $apartment->rating() }}</span>
                                    <i class="far fa-smile"></i>
                                </div>          
                            @else ($apartment->rating() <= 3)
                                <div class="d-vote px-2 py-1 rounded d-flex justify-content-center align-items-center">
                                    <span class="p-1">{{ $apartment->rating() }}</span>
                                    <i class="far fa-frown"></i>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="d-card-header p-2">
                        <h6 class="font-weight-bold text-primary">{{ $apartment->title }}</h6>
                    </div>
                    <div class="d-card-body p-2 d-flex flex-column">
                        <small>{{$apartment->n_rooms}} Stanze</small>
                        <small><i class="fas fa-bed"></i> {{$apartment->n_beds}}</small>
                        <small><i class="fas fa-bath"></i> {{$apartment->n_bathrooms}}</small>
                    </div>
                    </a>
                    <a class="btn btn-primary w-100" href="{{route('apartments.edit',$apartment->id)}}">MODIFICA</a>
                    <form action="{{route('apartments.destroy',$apartment->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-100 btn-danger">ELIMINA</button>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
          <div class="d-flex flex-md-row flex-column">
                <div id="reviews" class="col-12 col-md-6">
                <h2>Last Reviews</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Apartment</th>
                                <th scope="col">Received</th>
                                <th scope="col">Name</th>
                                <th scope="col">Text</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                            <tr>
                                <td scope="row"><img class="rounded rev-img" src="{{$review->imgurl}}" alt="image"></td>
                                <td>{{$review->created_at}}</td>
                                <td>{{$review->name}}</td>
                                <td>{{$review->message}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=" d-flex col-12 col-md-6">
                <div id="geoarea" class="geo col-12 col-md-12">
                    <h2>Geo Area Views</h2>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Region</th>
                            <th scope="col">Total view</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clicks as $click)
                            <tr>
                                <th scope="row">{{$click->geo_area}}</th>
                                <td>{{$click->clicks}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
          </div>
    </div>    
</div>

<script>

    
// torta
    var ctx = document.getElementById("myChart2").getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach($brows as $brow)
                '{{$brow->browser}}',
                @endforeach
            ],
            datasets: [
                {
                    label: "browser",
                    data: [
                        @foreach($brows as $brow)
                            '{{$brow->clicks}}',
                        @endforeach
                        ],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.4)",
                        "rgba(54, 162, 235, 0.4)",
                        "rgba(255, 206, 86, 0.4)",
                        "rgba(75, 192, 192, 0.4)",
                        'rgba(153, 102, 255, 0.4)',
                        'rgba(255, 159, 64, 0.4)'
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: "Visite per Browser"
        }
    }
    });


    new Chart(document.getElementById("myChart"), {
  type: 'line',
  data: {
    labels: [
            @foreach($views as $view)       
                {{($view->mon)}},
            @endforeach
        ],
    datasets: [{ 
        data: [
            @foreach($views as $view)
            {{$view->views}},
            @endforeach
        ],
        label: "Views",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    title: {
      display: true,
      text: 'Visite Mensili'
    }
  }
});

    
    </script>
@endsection

