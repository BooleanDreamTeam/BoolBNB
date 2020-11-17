@extends('layouts.extranet')

@section('content')

{{-- ERROR --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success_message'))
<div class="alert alert-success">
    {{ session('success_message') }}
</div>
@endif


{{-- ERROR--}}



<form method="post" id="payment-form" action="{{route('checkout')}}">
    <div class="d-flex">
    @foreach ($sponsorships as $sponsor)
        
        <div class="card col-md-4 sponsor" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$sponsor->name}}</h5>
                <p class="card-text">Price: {{$sponsor->price}}€</p>
                <a data-price="{{$sponsor->price}}" class="card-link">Acquista</a>
            </div>
        </div>
        
    @endforeach
    </div>
    @csrf
    <div class="form-row">
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

        $('#amount').val($(this).data('price'));

     });
    </script>

@endsection