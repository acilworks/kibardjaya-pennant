@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-8">Shop</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <a href="/shop/{{ $product->slug }}"
                class="border p-4 hover:shadow group {{ $product->is_sold_out ? 'opacity-75' : '' }}">
                @if($product->images)
                    <div class="relative overflow-hidden mb-3">
                        <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->title }}"
                            class="aspect-square object-cover {{ $product->is_sold_out ? 'grayscale' : 'transition-transform duration-500 group-hover:scale-105' }}">
                        @if($product->is_sold_out)
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="bg-black/80 text-white text-[10px] tracking-[3px] uppercase font-semibold px-4 py-2">
                                    Sold Out
                                </span>
                            </div>
                        @endif
                    </div>
                @endif

                <h3 class="font-semibold">{{ $product->title }}</h3>
                <div class="mt-2 flex justify-between items-center">
                    <p class="font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    @if($product->colorVariants->count() > 0)
                        <div class="flex gap-1">
                            @foreach($product->colorVariants as $variant)
                                <span class="w-3 h-3 rounded-full border border-black"
                                    style="background-color: {{ $variant->color_code }};"></span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
@endsection