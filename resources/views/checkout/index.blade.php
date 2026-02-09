@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    <form method="POST" action="/checkout" class="max-w-md">
        @csrf
        <input name="name" placeholder="Your Name" class="border p-2 w-full mb-3" required>
        <input name="email" type="email" placeholder="Email" class="border p-2 w-full mb-3" required>
        <button class="px-6 py-3 bg-black text-white">Pay Now</button>
    </form>
@endsection