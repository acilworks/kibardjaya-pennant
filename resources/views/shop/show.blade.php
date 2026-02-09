@extends('layouts.app')

@section('content')
    <div class="max-w-3xl">
        <h1 class="text-3xl font-bold mb-4">{{ $product->title }}</h1>

        <p class="text-xl font-semibold mb-4">
            Rp {{ number_format($product->price) }}
        </p>

        <div class="prose mb-6">
            {{ $product->description }}
        </div>

        <button class="px-6 py-3 bg-black text-white">
            Add to Cart
        </button>
    </div>
@endsection