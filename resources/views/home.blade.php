@extends('layouts.app')

@section('content')
    <section class="text-center py-16">
        <h1 class="text-4xl font-bold mb-4">
            Handmade Pennants Inspired by Everything
        </h1>
        <a href="/shop"
            class="inline-block mt-6 px-6 py-3 bg-black text-white hover:bg-white border-2 border-black hover:text-black transition-all duration-300">
            Shop Collection
        </a>
    </section>

    <section>
        <h2 class="text-2xl font-semibold mb-6">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($featured as $product)
                <a href="/shop/{{ $product->slug }}" class="border p-4 hover:shadow">
                    <h3 class="font-semibold">{{ $product->title }}</h3>
                    <p class="mt-2 font-bold">Rp {{ number_format($product->price) }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection