@extends('layouts.app')

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
    <div class="syd__grid">
        <a href="/custom/pennant" class="syd__card">
            <div class="syd__card-img-wrap">
                <img src="{{ asset('image/syd-01.jpg') }}" alt="Pennant" class="syd__card-img" loading="lazy">
            </div>
            <div class="syd__card-info">
                <div class="syd__card-info-left">
                    <h3 class="syd__card-title">PENNANT</h3>
                    <p class="syd__card-desc">Classic triangular felt pennant, hand-printed.</p>
                </div>
                <span class="syd__card-arrow">&rarr;</span>
            </div>
        </a>
        <a href="#" class="syd__card">
            <div class="syd__card-img-wrap">
                <img src="{{ asset('image/syd-02.jpeg') }}" alt="Banner" class="syd__card-img" loading="lazy">
            </div>
            <div class="syd__card-info">
                <div class="syd__card-info-left">
                    <h3 class="syd__card-title">BANNER</h3>
                    <p class="syd__card-desc">Rectangular felt banner, perfect for display.</p>
                </div>
                <span class="syd__card-arrow">&rarr;</span>
            </div>
        </a>
        <a href="#" class="syd__card">
            <div class="syd__card-img-wrap">
                <img src="{{ asset('image/syd-03.jpeg') }}" alt="Camp Flag" class="syd__card-img" loading="lazy">
            </div>
            <div class="syd__card-info">
                <div class="syd__card-info-left">
                    <h3 class="syd__card-title">CAMP FLAG</h3>
                    <p class="syd__card-desc">5-sided camp flag, built for outdoor display.</p>
                </div>
                <span class="syd__card-arrow">&rarr;</span>
            </div>
        </a>
    </div>
</section>

{{-- How Custom Works Section --}}
<section class="hcw">
    <div class="hcw__header">
        <span class="hcw__label">HOW CUSTOM WORKS WITH</span>
    </div>
    <div class="hcw__steps">
        <div class="hcw__step">
            <span class="hcw__step-num">1. CHOOSE YOUR PRODUCT</span>
            <p class="hcw__step-desc">Choose a pennant, banner, or camp flag — and start from your vision.</p>
        </div>
        <div class="hcw__step">
            <span class="hcw__step-num">2. DESIGN YOUR PIECE</span>
            <p class="hcw__step-desc">Pick your colors, text, and layout — make it uniquely yours.</p>
        </div>
        <div class="hcw__step">
            <span class="hcw__step-num">3. WE CRAFT BY HAND</span>
            <p class="hcw__step-desc">Handmade in Yogyakarta Studio — crafted with care and precision.</p>
        </div>
        <div class="hcw__step">
            <span class="hcw__step-num">4. ORDER DELIVERED</span>
            <p class="hcw__step-desc">We deliver your custom piece — shipped safely to your door.</p>
        </div>
    </div>
</section>

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