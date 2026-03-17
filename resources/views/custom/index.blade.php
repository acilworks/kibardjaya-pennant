@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
{{-- Hero Section --}}
<section class="cst-hero">
    <div class="cst-hero__left">
        <h1 class="cst-hero__title">MAKE YOUR<br>OWN FLAGS.</h1>
    </div>
    <div class="cst-hero__right">
        <p class="cst-hero__tagline">Designed by you. Made by hand.</p>
        <p class="cst-hero__desc">
            Whether it's for your home, your brand, or your crew. Design a custom flag that tells your story. Choose
            your shape, colors, and text. We'll handle the rest.
        </p>
        <!-- <a href="/custom/pennant" class="cst-hero__cta">START DESIGNING &rarr;</a> -->
    </div>
</section>

{{-- Start Your Design Section --}}
<section class="syd">
    <div class="syd__header">
        <span class="syd__label">START YOUR DESIGN</span>
    </div>
    <div class="syd__body">
        <div class="swiper syd__swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="/custom/pennant" class="syd__card">
                        <div class="syd__card-img-wrap">
                            <img src="{{ asset('image/syd-01.jpg') }}" alt="Pennant" class="syd__card-img"
                                loading="lazy">
                        </div>
                        <div class="syd__card-info">
                            <div class="syd__card-info-left">
                                <h3 class="syd__card-title">PENNANT</h3>
                                <p class="syd__card-desc">Classic triangular felt pennant.</p>
                            </div>
                            <span class="syd__card-arrow">&rarr;</span>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#" class="syd__card">
                        <div class="syd__card-img-wrap">
                            <img src="{{ asset('image/syd-02.jpeg') }}" alt="Banner" class="syd__card-img"
                                loading="lazy">
                        </div>
                        <div class="syd__card-info">
                            <div class="syd__card-info-left">
                                <h3 class="syd__card-title">BANNER</h3>
                                <p class="syd__card-desc">Rectangular banner for interiors.</p>
                            </div>
                            <span class="syd__card-arrow">&rarr;</span>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#" class="syd__card">
                        <div class="syd__card-img-wrap">
                            <img src="{{ asset('image/syd-03.jpeg') }}" alt="Camp Flag" class="syd__card-img"
                                loading="lazy">
                        </div>
                        <div class="syd__card-info">
                            <div class="syd__card-info-left">
                                <h3 class="syd__card-title">CAMP FLAG</h3>
                                <p class="syd__card-desc">5-sided camp flag for shops and brands.</p>
                            </div>
                            <span class="syd__card-arrow">&rarr;</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- How Custom Works Section --}}
<section class="hcw">
    <div class="hcw__header">
        <span class="hcw__label">HOW CUSTOM ORDERS WORK</span>
    </div>
    <div class="hcw__steps">
        <div class="hcw__step">
            <span class="hcw__step-num">1. CHOOSE YOUR PRODUCT</span>
            <p class="hcw__step-desc">Pennant, banner, or flag.</p>
        </div>
        <div class="hcw__step">
            <span class="hcw__step-num">2. DESIGN YOUR PIECE</span>
            <p class="hcw__step-desc">Pick your colors and add your message or logo.</p>
        </div>
        <div class="hcw__step">
            <span class="hcw__step-num">3. WE CRAFT BY HAND</span>
            <p class="hcw__step-desc">Made in our Yogyakarta studio.</p>
        </div>
        <div class="hcw__step">
            <span class="hcw__step-num">4. SHIPS WORLDWIDE</span>
            <p class="hcw__step-desc">Delivered to your door.</p>
        </div>
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
<section class="pby">
    <div class="pby__image-wrap">
        <img src="{{ asset('image/personalized-01.jpeg') }}" alt="Personalized Pennants" class="pby__image"
            loading="lazy">
    </div>
    <div class="pby__content">
        <h2 class="pby__title">PERSONALIZED<br>BY YOU</h2>
        <p class="pby__desc">
            Every design starts with you. Choose from a variety of styles,
            colors, and materials to create something truly
            unique. Whether it's a classic felt pennant for your collection
            or a bold camp flag for your next adventure —
            we bring your vision to life, one stitch at a time.
        </p>
        <div class="pby__links">
            <a href="/custom/pennant" class="pby__link">Start Your Custom Pennant</a>
            <a href="#" class="pby__link">Personalized Quote & Corporate Items</a>
        </div>
    </div>
</section>

{{-- Inside Kibar Studio Section --}}
<section class="iks">
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
                    slidesPerView: 1.2,
                    spaceBetween: 0,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 0,
                },
            },
        });
    });
</script>
@endpush