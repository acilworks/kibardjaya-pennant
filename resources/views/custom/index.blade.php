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
                        <!-- <span
                                                                                                                            style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">01
                                                                                                                            — CHOOSE YOUR PRODUCT</span>
                                                                                                                        <h3 class="pdp-trust__card-title">Start<br>with the base.</h3>
                                                                                                                        <p class="pdp-trust__card-desc">Select the format that fits your story — a classic pennant, a bold
                                                                                                                            banner, or a timeless camp flag. Each piece is designed to stand out and last.</p>
                                                                                                                         -->

                        <div class="swiper-slide" style="padding-top: 10px; border-bottom: 1px solid #1a1a1a;">
                            <span
                                style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">01
                                — CHOOSE YOUR PRODUCT</span>
                            <h3
                                style="font-size: 24px; font-weight: 900; line-height: 1.3; text-transform: uppercase; margin: 0 0 20px 0;">
                                Start with<br>the base.</h3>
                            <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                                Select the format that fits your story — a classic pennant, a bold
                                banner, or a timeless camp flag. Each piece is designed to stand out and last.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <!-- <span
                                                                                style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">02
                                                                                — DESIGN YOUR PIECE</span>
                                                                            <h3 class="pdp-trust__card-title">Make<br>it yours.</h3>
                                                                            <p class="pdp-trust__card-desc">Add your words, logo, or idea. Choose your colors, layout, and style
                                                                                — or simply share your vision, and we’ll help shape it into something meaningful.</p>
                                                                             -->
                        <div class="swiper-slide" style="padding-top: 10px; border-bottom: 1px solid #1a1a1a;">
                            <span
                                style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">02
                                — DESIGN YOUR PIECE</span>
                            <h3
                                style="font-size: 24px; font-weight: 900; line-height: 1.3; text-transform: uppercase; margin: 0 0 20px 0;">
                                Make<br>it yours.</h3>
                            <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                                Add your words, logo, or idea. Choose your colors, layout, and style
                                — or simply share your vision, and we’ll help shape it into something meaningful.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <!-- <span
                                                                            style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">03
                                                                            — WE CRAFT BY HAND</span>
                                                                        <h3 class="pdp-trust__card-title">Built<br>with care.</h3>
                                                                        <p class="pdp-trust__card-desc">Every piece is cut, assembled, and finished by hand in our
                                                                            Yogyakarta studio. No mass production — just thoughtful craftsmanship in every detail.</p>
                                                                         -->
                        <div class="swiper-slide" style="padding-top: 10px; border-bottom: 1px solid #1a1a1a;">
                            <span
                                style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">03
                                — WE CRAFT BY HAND</span>
                            <h3
                                style="font-size: 24px; font-weight: 900; line-height: 1.3; text-transform: uppercase; margin: 0 0 20px 0;">
                                Built<br>with care.</h3>
                            <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                                Every piece is cut, assembled, and finished by hand in our
                                Yogyakarta studio. No mass production — just thoughtful craftsmanship in every detail.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <!-- <span
                                                                        style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">04
                                                                        — SHIPS WORLDWIDE</span>
                                                                    <h3 class="pdp-trust__card-title">From our Hands<br>to Your Space</h3>
                                                                    <p class="pdp-trust__card-desc">Your custom piece is carefully packed and shipped to your door,
                                                                        wherever you are. Ready to hang, ready to tell your story.</p>
                                                                     -->
                        <div class="swiper-slide" style="padding-top: 10px; border-bottom: 1px solid #1a1a1a;">
                            <span
                                style="font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 20px; opacity: 0.6;">04
                                — SHIPS WORLDWIDE</span>
                            <h3
                                style="font-size: 24px; font-weight: 900; line-height: 1.3; text-transform: uppercase; margin: 0 0 20px 0;">
                                From our Hands<br>to Your Space</h3>
                            <p style="font-size: 15px; line-height: 1.6; max-width: 400px; margin: 0;">
                                Your custom piece is carefully packed and shipped to your door,
                                wherever you are. Ready to hang, ready to tell your story.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-button-prev cst-hcw__nav"></div>
            <div class="swiper-button-next cst-hcw__nav"></div>

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
            <h2 class="pby__title">PERSONALIZED BY YOU</h2>
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
                // pagination: {
                //     el: '.cst-hcw__swiper .pdp-trust__pagination',
                //     clickable: true,
                // },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2.3,
                        allowTouchMove: true,
                    }
                }
            });
        });
    </script>
@endpush