@extends('layouts.extranet')

@section('content')

{{-- ERROR --}}
@if ($errors->any())
<div class="alert alert-danger fixed-bottom">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success_message'))
<div class="alert alert-success fixed-bottom">
    {{ session('success_message') }}
</div>
@endif


{{-- ERROR--}}



<form method="post" id="payment-form" action="{{route('sponsorship.store')}}">
    @csrf
    <div class="form-row">

        <div class="flex-d">
            <select name="apartment">
                @foreach ($apartments as $apartment)
                    <option value="{{$apartment->id}}">{{$apartment->title}}</option>            
                @endforeach    
            </select>   
        </div>

    </div>
    
    <div class="form-row">

        <div class="d-flex">
            @foreach ($sponsorships as $sponsor)
                
                <div class="card col-md-3 sponsor" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$sponsor->name}}</h5>
                        <h3 class="card-description">Il tuo appartamento sarà sponsorizzato per {{$sponsor->time}} ore!</h3>
                        <p class="card-text">Price: {{$sponsor->price}}€</p>
                        <a data-price="{{$sponsor->price}}" data-id="{{$sponsor->id}}" class="card-link">Acquista</a>
                    </div>
                </div>
                
            @endforeach
            </div>
            <input type="hidden" name="sponsorshipClicked" id="clicked" val="">

    </div>

    <div class="form-raw">

        <div class="form-group col-md-6">
            <label for="amount">Amount</label>
            <input type="number" name="amount" class="form-control" id="amount">
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