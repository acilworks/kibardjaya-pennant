@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Pay Order {{ $order->order_number }}</h1>
    <button id="pay-button"
        class="px-6 py-3 bg-black text-white hover:bg-white border-2 border-black hover:text-black transition-all duration-300">Pay
        with Midtrans</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function () {
                    window.location.href = '/checkout/success';
                }
            });
        };
    </script>
@endsection