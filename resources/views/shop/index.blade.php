@extends('layouts.app')

@section('title', 'Shop — Kibardjaya Pennant')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    {{-- ============================================
    SHOP HERO
    ============================================ --}}
    <section class="shop-hero">
        <h1 class="shop-hero__title">ALL PIECES.</h1>
        <p class="shop-hero__desc">
            Explore the complete collection of standard pennants and statement pieces.
        </p>
    </section>

    {{-- ============================================
    SHOP FILTER
    ============================================ --}}
    <div class="shop-filter">
        <span>FILTER</span>
        <span>SORT: NO. FL</span>
    </div>

    {{-- ============================================
    SHOP GRID
    ============================================ --}}
    <div class="shop-grid">
        @foreach($products as $product)
            <a href="/shop/{{ $product->slug }}"
                class="product-card {{ $product->is_sold_out ? 'product-card--sold-out' : '' }}">
                @if($product->images && count($product->images) > 0)
                    <div class="product-card__image-wrap">
                        @if($product->subCategory)
                            <div class="product-card__badge">{{ $product->subCategory->name }}</div>
                        @endif
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
                            {{ number_format($product->price, 0, ',', '.') }}
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

    {{-- ============================================
    SHOP PAGINATION
    ============================================ --}}
    <div class="shop-pagination-wrap">
        {{ $products->links() }}
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
    EXPLORE BY PRODUCT TYPE
    ============================================ --}}
    <section class="clp-categories" style="border-top: none;">
        <div class="clp-categories__header">
            <h2 class="clp-categories__label">EXPLORE BY PRODUCT TYPE</h2>
        </div>
        <div class="swiper clp-categories__swiper">
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                    <div class="swiper-slide clp-categories__slide">
                        <a href="/shop" class="clp-categories__card">
                            <div class="clp-categories__card-image">
                                @if($category->thumbnail)
                                    <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}">
                                @else
                                    <div class="clp-categories__card-placeholder"></div>
                                @endif
                            </div>
                            <div class="clp-categories__card-info">
                                @if($category->tagline)
                                    <p class="clp-categories__card-tagline">{{ $category->tagline }}</p>
                                @endif
                                <div class="clp-categories__card-bottom">
                                    <span class="clp-categories__card-arrow">&rarr;</span>
                                    <h3 class="clp-categories__card-name">{{ $category->name }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Categories Swiper
            new Swiper('.clp-categories__swiper', {
                slidesPerView: 'auto',
                spaceBetween: 30,
                grabCursor: true,
                freeMode: true,
            });
        });
    </script>
@endpush