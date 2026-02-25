@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush


@section('content')
    {{-- Hero Section — Swiper --}}
    @if($heroSlides->count() > 0)
        <section class="hero hero--swiper">
            <div class="swiper hero-swiper">
                <div class="swiper-wrapper">
                    @foreach($heroSlides as $slide)
                        <div class="swiper-slide">
                            <div class="hero__bg"
                                style="background-image: url('{{ asset('storage/' . $slide->background_image) }}');"></div>
                            <div class="hero__content">
                                @if($slide->label)
                                    <span class="hero__label">{{ $slide->label }}</span>
                                @endif
                                <h1 class="hero__title">{{ $slide->title }}</h1>
                                @if($slide->subtitle)
                                    <p class="hero__subtitle">{{ $slide->subtitle }}</p>
                                @endif
                                @if($slide->cta_text && $slide->cta_url)
                                    <a href="{{ $slide->cta_url }}" class="hero__cta">{{ $slide->cta_text }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Pagination --}}
                <div class="swiper-pagination hero-swiper__pagination"></div>
            </div>
        </section>
    @else
        {{-- Fallback: static hero if no slides --}}
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
    @endif

    {{-- Brand Story Section --}}
    <section class="brand-story">
        <div class="brand-story__inner">
            <div class="brand-story__logo-wrap">
                <img src="{{ asset('image/kibardjaya.png') }}" alt="Kibardjaya" class="brand-story__logo">
            </div>
            <div class="brand-story__heading">
                <h2 class="brand-story__title">MORE THAN<br>A SOUVENIR</h2>
            </div>
            <div class="brand-story__text">
                <p class="brand-story__desc">
                    There was a time when travelers brought home pennants as proof of where they had been.A small symbol. A
                    lasting memory.
                </p>
                <p class="brand-story__desc">
                    Kibardjaya revives that tradition – reimagined for modern collectors who value story, craftsmanship, and
                    timeless design.
                </p>
            </div>
        </div>
        <div class="brand-story__categories">
            @foreach($categories as $category)
                <a href="/shop" class="brand-story__cat-btn">{{ $category->name }}</a>
            @endforeach
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
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                            <p class="product-card__price" style="margin: 0;">Rp.
                                {{ number_format($product->price, 0, ',', '.') }},00
                            </p>
                            @if($product->colorVariants->count() > 0)
                                <div style="display: flex; gap: 4px;">
                                    @foreach($product->colorVariants as $variant)
                                        <span
                                            style="width: 12px; height: 12px; border-radius: 50%; background-color: {{ $variant->color_code }}; border: 1px solid #1a1a1a;"></span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
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
        <div class="swiper crafted__swiper">
            <div class="swiper-wrapper crafted__grid">
                <div class="swiper-slide crafted__card">
                    <img src="{{ asset('image/craft-left.png') }}" alt="Handmade in Yogyakarta" class="crafted__card-image">
                    <div class="crafted__card-overlay">
                        <h3 class="crafted__card-title">Handmade in Yogyakarta</h3>
                        <p class="crafted__card-desc">Crafted by skilled local makers.</p>
                    </div>
                </div>
                <div class="swiper-slide crafted__card">
                    <img src="{{ asset('image/craft-mid.png') }}" alt="Premium fabric construction"
                        class="crafted__card-image">
                    <div class="crafted__card-overlay">
                        <h3 class="crafted__card-title">Premium fabric construction</h3>
                        <p class="crafted__card-desc">Durable materials built for long display.</p>
                    </div>
                </div>
                <div class="swiper-slide crafted__card">
                    <img src="{{ asset('image/craft-right.png') }}" alt="Small batch production"
                        class="crafted__card-image">
                    <div class="crafted__card-overlay">
                        <h3 class="crafted__card-title">Small batch production</h3>
                        <p class="crafted__card-desc">Limited quantities to preserve uniqueness.</p>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination crafted__pagination"></div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.hero-swiper', {
                loop: true,
                allowTouchMove: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 1000,
                pagination: {
                    el: '.hero-swiper__pagination',
                    clickable: true,
                },
            });

            // Crafted to Last Swiper — mobile only
            let craftedSwiper = null;
            function initCraftedSwiper() {
                if (window.innerWidth <= 768 && !craftedSwiper) {
                    craftedSwiper = new Swiper('.crafted__swiper', {
                        slidesPerView: 1,
                        spaceBetween: 0,
                        loop: true,
                        autoplay: {
                            delay: 4000,
                            disableOnInteraction: false,
                        },
                        speed: 800,
                        // pagination: {
                        //     el: '.crafted__pagination',
                        //     clickable: true,
                        // },
                    });
                } else if (window.innerWidth > 768 && craftedSwiper) {
                    craftedSwiper.destroy(true, true);
                    craftedSwiper = null;
                }
            }
            initCraftedSwiper();
            window.addEventListener('resize', initCraftedSwiper);
        });
    </script>
@endpush