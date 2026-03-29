@extends('layouts.app')

@section('title', 'Collaborations – Kibardjaya Pennant')

@section('content')
    {{-- Hero Section --}}
    <section class="collab-hero">
        <h1 class="collab-hero__title">Collaborate.</h1>
        <div class="collab-hero__subtitle">
            <p class="collab-hero__tagline">Built together, story by story.</p>
            <p class="collab-hero__desc">
                We collaborate with creators, brands, and communities to
                turn shared ideas into meaningful pieces - crafted to be
                kept, not forgotten.
            </p>
        </div>
    </section>

    {{-- Collaboration Grid --}}
    <section class="collab-grid">
        <div class="collab-grid__row">
            @foreach($collaborations as $index => $collab)
                <div class="collab-card">
                    <div class="collab-card__image-wrap">
                        <img src="{{ asset($collab['image']) }}" alt="{{ $collab['title'] }}" class="collab-card__image"
                            loading="lazy">
                        <span class="collab-card__tag">{{ $collab['tag'] }}</span>
                    </div>
                    <div class="collab-card__info">
                        <h3 class="collab-card__title">{{ $collab['title'] }}</h3>
                        <p class="collab-card__desc">{{ $collab['desc'] }}</p>
                        <div class="collab-card__link-wrap">
                            <a href="{{ $collab['url'] }}" class="collab-card__link">See Collaboration</a>
                            <span class="collab-card__link-arrow">&rarr;</span>
                        </div>
                    </div>
                </div>
                @if($index === 2)
                    </div>
                    <div class="collab-grid__row">
                @endif
            @endforeach
        </div>
    </section>

    {{-- Pagination (shop-style) --}}
    <div class="shop-pagination-wrap">
        <div class="shop-pagination__info">1 OF 1</div>
        <div class="shop-pagination__progress">
            <div class="shop-pagination__progress-bar" style="width: 100%;"></div>
        </div>
        <a href="#" class="shop-pagination__button">Load More Pieces</a>
    </div>

    {{-- CTA Section --}}
    <section class="collab-cta">
        <div class="collab-cta__inner">
            <span class="collab-cta__label">Let's Collaborate</span>
            <h2 class="collab-cta__title">Have an Idea in Mind?</h2>
            <p class="collab-cta__desc">Let's talk, visualize, create, and remember.</p>
            <div class="collab-cta__link-wrap">
                <a href="#" class="collab-cta__link">Start a Collab Story</a>
                <span class="collab-cta__link-arrow">&rarr;</span>
            </div>
        </div>
    </section>

    {{-- ============================================
    RUNNING TEXT MARQUEE
    ============================================ --}}
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
@endsection