@extends('layouts.app')

@section('content')
    <div class="max-w-3xl">
        @if($product->images)
            <div class="grid grid-cols-2 gap-4 mb-6">
                @foreach($product->images as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->title }}"
                        class="aspect-square object-cover border">
                @endforeach
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-4">{{ $product->title }}</h1>

        <p class="text-xl font-semibold mb-4">
            Rp {{ number_format($product->price) }}
        </p>

        <div class="prose mb-6">
            {{ $product->description }}
        </div>



        <!-- <button class="px-6 py-3 bg-black text-white">
                Add to Cart
            </button> -->
        <form action="/cart/add/{{ $product->id }}" method="POST">
            @csrf
            <button class="px-6 py-3 bg-black text-white">
                Add to Cart
            </button>
        </form>
    </div>
@endsection