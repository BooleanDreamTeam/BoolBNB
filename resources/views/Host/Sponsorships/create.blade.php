@extends('layouts.extranet')

@section('title')
Metti in Evidenza
@endsection


@section('js')
<script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
@endsection

@section('script')
    <script src="{{ asset('js/input-validation.js') }}"></script>
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

@if ($errors->any())
            <div class="alert alert-danger status mx-auto fixed-top m-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
@endif
{{-- ERROR--}}



<form method="post" id="payment-form" action="{{route('sponsorship.store')}}" class="needs-validation" novalidate>
    @csrf
    <div class="form-row">

        <div class=" ">
            <select class="custom-select" name="apartment">
                @foreach ($apartments as $apartment)
                    <option value="{{$apartment->id}}">{{$apartment->title}} | {{$apartment->address}}</option>            
                @endforeach    
            </select>
            <div class="valid-feedback">
                Appartamento selezionato!
            </div>
            <div class="invalid-feedback">
                Seleziona un appartamento!
            </div>
        </div>

    </div>
    
    <div class="form-row">
        <div class="d-flex flex-wrap">
            @foreach ($sponsorships as $sponsor) 
            <div class="card col-lg-3 col-md-12 sponsor m-2 p-0" style="width: 18rem;">
                <div class="box-title {{$sponsor->name}} w-100 d-flex align-items-center justify-content-center">
                    <h2 class="card-title m-0">{{$sponsor->name}}</h2>
                </div>
                <div class="card-body text-center">
                    
                    <h5 class="card-description">Metti in risalto il tuo appartamento per le prossime {{$sponsor->time}} ore!</h5>
                    
                    <p class="card-text"><i class="fas fa-shopping-cart"></i>{{$sponsor->price}}€</p>
                    <a class="btn btn-primary" data-price="{{$sponsor->price}}" data-id="{{$sponsor->id}}" class="card-link">
                        Acquista
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <input type="hidden" name="sponsorshipClicked" id="clicked">
    </div>

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="amount">Amount</label>
            <input  name="amount" class="form-control" id="amount" required>
            <div class="valid-feedback">
                Prezzo corretto!
            </div>
            <div class="invalid-feedback">
                Inserisci un prezzo!
            </div>
        </div>
        <div class="bt-drop-in-wrapper">
            <div id="bt-dropin">

            </div>
        </div>  
        <div class="form-group col-md-6">
            <input type="hidden" name="payment_method_nonce" id="nonce" value="credit-card">  
            <button type="submit" class="btn btn-primary">Transaction</button>
        </div>  

    </div>
        
    
</form>

    <script>
        const form = document.getElementById('payment-form');

        braintree.dropin.create({
            authorization: " {{$token}} ",
            container: '#bt-dropin'
        }, (error, dropinInstance) => {
        if (error) console.error(error);

        form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
            if (error) console.error(error);

            // Step four: when the user is ready to complete their
            //   transaction, use the dropinInstance to get a payment
            //   method nonce for the user's selected payment method, then add
            //   it a the hidden field before submitting the complete form to
            //   a server-side integration
            document.getElementById('nonce').value = payload.nonce;
            form.submit();
            });
        });
     });        

     $('.sponsor a').click(function() {

        $('#clicked').val($(this).data('id'));

        $('#amount').val($(this).data('price'));

     });
    </script>

@endsection