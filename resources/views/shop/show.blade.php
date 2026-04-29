@extends('layouts.app')

@section('title', $product->title . ' — Kibardjaya Pennant')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    {{-- ============================================
    SECTION 1: PRODUCT HERO
    ============================================ --}}
    <section class="pdp" x-data="{
                    qty: 1,
                    selectedColorIndex: null,
                    selectedColorName: '',
                    colorVariants: {{ Js::from($product->colorVariants->map(fn($v) => ['id' => $v->id, 'name' => $v->color_name, 'code' => $v->color_code, 'image' => $v->image ? asset('storage/' . $v->image) : null])) }},
                    swiperInstance: null,
                    variantSlideMap: {},
                        selectColor(index) {
                            this.selectedColorIndex = index;
                            this.selectedColorName = this.colorVariants[index].name;
                            if (this.swiperInstance && this.variantSlideMap[index] !== undefined) {
                                this.swiperInstance.slideTo(this.variantSlideMap[index]);
                            }
                        }
        }">
        {{-- Left: Product Photos Swiper --}}
        <div class="pdp__gallery">
            <div class="swiper pdp__swiper">
                <div class="swiper-wrapper">
                    @if($product->images)
                        @foreach($product->images as $image)
                            <div class="swiper-slide">
                                <div class="pdp__gallery-item">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->title }}"
                                        class="pdp__gallery-img {{ $product->is_sold_out ? 'pdp__gallery-img--soldout' : '' }}">
                                    @if($product->is_sold_out && $loop->first)
                                        <div class="pdp__sold-overlay">
                                            <span>Sold Out</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{-- Variant image slides --}}
                    @foreach($product->colorVariants as $variant)
                        @if($variant->image)
                            <div class="swiper-slide" data-variant-index="{{ $loop->index }}">
                                <div class="pdp__gallery-item">
                                    <img src="{{ asset('storage/' . $variant->image) }}"
                                        alt="{{ $product->title }} - {{ $variant->color_name }}"
                                        class="pdp__gallery-img {{ $product->is_sold_out ? 'pdp__gallery-img--soldout' : '' }}">
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-pagination pdp__pagination"></div>
            </div>
        </div>

        {{-- Right: Purchase Info (bordered box) --}}
        <div class="pdp__info">
            <div class="pdp__info-box">
                <div class="pdp__info-inner">
                    {{-- Category Tag --}}
                    @if($product->subCategory)
                        <span class="pdp__category">{{ $product->subCategory->name }}</span>
                    @endif

                    {{-- Title + Price --}}
                    <div class="pdp__header">
                        <h1 class="pdp__title">{{ $product->title }}</h1>
                        <span class="pdp__price">Rp.{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    {{-- Description --}}
                    @if($product->description)
                        <p class="pdp__desc">{!! nl2br(e($product->description)) !!}</p>
                    @endif

                    {{-- Subtitle Banner --}}
                    @if($product->subtitle)
                        <div class="pdp__subtitle-banner">
                            {{ $product->subtitle }}
                        </div>
                    @endif

                    {{-- Details --}}
                    @if($product->details)
                        <div class="pdp__details">
                            <span class="pdp__details-label">Details</span>
                            <ul class="pdp__details-list">
                                @foreach(explode("\n", $product->details) as $detail)
                                    @if(trim($detail))
                                        <li>{{ trim($detail) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Color Variants --}}
                    @if($product->colorVariants->count() > 0)
                        <div class="pdp__colors">
                            <span class="pdp__colors-label">
                                VARIANT: <span
                                    x-text="selectedColorName || '{{ $product->colorVariants->first()->color_name }}'"></span>
                            </span>
                            <div class="pdp__colors-swatches">
                                <template x-for="(variant, index) in colorVariants" :key="index">
                                    <button class="pdp__color-swatch"
                                        :class="{ 'pdp__color-swatch--active': selectedColorIndex === index }"
                                        :style="'background-color: ' + variant.code" @click="selectColor(index)"
                                        :title="variant.name"></button>
                                </template>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Bottom Actions: Qty Selector + Add to Cart --}}
                <div class="pdp__actions">
                    @if($product->is_sold_out)
                        <div class="pdp__actions-inner">
                            <button disabled class="pdp__btn pdp__btn--soldout">
                                Sold Out
                            </button>
                        </div>
                    @else
                        <form action="/cart/add/{{ $product->id }}" method="POST" class="pdp__actions-inner">
                            @csrf
                            <input type="hidden" name="color_variant_id"
                                :value="colorVariants[selectedColorIndex] ? colorVariants[selectedColorIndex].id : ''">
                            <div class="pdp__qty">
                                <button type="button" class="pdp__qty-btn" @click="qty = Math.max(1, qty - 1)">−</button>
                                <input type="number" name="quantity" x-model="qty" min="1" class="pdp__qty-input" readonly>
                                <button type="button" class="pdp__qty-btn" @click="qty++">+</button>
                            </div>
                            <button type="submit" class="pdp__btn">
                                Bring This Home
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    SECTION 2: MADE FOR WALLS WITH STORIES
    ============================================ --}}
    <section class="pdp-lifestyle">
        <div class="pdp-lifestyle__header">
            <h2 class="pdp-lifestyle__title">Made for Walls with Stories</h2>
        </div>
        <div class="swiper pdp-lifestyle__swiper">
            <div class="swiper-wrapper">
                @if($product->lifestyle_images && count($product->lifestyle_images) > 0)
                    @foreach($product->lifestyle_images as $lifestyleImage)
                        <div class="swiper-slide">
                            <picture>
                                <source srcset="{{ asset('storage/' . $lifestyleImage) }}" type="image/webp">
                                <img src="{{ asset('storage/' . $lifestyleImage) }}" alt="Lifestyle for {{ $product->title }}"
                                    class="pdp-lifestyle__img" loading="lazy">
                            </picture>
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{ asset('image/balibarong4.webp') }}" type="image/webp">
                            <img src="{{ asset('image/balibarong4.webp') }}" alt="Lifestyle" class="pdp-lifestyle__img"
                                loading="lazy">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{ asset('image/enjoy.webp') }}" type="image/webp">
                            <img src="{{ asset('image/enjoy.webp') }}" alt="Lifestyle" class="pdp-lifestyle__img"
                                loading="lazy">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{ asset('image/brooks.webp') }}" type="image/webp">
                            <img src="{{ asset('image/brooks.webp') }}" alt="Lifestyle" class="pdp-lifestyle__img"
                                loading="lazy">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{ asset('image/yes-chef.webp') }}" type="image/webp">
                            <img src="{{ asset('image/yes-chef.webp') }}" alt="Lifestyle" class="pdp-lifestyle__img"
                                loading="lazy">
                        </picture>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ============================================
    SECTION 4: RUNNING TEXT
    ============================================ --}}
    <div class="marquee">
        <div class="marquee__track">
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
            <span class="marquee__content">&bull;&nbsp; Handmade in Indonesia &nbsp;&bull;&nbsp; Limited Small Batches
                &bull;&nbsp; Built for Collectors &nbsp;&bull;&nbsp; Crafted Memories &nbsp;</span>
        </div>
    </div>

    {{-- ============================================
    SECTION 3: TRUST BLOCK
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
    SECTION 5: CONTINUE YOUR COLLECTION
    ============================================ --}}
    @if($relatedProducts->count() > 0)
        <section class="pdp-related">
            <!-- <div class="pdp-related__header">
                                                                        <h2 class="pdp-related__title">Continue Your Collection</h2>
                                                                        <a href="/shop" class="pdp-related__view-all">View All &rarr;</a>
                                                                    </div> -->
            <div class="collections__header" style="border-bottom: 1px solid #1a1a1a;">
                <h2 class="collections__title">Continue Your Collection</h2>
                <div class="collections__view-all-wrap">
                    <a href="/shop" class="collections__view-all">View All</a>
                    <span class="collections__view-all-arrow">&rarr;</span>
                </div>
            </div>
            <div class="pdp-related__grid">
                @foreach($relatedProducts as $related)
                    @include('components._product-card', ['product' => $related])
                @endforeach
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Product Card Swipers (related products)
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

            // Product Photos Swiper — store instance in Alpine for color variant swap
            const pdpSwiper = new Swiper('.pdp__swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                pagination: {
                    el: '.pdp__pagination',
                    clickable: true,
                },
                loop: false,
            });

            // Pass swiper instance to Alpine.js component & build variant slide map
            const pdpSection = document.querySelector('.pdp');
            const alpineData = pdpSection?._x_dataStack?.[0];
            if (alpineData) {
                alpineData.swiperInstance = pdpSwiper;
                // Build variantSlideMap: { variantIndex: slideIndex }
                pdpSwiper.slides.forEach((slide, slideIdx) => {
                    const vi = slide.dataset.variantIndex;
                    if (vi !== undefined) {
                        alpineData.variantSlideMap[parseInt(vi)] = slideIdx;
                    }
                });
            }

            // Lifestyle Gallery Swiper
            new Swiper('.pdp-lifestyle__swiper', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                loop: true,
            });

            // Trust Block Swiper
            new Swiper('.pdp-trust__swiper', {
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