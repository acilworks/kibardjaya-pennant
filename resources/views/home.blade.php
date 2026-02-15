@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="hero">
        <div class="hero__bg" style="background-image: url('{{ asset('image/bg-hero.png') }}');"></div>
        <div class="hero__content">
            <h1 class="hero__title">Stories You Can Hang.</h1>
            <p class="hero__subtitle">
                Handmade pennants inspired by places and memories
                worth keeping. Crafted in Indonesia for collectors
                and explorers alike.
            </p>
            <a href="/shop" class="hero__cta">Explore Collection</a>
        </div>
    </section>

    {{-- Featured Products --}}
    @if($featured->count())
        <section class="py-16 px-10">
            <h2 class="text-center text-xs tracking-[3px] uppercase font-semibold mb-10">Featured Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach($featured as $product)
                    <a href="/shop/{{ $product->slug }}" class="group block {{ $product->is_sold_out ? 'opacity-75' : '' }}">
                        @if($product->image)
                            <div class="relative overflow-hidden mb-4">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                    class="w-full aspect-square object-cover {{ $product->is_sold_out ? 'grayscale' : 'transition-transform duration-500 group-hover:scale-105' }}">
                                @if($product->is_sold_out)
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="bg-black/80 text-white text-[10px] tracking-[3px] uppercase font-semibold px-4 py-2">
                                            Sold Out
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <h3 class="text-sm font-semibold tracking-wide uppercase">{{ $product->title }}</h3>
                        <p class="mt-1 text-sm text-neutral-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection