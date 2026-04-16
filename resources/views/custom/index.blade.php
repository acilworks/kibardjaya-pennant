@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="collab-hero">
        <h1 class="collab-hero__title">Make Your Own.</h1>
        <div class="collab-hero__subtitle">
            <p class="collab-hero__tagline">Designed by you. Made by hand.</p>
            <p class="collab-hero__desc">
                Whether it's for your home, your brand, or your crew. Design a custom flag that tells your story. Choose
                your shape, colors, and text. We'll handle the rest.
            </p>
        </div>
    </section>

    {{-- Start Your Design Section --}}
    <section class="syd">
        <!-- <div class="syd__header">
                                                                                                <span class="syd__label">START YOUR DESIGN</span>
                                                                                            </div> -->
        <div class="syd__body">
            <div class="swiper syd__swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="/custom/pennant" class="syd__card">
                            <div class="syd__card-img-wrap">
                                <img src="{{ asset('image/custom-pennant.gif') }}" alt="Pennant" class="syd__card-img"
                                    loading="lazy">
                            </div>
                            <div class="syd__card-info">
                                <div class="syd__card-info-left">
                                    <h3 class="syd__card-title">PENNANT</h3>
                                    <p class="syd__card-desc">Classic triangular flags.</p>
                                </div>
                                <span class="syd__card-arrow">&rarr;</span>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="/custom/banner" class="syd__card">
                            <div class="syd__card-img-wrap">
                                <img src="{{ asset('image/custom-banner.webp') }}" alt="Banner" class="syd__card-img"
                                    loading="lazy">
                            </div>
                            <div class="syd__card-info">
                                <div class="syd__card-info-left">
                                    <h3 class="syd__card-title">BANNER</h3>
                                    <p class="syd__card-desc">Rectangular banner flags.</p>
                                </div>
                                <span class="syd__card-arrow">&rarr;</span>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="/custom/camp-flag" class="syd__card">
                            <div class="syd__card-img-wrap">
                                <img src="{{ asset('image/custom-5sided.gif') }}" alt="Camp Flag" class="syd__card-img"
                                    loading="lazy">
                            </div>
                            <div class="syd__card-info">
                                <div class="syd__card-info-left">
                                    <h3 class="syd__card-title">CAMP FLAG</h3>
                                    <p class="syd__card-desc">5-sided camp flags.</p>
                                </div>
                                <span class="syd__card-arrow">&rarr;</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How Custom Works Section (Trust Block style) --}}
    <section class="pdp-trust">
        <div class="hcw__header">
            <span class="hcw__label">HOW CUSTOM ORDERS WORK</span>
        </div>
        <div class="swiper pdp-trust__swiper cst-hcw__swiper">
            <div class="swiper-wrapper">
                {{-- Step 1 --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <h3 class="pdp-trust__card-title">Choose<br>Your Product</h3>
                        <p class="pdp-trust__card-desc">Pennant, banner, or flag.</p>
                        <h3 class="pdp-trust__card-title-number">[1]</h3>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <h3 class="pdp-trust__card-title">Design<br>Your Piece</h3>
                        <p class="pdp-trust__card-desc">Pick your colors and add your message or logo.</p>
                        <h3 class="pdp-trust__card-title-number">[2]</h3>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <h3 class="pdp-trust__card-title">We Craft<br>By Hand</h3>
                        <p class="pdp-trust__card-desc">Made in our Yogyakarta studio.</p>
                        <h3 class="pdp-trust__card-title-number">[3]</h3>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <h3 class="pdp-trust__card-title">Ships<br>Worldwide</h3>
                        <p class="pdp-trust__card-desc">Delivered to your door.</p>
                        <h3 class="pdp-trust__card-title-number">[4]</h3>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination pdp-trust__pagination"></div>
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

    {{-- Personalized By You Section --}}
    <section class="pby" id="custom-pby">
        <div class="pby__image-wrap">
            <img src="{{ asset('image/personalized.webp') }}" alt="Personalized Pennants" class="pby__image" loading="lazy">
        </div>
        <div class="pby__content">
            <h2 class="pby__title">PERSONALIZED<br>BY YOU</h2>
            <p class="pby__desc">
                Every design starts with you. Choose from a variety of styles,
                colors, and materials to create something truly
                unique. <br><br>Whether it's a classic felt pennant for your collection
                or a bold camp flag for your next adventure.
                We bring your vision to life, one stitch at a time.
            </p>
            <div class="pby__links">
                <a href="https://wa.me/6285119960101?text=Hi%20Kibardjaya,%20I’d%20love%20to%20create%20a%20custom%20piece.%20Can%20you%20help%20me?"
                    class="pby__link">Talk to Us About Your Design</a>
                <span class="pby__link-arrow">&rarr;</span>
            </div>
        </div>
    </section>

    {{-- Inside Kibar Studio Section --}}
    <section class="iks">
        <div class="hcw__header">
            <span class="hcw__label">KIBAR STUDIO</span>
        </div>
        <div class="iks__media">
            <img src="{{ asset('image/craft-left.webp') }}" alt="Inside Kibar Studio" class="iks__image" loading="lazy">
            <div class="iks__overlay">
                <h2 class="iks__title">INSIDE KIBAR STUDIO</h2>
                <p class="iks__desc">See how your flags are made — from screen-printing to cutting, hand-sewn with care in
                    Yogyakarta.</p>
                <a href="#" class="iks__cta">LEARN MORE</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.syd__swiper', {
                slidesPerView: 3,
                spaceBetween: 0,
                loop: false,
                breakpoints: {
                    0: {
                        slidesPerView: 1.3,
                        spaceBetween: 0,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 0,
                    },
                },
            });

            // How Custom Works — Trust Block Swiper
            new Swiper('.cst-hcw__swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: false,
                pagination: {
                    el: '.cst-hcw__swiper .pdp-trust__pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 4,
                        allowTouchMove: false,
                    }
                }
            });
        });
    </script>
@endpush