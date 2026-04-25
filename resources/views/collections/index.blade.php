@extends('layouts.app')

@section('title', 'Collections — Kibardjaya Pennant')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    {{-- ============================================
    SECTION 1: COLLECTIONS HERO
    ============================================ --}}

    {{-- Hero Section --}}
    <section class="collab-hero">
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
    SECTION 2: EXPLORE CATEGORIES
    ============================================ --}}
    <section class="syd">
        <!-- <div class="syd__header">
                                                                                                                                                                                                                                                                                                                                                                                                            <span class="syd__label">Explore Categories</span>
                                                                                                                                                                                                                                                                                                                                                                                                        </div> -->
        <div class="syd__body">
            <div class="swiper clp-categories__swiper">
                <div class="swiper-wrapper">
                    @foreach($categories as $category)
                        <div class="swiper-slide">
                            <a href="/shop?category={{ $category->slug }}" class="syd__card">
                                <div class="syd__card-img-wrap">
                                    @if($category->thumbnail)
                                        <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}"
                                            class="syd__card-img" loading="lazy">
                                    @else
                                        <div
                                            style="width:100%;height:100%;background:#e8e4dd;display:flex;align-items:center;justify-content:center;">
                                        </div>
                                    @endif
                                </div>
                                <div class="syd__card-info">
                                    <div class="syd__card-info-left">
                                        <h3 class="syd__card-title">{{ $category->name }}</h3>
                                        @if($category->tagline)
                                            <p class="syd__card-desc">{{ $category->tagline }}</p>
                                        @endif
                                    </div>
                                    <span class="syd__card-arrow">&rarr;</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    SECTION 3: BLACK STATEMENT BAR
    ============================================ --}}

    {{-- ============================================
    SECTION 4: STUDIO PICKS
    ============================================ --}}
    <section class="clp-picks">
        <!-- <div class="clp-picks__header">
                                                                                                                                                                                                                                                                                                                                                                                            <h2 class="clp-picks__title">Studio Picks</h2>
                                                                                                                                                                                                                                                                                                                                                                                            <a href="/shop" class="clp-picks__view-all">View All &rarr;</a>
                                                                                                                                                                                                                                                                                                                                                                                        </div> -->
        <div class="collections__header" style="border-bottom: 1px solid #1a1a1a;">
            <h2 class="collections__title">Studio Picks</h2>
            <div class="collections__view-all-wrap">
                <a href="/shop" class="collections__view-all">View All</a>
                <span class="collections__view-all-arrow">&rarr;</span>
            </div>
        </div>
        <div class="swiper picks-swiper">
            <div class="swiper-wrapper">
                @foreach($studioPicks as $product)
                    <div class="swiper-slide" style="height: auto; display: flex;">
                        @include('components._product-card', ['product' => $product])
                    </div>
                @endforeach
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
            <div class="swiper-button-prev clp-trust__nav"></div>
            <div class="swiper-button-next clp-trust__nav"></div>
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
    @if($topPick)
        <div class="collab__header">
            <h2 class="collab__title">Top Picks</h2>
            <div class="collab__view-all-wrap">
                <a href="/shop" class="collab__view-all">View All</a>
                <span class="collab__view-all-arrow">&rarr;</span>
            </div>
        </div>
        <section class="collab-grid" id="top-picks">
            <!-- <section class="clp-drop" style="border-top: 1px solid #1a1a1a;"> -->
            <div class="clp-drop__content new-layout" style="display: grid; grid-template-columns: 20% 43% 37%;">

                {{-- Kiri: Teks Info --}}
                <div class="clp-drop__info-pane"
                    style="background-color: #F8F4ED; border-left: 1px solid #1a1a1a; padding: 30px; display: flex; flex-direction: column; justify-content: flex-end;">
                    <a href="/shop/{{ $topPick->slug }}" style="text-decoration: none; color: #1a1a1a;">
                        <h3
                            style="font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 900; text-transform: uppercase; line-height: 1.5; margin: 0 0 40px 0; color: #1a1a1a;">
                            {{ $topPick->title }}
                        </h3>
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; font-family: 'JetBrains Mono', monospace; text-transform: uppercase;">
                            <span
                                style="font-size: 13px; font-weight: 500;">Rp{{ number_format($topPick->price, 0, ',', '.') }}</span>
                            <span style="font-size: 10px; font-weight: 500; text-decoration: underline;">+ADD</span>
                        </div>
                    </a>
                </div>

                {{-- Tengah: Gambar Utama --}}
                <div class="clp-drop__main-center" style="border-right: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a;">
                    <a href="/shop/{{ $topPick->slug }}" style="display: block; width: 100%; height: 100%;">
                        @if($topPick->images && count($topPick->images) > 0)
                            <img src="{{ asset('storage/' . $topPick->images[0]) }}" alt="{{ $topPick->title }}"
                                style="width: 100%; height: 100%; aspect-ratio: 4/4.8; object-fit: cover; display: block; background: #e8e4dd;">
                        @endif
                    </a>
                </div>

                {{-- Kanan: Gallery 2x2 --}}
                <div class="clp-drop__gallery" style="border-right: 1px solid #1a1a1a;">
                    @if($topPick->images && count($topPick->images) > 1)
                        @foreach(array_slice($topPick->images, 1, 4) as $image)
                            <a href="/shop/{{ $topPick->slug }}" class="clp-drop__gallery-item">
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $topPick->title }}">
                            </a>
                        @endforeach
                    @endif
                </div>

            </div>

            <style>
                @media (max-width: 1024px) {
                    .clp-drop__content.new-layout {
                        grid-template-columns: 1fr 1fr !important;
                    }

                    .clp-drop__info-pane {
                        /* border-right: none !important; */
                        border-bottom: 1px solid #1a1a1a;
                        /* grid-column: 1 / -1; */
                    }
                }

                @media (max-width: 768px) {
                    .clp-drop__content.new-layout {
                        display: flex !important;
                        flex-direction: column;
                        /* border-left: 1px solid #1a1a1a; */
                        /* border-right: 1px solid #1a1a1a; */
                    }

                    .clp-drop__main-center {
                        order: 1;
                        /* border-right: none !important; */
                        /* border-bottom: 1px solid #1a1a1a; */
                        border-right: 1px solid #1a1a1a;
                        border-left: 1px solid #1a1a1a;
                    }

                    .clp-drop__info-pane {
                        order: 2;
                        border-top: 1px solid #1a1a1a;
                        border-right: 1px solid #1a1a1a;
                        border-left: 1px solid #1a1a1a;
                        /* border-right: none !important; */

                        /* border-bottom sudah di set di 1024px */
                    }

                    .clp-drop__gallery {
                        order: 3;
                        border-left: 1px solid #1a1a1a;
                        border-right: 1px solid #1a1a1a;
                    }
                }
            </style>
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

            // Categories Swiper (SYD-style)
            new Swiper('.clp-categories__swiper', {
                slidesPerView: 5,
                spaceBetween: 0,
                loop: false,
                breakpoints: {
                    0: {
                        slidesPerView: 1.2,
                        spaceBetween: 0,
                    },
                    768: {
                        slidesPerView: 3.2,
                        spaceBetween: 0,
                    },
                },
            });

            // Studio Picks Swiper
            new Swiper('.picks-swiper', {
                slidesPerView: 1.2,
                spaceBetween: 0,
                loop: false,
                breakpoints: {
                    640: {
                        slidesPerView: 2.2,
                    },
                    1024: {
                        slidesPerView: 3.2,
                    }
                }
            });

            // Trust Block Swiper
            new Swiper('.clp-trust__swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                // pagination: {
                //     el: '.pdp-trust__pagination',
                //     clickable: true,
                // },
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
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
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