@extends('layouts.app')

@section('title', 'Shop — Kibardjaya Pennant')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    {{-- ============================================
    SHOP HERO
    ============================================ --}}
    <!-- <section class="shop-hero">
                                        <h1 class="shop-hero__title">ALL PIECES.</h1>
                                        <p class="shop-hero__desc">
                                            Explore our complete collection of handcrafted pennants, banners, and flags.
                                            Made for collectors, spaces, and stories.
                                        </p>
                                    </section> -->

    {{-- Hero Section --}}
    <!-- <section class="collab-hero" style="border-bottom: 1px solid #1a1a1a;">
                <h1 class="collab-hero__title">All Pieces.</h1>
                <div class="collab-hero__subtitle">
                    <p class="collab-hero__tagline">Made for collectors, spaces, and stories.</p>
                    <p class="collab-hero__desc">
                        Explore handcrafted pennants, banners, flags, and more.
                        Designed for collectors, spaces, and personal stories.
                        Find the piece that feels like yours.
                    </p>
                </div>
            </section> -->
    <section class="collab-hero" style="border-bottom: 1px solid #1a1a1a;">
        <h1 class="collab-hero__title">Collections.</h1>
        <div class="collab-hero__subtitle">
            <p class="collab-hero__tagline">Curated Pieces, Stories in series.</p>
            <p class="collab-hero__desc">
                Thoughtfully crafted in limited studio runs.
                Each piece belongs to a story, a place, or a moment.
                Explore collections made to be kept - not just owned.
            </p>
        </div>
    </section>

    {{-- ============================================
    SHOP FILTER & GRID WRAPPER
    ============================================ --}}
    <div x-data="{ filterOpen: false, sortOpen: false, gridCols: 2 }" @click.away="filterOpen = false; sortOpen = false">

        {{-- ============================================
        SHOP FILTER
        ============================================ --}}
        <div class="shop-filter">
            {{-- Filter Dropdown --}}
            <div class="shop-filter__group">
                <button class="shop-filter__toggle" @click="filterOpen = !filterOpen; sortOpen = false">
                    @if($currentCategory)
                        FILTER: {{ strtoupper(str_replace('-', ' ', $currentCategory)) }}
                    @elseif($currentSubCategory)
                        FILTER: {{ strtoupper(str_replace('-', ' ', $currentSubCategory)) }}
                    @else
                        FILTER
                    @endif
                    <span x-show="!filterOpen">&#9662;</span>
                    <span x-show="filterOpen" x-cloak>&#9652;</span>
                </button>
                <div class="shop-filter__dropdown" x-show="filterOpen" x-cloak x-transition>
                    <a href="/shop{{ request()->has('sort') ? '?sort=' . request('sort') : '' }}"
                        class="shop-filter__item {{ !$currentCategory && !$currentSubCategory ? 'shop-filter__item--active' : '' }}">ALL
                        PIECES</a>
                    @foreach($categories as $category)
                                <a href="/shop?category={{ $category->slug }}{{ request()->has('sort') ? '&sort=' . request('sort') : '' }}"
                                    class="shop-filter__item shop-filter__item--cat {{ $currentCategory == $category->slug ? 'shop-filter__item--active' : '' }}">{{
                        strtoupper($category->name) }}</a>
                    @endforeach
                    <div style="border-top: 1px solid #e1e1e1; margin: 4px 0;"></div>
                    @foreach($subCategories as $subCat)
                                <a href="/shop?subcategory={{ $subCat->slug }}{{ request()->has('sort') ? '&sort=' . request('sort') : '' }}"
                                    class="shop-filter__item shop-filter__item--sub {{ $currentSubCategory == $subCat->slug ? 'shop-filter__item--active' : '' }}">{{
                        strtoupper($subCat->name) }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Sort Dropdown (Desktop) & Grid View Toggle (Mobile) --}}
            <div class="shop-filter__group">
                {{-- Desktop Sort Button --}}
                <button class="shop-filter__toggle shop-filter__toggle--sort-btn xl:flex lg:flex md:flex hidden"
                    @click="sortOpen = !sortOpen; filterOpen = false">
                    SORT:
                    @if($currentSort === 'latest')
                        NEWEST
                    @elseif($currentSort === 'price_asc')
                        PRICE LOW-HIGH
                    @elseif($currentSort === 'price_desc')
                        PRICE HIGH-LOW
                    @else
                        NO. FL
                    @endif
                    <span x-show="!sortOpen">&#9662;</span>
                    <span x-show="sortOpen" x-cloak>&#9652;</span>
                </button>

                {{-- Mobile Grid View Toggles --}}
                <div class="shop-filter__view-toggle md:hidden flex gap-2 items-center">
                    <button @click="gridCols = 1" :class="{'opacity-100': gridCols === 1, 'opacity-30': gridCols !== 1}">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="currentColor">
                            <rect x="3" y="3" width="18" height="18" />
                        </svg>
                    </button>
                    <button @click="gridCols = 2" :class="{'opacity-100': gridCols === 2, 'opacity-30': gridCols !== 2}">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="currentColor">
                            <rect x="3" y="3" width="8" height="8" />
                            <rect x="13" y="3" width="8" height="8" />
                            <rect x="3" y="13" width="8" height="8" />
                            <rect x="13" y="13" width="8" height="8" />
                        </svg>
                    </button>
                </div>

                <div class="shop-filter__dropdown shop-filter__dropdown--right" x-show="sortOpen" x-cloak x-transition>
                    @php
                        $filterQuery = '';
                        if (request()->has('category'))
                            $filterQuery = 'category=' . request('category') . '&';
                        if (request()->has('subcategory'))
                            $filterQuery = 'subcategory=' . request('subcategory') . '&';
                    @endphp
                    <a href="/shop?{{ $filterQuery }}sort=latest"
                        class="shop-filter__item {{ $currentSort == 'latest' ? 'shop-filter__item--active' : '' }}">NEWEST</a>
                    <a href="/shop?{{ $filterQuery }}sort=price_asc"
                        class="shop-filter__item {{ $currentSort == 'price_asc' ? 'shop-filter__item--active' : '' }}">PRICE
                        LOW-HIGH</a>
                    <a href="/shop?{{ $filterQuery }}sort=price_desc"
                        class="shop-filter__item {{ $currentSort == 'price_desc' ? 'shop-filter__item--active' : '' }}">PRICE
                        HIGH-LOW</a>
                </div>
            </div>
        </div>

        {{-- ============================================
        SHOP GRID
        ============================================ --}}
        <div class="shop-grid" :class="{'shop-grid--1col': gridCols === 1}">
            @foreach($products as $product)
                @include('components._product-card', ['product' => $product])
            @endforeach
        </div>
    </div>

    {{-- ============================================
    SHOP PAGINATION
    ============================================ --}}
    <div class="shop-pagination-wrap">
        <div class="shop-pagination__info">
            {{ $products->currentPage() }} OF {{ $products->lastPage() }}
        </div>
        <div class="shop-pagination__progress">
            <div class="shop-pagination__progress-bar"
                style="width: {{ ($products->currentPage() / $products->lastPage()) * 100 }}%;"></div>
        </div>
        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="shop-pagination__button">
                LOAD MORE PIECES
            </a>
        @endif
    </div>

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

    {{-- ============================================
    START YOUR DESIGN
    ============================================ --}}
    <section class="syd" style="border-top: none;">
        <div class="syd__header">
            <span class="syd__label">CREATE YOUR OWN PIECE</span>
        </div>
        <div class="syd__body">
            <div class="swiper syd__swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="/custom/pennant" class="syd__card">
                            <div class="syd__card-img-wrap">
                                <img src="{{ asset('image/syd-01.webp') }}" alt="Pennant" class="syd__card-img"
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
                        <a href="/custom/banner" class="syd__card">
                            <div class="syd__card-img-wrap">
                                <img src="{{ asset('image/syd-02.webp') }}" alt="Banner" class="syd__card-img"
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
                        <a href="/custom/camp-flag" class="syd__card">
                            <div class="syd__card-img-wrap">
                                <img src="{{ asset('image/syd-03.webp') }}" alt="Camp Flag" class="syd__card-img"
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

            // Start Your Design Swiper
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
        });
    </script>
@endpush