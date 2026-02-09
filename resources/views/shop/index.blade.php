@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-8">Shop</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)

            <a href="/shop/{{ $product->slug }}" class="border p-4 hover:shadow">
                @if($product->images)
                    <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->title }}"
                        class="mb-3 aspect-square object-cover">
                @endif

                <h3 class="font-semibold">{{ $product->title }}</h3>
                <p class="mt-2 font-bold">Rp {{ number_format($product->price) }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
@endsection