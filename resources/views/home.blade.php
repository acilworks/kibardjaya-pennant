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

    {{-- Brand Story Section --}}
    <section class="brand-story">
        <div class="brand-story__inner">
            <div class="brand-story__logo-wrap">
                <img src="{{ asset('image/kibardjaya.png') }}" alt="Kibardjaya" class="brand-story__logo">
            </div>
            <div class="brand-story__text">
                <h2 class="brand-story__title">MORE THAN A SOUVENIR.</h2>
                <p class="brand-story__desc">
                    There was a time when travelers brought home pennants as proof of where they had been.
                    A small symbol. A lasting memory. Kibardjaya revives that tradition – reimagined for modern collectors
                    who value story, craftsmanship, and timeless design.
                </p>
            </div>
        </div>
        <div class="brand-story__categories">
            <a href="/shop" class="brand-story__cat-btn">Pennants</a>
            <a href="/shop" class="brand-story__cat-btn">Banners</a>
            <a href="/shop" class="brand-story__cat-btn">Outdoor Flags</a>
            <a href="/shop" class="brand-story__cat-btn">Pin Patches</a>
        </div>
    </section>

    {{-- New Collections --}}
    <section class="collections">
        <div class="collections__header">
            <h2 class="collections__title">New Collections</h2>
            <a href="/shop" class="collections__view-all">View All &rarr;</a>
        </div>
        <div class="collections__grid">
            @foreach($products as $product)
                <a href="/shop/{{ $product->slug }}"
                    class="product-card {{ $product->is_sold_out ? 'product-card--sold-out' : '' }}">
                    @if($product->images && count($product->images) > 0)
                        <div class="product-card__image-wrap">
                            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->title }}"
                                class="product-card__image product-card__image--primary">
                            @if(count($product->images) > 1)
                                <img src="{{ asset('storage/' . $product->images[1]) }}" alt="{{ $product->title }}"
                                    class="product-card__image product-card__image--hover">
                            @endif
                            @if($product->is_sold_out)
                                <div class="product-card__sold-overlay">
                                    <span>Sold Out</span>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="product-card__info">
                        <h3 class="product-card__name">{{ $product->title }}</h3>
                        <p class="product-card__price">Rp. {{ number_format($product->price, 0, ',', '.') }},00</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Running Text Marquee --}}
    <div class="marquee">
        <div class="marquee__track">
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &nbsp;&bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &nbsp;&bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &nbsp;&bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
        </div>
    </div>

    {{-- Custom Order Section --}}
    <section class="custom-order">
        <div class="custom-order__image-wrap">
            <img src="{{ asset('image/custom-img.jpeg') }}" alt="Custom Pennant Order" class="custom-order__image">
        </div>
        <div class="custom-order__content">
            <p class="custom-order__tagline">Not every journey is the same.</p>
            <h2 class="custom-order__title">Create Your Own Story</h2>
            <p class="custom-order__desc">
                Choose your place, your words, your colors –
                and let us craft it into a pennant that's uniquely yours.
            </p>
            <a href="#" class="custom-order__cta">Start Custom Order &rarr;</a>
        </div>
    </section>

    {{-- Crafted to Last Section --}}
    <section class="crafted">
        <div class="crafted__header">
            <h2 class="crafted__title">Crafted to Last</h2>
        </div>
        <div class="crafted__grid">
            <div class="crafted__card">
                <img src="{{ asset('image/craft-left.png') }}" alt="Handmade in Yogyakarta" class="crafted__card-image">
                <div class="crafted__card-overlay">
                    <h3 class="crafted__card-title">Handmade in Yogyakarta</h3>
                    <p class="crafted__card-desc">Crafted by skilled local makers.</p>
                </div>
            </div>
            <div class="crafted__card">
                <img src="{{ asset('image/craft-mid.png') }}" alt="Premium fabric construction" class="crafted__card-image">
                <div class="crafted__card-overlay">
                    <h3 class="crafted__card-title">Premium fabric construction</h3>
                    <p class="crafted__card-desc">Durable materials built for long display.</p>
                </div>
            </div>
            <div class="crafted__card">
                <img src="{{ asset('image/craft-right.png') }}" alt="Small batch production" class="crafted__card-image">
                <div class="crafted__card-overlay">
                    <h3 class="crafted__card-title">Small batch production</h3>
                    <p class="crafted__card-desc">Limited quantities to preserve uniqueness.</p>
                </div>
            </div>
        </div>
    </section>
@endsection