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
            <div class="hero__bg" style="background-image: url('{{ asset('image/bg-hero.webp') }}');"></div>
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
    <!-- <section class="brand-story">
                                    <div class="brand-story__inner">
                                        <div class="brand-story__heading">
                                            <h2 class="brand-story__title">MORE THAN<br>A SOUVENIR.</h2>
                                        </div>
                                        <div class="brand-story__text">
                                            <p class="brand-story__tagline">Bring your story home</p>
                                            <p class="brand-story__desc">
                                                There was a time when travelers brought home pennants as proof
                                                of where they had been. A small symbol. A lasting memory.
                                                <br>

                                                Kibardjaya revives that tradition, reimagined for modern
                                                collectors who value story, craftsmanship, and timeless design.
                                            </p>
                                        </div>
                                    </div>
                                </section> -->

    {{-- Hero Section --}}
    <section class="collab-hero">
        <h1 class="collab-hero__title">More Than A Souvenir.</h1>
        <div class="collab-hero__subtitle">
            <p class="collab-hero__tagline">Bring your story home.</p>
            <p class="collab-hero__desc">
                There was a time when travelers brought home pennants as proof
                of where they had been. A small symbol. A lasting memory.
                <br>
                Kibardjaya revives that tradition, reimagined for modern
                collectors who value story, craftsmanship, and timeless design.
            </p>
        </div>
    </section>

    {{-- New Collections --}}
    <section class="collections">
        <div class="collections__header">
            <h2 class="collections__title">New Collections</h2>
            <div class="collections__view-all-wrap">
                <a href="/shop" class="collections__view-all">View All</a>
                <span class="collections__view-all-arrow">&rarr;</span>
            </div>
        </div>
        <div class="collections__grid">
            @foreach($products as $product)
                @include('components._product-card', ['product' => $product])
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
            <picture>
                <source srcset="{{ asset('image/custom-img.webp') }}" type="image/webp">
                <img src="{{ asset('image/custom-img.jpeg') }}" alt="Custom Pennant Order" class="custom-order__image"
                    loading="lazy">
            </picture>
        </div>
        <div class="custom-order__content">
            <!-- <p class="custom-order__tagline">Not every journey is the same.</p> -->
            <h2 class="custom-order__title">Create Your Own Story</h2>
            <p class="custom-order__desc">
                Some stories are meant to be created.<br>
                Design a piece that reflects yours,
                whether it’s a pennant, banner, or flag. <br>Choose your message, your colors, your style.
                We’ll bring it to life by hand.
                Made to keep. Made to remember.

            </p>
            <div class="custom-order__cta-wrap">
                <a href="/custom" class="custom-order__cta">Start Your Design </a>
                <span class="custom-order__cta-arrow">&rarr;</span>
            </div>
        </div>
    </section>

    {{-- Collaboration Grid (Latest 3) --}}
    @if($collaborations->count() > 0)
        <div class="collab__header">
            <h2 class="collab__title">Collaborations</h2>
            <div class="collab__view-all-wrap">
                <a href="/collaborations" class="collab__view-all">View All</a>
                <span class="collab__view-all-arrow">&rarr;</span>
            </div>
        </div>
        <section class="collab-grid">
            <!-- <div class="collab__header">
                                                <h2 class="collab__title">Collaborations</h2>
                                                <div class="collab__view-all-wrap">
                                                    <a href="/collaborations" class="collab__view-all">View All</a>
                                                    <span class="collab__view-all-arrow">&rarr;</span>
                                                </div>
                                            </div> -->
            <div class="collab-grid__row">
                @foreach($collaborations as $collab)
                    <div class="collab-card">
                        <div class="collab-card__image-wrap">
                            <img src="{{ $collab->image ? Storage::url($collab->image) : asset('image/placeholder.jpg') }}"
                                alt="{{ $collab->title }}" class="collab-card__image" loading="lazy">
                            <span class="collab-card__tag">{{ $collab->tag }}</span>
                        </div>
                        <div class="collab-card__info">
                            <h3 class="collab-card__title">{{ $collab->title }}</h3>
                            <p class="collab-card__desc">{{ $collab->desc }}</p>
                            <div class="collab-card__link-wrap">
                                <a href="{{ $collab->url ?? '#' }}" class="collab-card__link">See Collaboration</a>
                                <span class="collab-card__link-arrow">&rarr;</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <div class="collab__header">
            <h2 class="collab__title"></h2>
            <div class="collab__view-all-wrap">
                <!-- <a href="/collaborations" class="collab__view-all">View All</a>
                        <span class="collab__view-all-arrow">&rarr;</span> -->
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Product Card Swipers
            document.querySelectorAll('.product-card__swiper').forEach(function (el) {
                new Swiper(el, {
                    slidesPerView: 1,
                    loop: false,
                    pagination: {
                        el: el.querySelector('.product-card__swiper-pagination'),
                        clickable: true,
                    },
                    navigation: {
                        prevEl: el.querySelector('.product-card__swiper-prev'),
                        nextEl: el.querySelector('.product-card__swiper-next'),
                    },
                });
            });

            new Swiper('.hero-swiper', {
                loop: true,
                allowTouchMove: true,
                autoplay: {
                    delay: 8000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 1000,
                pagination: {
                    el: '.hero-swiper__pagination',
                    clickable: true,
                },
            });


        });
    </script>
@endpush