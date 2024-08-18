@extends('layouts.main')

@section('title', 'Payment')

@section('content')
    <div class="container mt-5">
        <h2>{{ __('Confirm Your Payment') }}</h2>
        <form id="payment-form" method="POST" action="{{ route('lead.handle-payment', $lead) }}">
            @csrf
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <button id="submit">Pay {{ $lead->price }} USD</button>
            <input type="hidden" name="payment_intent_id" id="payment_intent_id">
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        var clientSecret = "{{ $clientSecret }}";

        form.addEventListener('submit', function(ev) {
            ev.preventDefault();
            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card
                }
            }).then(function(result) {
                if (result.error) {
                    console.log(result.error.message);
                } else {
                    document.getElementById('payment_intent_id').value = result.paymentIntent.id;
                    form.submit();
                }
            });
        });
    </script>
@endsection
