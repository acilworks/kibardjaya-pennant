@extends('layouts.app')

@section('title', 'Collections — Kibardjaya Pennant')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    {{-- ============================================
    SECTION 1: COLLECTIONS HERO
    ============================================ --}}
    <section class="clp-hero">
        <div class="clp-hero__left">
            <h1 class="clp-hero__title">COLLECTIONS.</h1>
            <!-- <a class="clp-hero__subtitle-link">PIECES AVAILABLE</a> -->
            <!-- <a href="/shop" class="clp-hero__subtitle-link">EXPLORE ALL ITEMS</a> -->
        </div>
        <div class="clp-hero__right">
            <p class="clp-hero__tagline">
                Curated pieces crafted in limited studio runs. <br> Explore by series, story, and intention.
            </p>
        </div>
    </section>

    {{-- ============================================
    SECTION 2: EXPLORE CATEGORIES
    ============================================ --}}
    <section class="clp-categories">
        <div class="clp-categories__header">
            <h2 class="clp-categories__label">Explore Categories</h2>
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

    {{-- ============================================
    SECTION 3: BLACK STATEMENT BAR
    ============================================ --}}
    <div class="clp-statement">
        <p class="clp-statement__text">Crafted for collectors who value story over trend.</p>
    </div>

    {{-- ============================================
    SECTION 4: STUDIO PICKS
    ============================================ --}}
    <section class="clp-picks">
        <div class="clp-picks__header">
            <h2 class="clp-picks__title">Studio Picks</h2>
            <a href="/shop" class="clp-picks__view-all">View All &rarr;</a>
        </div>
        <div class="clp-picks__grid">
            @foreach($studioPicks as $product)
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
    </section>

    {{-- ============================================
    SECTION 6: TRUST BLOCK
    ============================================ --}}
    <section class="pdp-trust" x-data="{ activeModal: null }" @trust-modal-open.window="activeModal = $event.detail">
        <div class="swiper pdp-trust__swiper clp-trust__swiper">
            <div class="swiper-wrapper">
                {{-- Card 1: 15% Off --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <h3 class="pdp-trust__card-title">15% Off<br>First Order</h3>
                        <p class="pdp-trust__card-desc">Subscribe to our newsletter and receive 15% off your first order.
                        </p>
                        <button class="pdp-trust__card-link" data-modal="discount">Info ↗</button>
                    </div>
                </div>

                {{-- Card 2: Ships Worldwide --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <h3 class="pdp-trust__card-title">Ships<br>Worldwide</h3>
                        <p class="pdp-trust__card-desc">Sends from our studio in Indonesia. For international orders, please
                            contact us.</p>
                        <button class="pdp-trust__card-link" data-modal="shipping">Info ↗</button>
                    </div>
                </div>

                {{-- Card 3: Handmade Studio --}}
                <div class="swiper-slide pdp-trust__card">
                    <div class="pdp-trust__card-overlay">
                        <h3 class="pdp-trust__card-title">Handmade<br>Studio Production</h3>
                        <p class="pdp-trust__card-desc">Produced in small batches and crafted individually in our Yogyakarta
                            studio.</p>
                        <button class="pdp-trust__card-link" data-modal="handmade">Info ↗</button>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination pdp-trust__pagination"></div>
        </div>

        {{-- Modals --}}
        <template x-teleport="body">
            <div>
                {{-- Discount Modal --}}
                <div class="pdp-trust__modal-backdrop" x-show="activeModal === 'discount'" x-cloak
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click.self="activeModal = null">
                    <div class="pdp-trust__modal">
                        <button class="pdp-trust__modal-close" @click="activeModal = null">&times;</button>
                        <h3 class="pdp-trust__modal-title">15% Off First Order</h3>
                        <p class="pdp-trust__modal-text">Subscribe to our newsletter and receive 15% off your first order.
                            The
                            discount code will be sent directly to your email after subscribing.</p>
                    </div>
                </div>

                {{-- Shipping Modal --}}
                <div class="pdp-trust__modal-backdrop" x-show="activeModal === 'shipping'" x-cloak
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click.self="activeModal = null">
                    <div class="pdp-trust__modal">
                        <button class="pdp-trust__modal-close" @click="activeModal = null">&times;</button>
                        <h3 class="pdp-trust__modal-title">Ships Worldwide</h3>
                        <p class="pdp-trust__modal-text">We ship from our studio in Indonesia. For international orders,
                            please
                            contact us directly for shipping estimates and customs information.</p>
                    </div>
                </div>

                {{-- Handmade Modal --}}
                <div class="pdp-trust__modal-backdrop" x-show="activeModal === 'handmade'" x-cloak
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click.self="activeModal = null">
                    <div class="pdp-trust__modal">
                        <button class="pdp-trust__modal-close" @click="activeModal = null">&times;</button>
                        <h3 class="pdp-trust__modal-title">Handmade Studio Production</h3>
                        <p class="pdp-trust__modal-text">Each piece is individually finished in our Yogyakarta studio. We
                            produce in small batches to preserve quality and craftsmanship in every pennant.</p>
                    </div>
                </div>
            </div>
        </template>
    </section>

    {{-- ============================================
    SECTION 5: NEW STUDIO DROP
    ============================================ --}}
    @if($newDrop)
        <section class="clp-drop">
            <div class="clp-drop__header">
                <h2 class="clp-drop__title">New Studio Drop</h2>
            </div>
            <div class="clp-drop__content">
                {{-- Left: Main product image + info --}}
                <div class="clp-drop__main">
                    <a href="/shop/{{ $newDrop->slug }}" class="clp-drop__main-link">
                        @if($newDrop->images && count($newDrop->images) > 0)
                            <div class="clp-drop__main-image">
                                <img src="{{ asset('storage/' . $newDrop->images[0]) }}" alt="{{ $newDrop->title }}">
                            </div>
                        @endif
                    </a>
                    <div class="clp-drop__main-info">
                        <div class="clp-drop__main-info-left">
                            <h3 class="clp-drop__main-name">{{ $newDrop->title }}</h3>
                            <span class="clp-drop__main-price">Rp. {{ number_format($newDrop->price, 0, ',', '.') }}</span>
                        </div>
                        <a href="/shop/{{ $newDrop->slug }}" class="clp-drop__main-add">+ ADD</a>
                    </div>
                </div>
                {{-- Right: 2x2 gallery grid --}}
                <div class="clp-drop__gallery">
                    @if($newDrop->images && count($newDrop->images) > 1)
                        @foreach(array_slice($newDrop->images, 1, 4) as $image)
                            <a href="/shop/{{ $newDrop->slug }}" class="clp-drop__gallery-item">
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $newDrop->title }}">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif


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

            // Trust Block Swiper
            new Swiper('.clp-trust__swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                pagination: {
                    el: '.pdp-trust__pagination',
                    clickable: true,
                },
                on: {
                    click: function (swiper, event) {
                        const trigger = event.target.closest('.pdp-trust__card-link');
                        if (trigger) {
                            window.dispatchEvent(new CustomEvent('trust-modal-open', {
                                detail: trigger.dataset.modal
                            }));
                        }
                    }
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3,
                        allowTouchMove: false,
                    }
                }
            });
        });
    </script>
@endpush