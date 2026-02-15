@extends('layouts.app')

@section('content')
    <div class="max-w-3xl">
        @if($product->images)
            <div class="relative grid grid-cols-2 gap-4 mb-6">
                @foreach($product->images as $image)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->title }}"
                            class="aspect-square object-cover border {{ $product->is_sold_out ? 'opacity-60 grayscale' : '' }}">
                        @if($product->is_sold_out && $loop->first)
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="bg-black/80 text-white text-xs tracking-[3px] uppercase font-semibold px-6 py-3">
                                    Sold Out
                                </span>
                            </div>
                        @endif
                    </div>
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

        @if($product->is_sold_out)
            <button disabled
                class="px-6 py-3 bg-neutral-300 text-neutral-500 border-2 border-neutral-300 cursor-not-allowed tracking-[2px] text-xs uppercase font-semibold">
                Sold Out
            </button>
        @else
            <form action="/cart/add/{{ $product->id }}" method="POST">
                @csrf
                <button
                    class="px-6 py-3 bg-black text-white hover:bg-white border-2 border-black hover:text-black transition-all duration-300 tracking-[2px] text-xs uppercase font-semibold">
                    Add to Cart
                </button>
            </form>
        @endif
    </div>
@endsection