@extends('layouts.app')

@section('title', 'Custom Camp Flag - Kibardjaya')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
<section class="pdp" x-data="campFlagCustomizer()">
    <!-- LEFT: Product Preview -->
    <div class="pdp__gallery cp-gallery">
        <div class="cp-preview" id="camp-flag-preview-container">
            <!-- Capture Area for Canvas API -->
            <div id="capture-area" class="cp-capture cp-capture--camp-flag">

                <img x-show="currentFlagImage" :src="currentFlagImage" class="cp-capture__img" crossorigin="anonymous"
                    loading="eager" />

                <!-- Text Overlay -->
                <div class="cp-capture__text-overlay" x-ref="textContainer">
                    <span x-ref="textElement" x-text="text" :class="'font-' + fontStyle" class="cp-capture__text"
                        :style="`color: ${textColors[textColor] ? textColors[textColor].hex : '#FFFFFF'};`">
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: Configuration Form -->
    <div class="pdp__info">
        <div class="pdp__info-box">
            <div class="pdp__info-inner">
                {{-- Category Tag --}}
                <span class="pdp__category">Custom</span>

                {{-- Title + Price --}}
                <div class="pdp__header">
                    <h1 class="pdp__title">Custom Camp Flag -</h1>
                    <span class="pdp__price">Rp.159.000</span>
                </div>

                {{-- Description --}}
                <p class="pdp__desc">Design your own custom camp flag!</p>
                <p class="pdp__desc">Create a timeless 5-sided camp flag for your favorite beach, mountain, lake, hiking
                    trail,
                    etc.</p>
                <p class="pdp__desc cp-desc--spaced">Choose your flag color, border color, and text... we will build
                    your custom camp flag for you.</p>

                {{-- Details --}}
                <div class="pdp__details">
                    <span class="pdp__details-label">INFO:</span>
                    <ul class="pdp__details-list">
                        <li>Size: 40 cm x 60 cm</li>
                        <li>Material: premium felt fabric</li>
                        <li>Each piece is individually finished in our Yogyakarta studio.</li>
                        <li>Made in 3-5 days</li>
                    </ul>
                </div>

                {{-- Subtitle Banner --}}
                <div class="pdp__subtitle-banner">MAKE YOUR OWN</div>

                {{-- Configuration Form --}}
                <form @submit.prevent="submitToCart">

                    {{-- FLAG COLOR --}}
                    <div class="pdp__colors cp-colors--first">
                        <span class="pdp__colors-label">
                            FLAG COLOR: <span x-text="flagColors[flagColor] ? flagColors[flagColor].name : ''"></span>
                        </span>
                        <div class="pdp__colors-swatches">
                            <template x-for="(color, key) in flagColors" :key="key">
                                <button type="button" @click="flagColor = key"
                                    class="pdp__color-swatch pdp__color-swatch--square"
                                    :class="flagColor === key ? 'pdp__color-swatch--active' : ''"
                                    :style="`background-color: ${color.hex};`" :title="color.name">
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- BORDER COLOR --}}
                    <div class="pdp__colors">
                        <span class="pdp__colors-label">
                            BORDER COLOR: <span
                                x-text="borderColors[borderColor] ? borderColors[borderColor].name : ''"></span>
                        </span>
                        <div class="pdp__colors-swatches">
                            <template x-for="(color, key) in borderColors" :key="key">
                                <button type="button" @click="borderColor = key"
                                    class="pdp__color-swatch pdp__color-swatch--square"
                                    :class="borderColor === key ? 'pdp__color-swatch--active' : ''"
                                    :style="`background-color: ${color.hex};`" :title="color.name">
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- YOUR TEXT --}}
                    <div class="pdp__colors">
                        <div class="cp-text-row">
                            <span class="pdp__colors-label cp-label--flush">YOUR TEXT*</span>
                            <span class="cp-text-counter">10 Characters, 4 lines max</span>
                        </div>
                        <textarea x-model="text" @input="limitText" class="cp-input" rows="4"
                            placeholder="your&#10;magic&#10;words&#10;here"
                            style="resize: none; padding-top: 12px; padding-bottom: 12px; line-height: 1.5;"></textarea>
                    </div>

                    {{-- CHOOSE STYLE --}}
                    <div class="pdp__colors">
                        <span class="pdp__colors-label">CHOOSE STYLE</span>
                        <select x-model="fontStyle" class="cp-select">
                            <template x-for="(name, key) in fonts" :key="key">
                                <option :value="key" x-text="name"></option>
                            </template>
                        </select>
                    </div>

                    {{-- TEXT COLOR --}}
                    <div class="pdp__colors">
                        <span class="pdp__colors-label">
                            TEXT COLOR: <span x-text="textColors[textColor] ? textColors[textColor].name : ''"></span>
                        </span>
                        <div class="pdp__colors-swatches">
                            <template x-for="(color, key) in textColors" :key="key">
                                <button type="button" @click="textColor = key"
                                    class="pdp__color-swatch pdp__color-swatch--square"
                                    :class="textColor === key ? 'pdp__color-swatch--active' : ''"
                                    :style="`background-color: ${color.hex};`" :title="color.name">
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- Confirmation Checkbox --}}
                    <div class="cp-confirm">
                        <label class="cp-confirm__label">
                            <div class="cp-confirm__checkbox-wrap">
                                <input type="checkbox" x-model="confirmed" class="cp-confirm__checkbox" />
                                <svg class="cp-confirm__check-icon" :class="confirmed ? 'opacity-100' : ''" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="cp-confirm__text">
                                CLICK HERE TO CONFIRM THAT THERE ARE NO TYPOS IN YOUR LAYOUT.
                            </span>
                        </label>
                    </div>

                    <input type="hidden" name="id" value="custom-camp-flag-001">
                </form>
            </div>

            {{-- Bottom Actions: Qty + Cart Button --}}
            <div class="pdp__actions">
                <div class="pdp__actions-inner">
                    <div class="pdp__qty">
                        <button type="button" class="pdp__qty-btn" @click="qty = Math.max(1, qty - 1)">−</button>
                        <input type="number" name="quantity" x-model="qty" min="1" class="pdp__qty-input" readonly>
                        <button type="button" class="pdp__qty-btn" @click="qty++">+</button>
                    </div>
                    <button type="button" class="pdp__btn" @click="submitToCart()"
                        :disabled="!confirmed || isSubmitting">
                        <span x-show="!isSubmitting">BRING THIS HOME</span>
                        <span x-show="isSubmitting">GENERATING...</span>
                    </button>
                </div>
            </div>
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

{{-- Custom Ideas Section --}}
<section class="custom-ideas">
    <div class="custom-ideas__header">
        <h2 class="custom-ideas__title">CUSTOM IDEAS</h2>
    </div>

    @if(isset($latestCampFlags) && count($latestCampFlags) > 0)
    <div class="swiper custom-ideas-swiper-top custom-ideas__swiper">
        <div class="swiper-wrapper" style="transition-timing-function: linear;">
            @foreach($latestCampFlags as $img)
            <div class="swiper-slide custom-ideas__slide">
                <img src="{{ asset($img) }}" alt="Custom Camp Flag Idea" loading="lazy">
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.custom-ideas-swiper-top')) {
            new Swiper('.custom-ideas-swiper-top', {
                slidesPerView: 'auto',
                spaceBetween: 20,
                loop: true,
                allowTouchMove: false,
                speed: 5000,
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                    reverseDirection: true,
                },
                breakpoints: {
                    768: {
                        spaceBetween: 40,
                    }
                }
            });
        }
    });

    document.addEventListener('alpine:init', () => {
        Alpine.data('campFlagCustomizer', () => ({
            flagColors: @json($flagColors),
            borderColors: @json($borderColors),
            textColors: @json($textColors),
            fonts: @json($fonts),

            flagColor: 'navy',
            borderColor: 'black',
            textColor: 'mustard',
            text: 'your\nmagic\nwords\nhere',
            qty: 1,
            fontStyle: 'ombudsman-stencil',
            confirmed: false,
            isSubmitting: false,

            containerWidth: 500,
            resizeObserver: null,

            limitText() {
                let lines = this.text.split('\n');
                if (lines.length > 4) {
                    lines = lines.slice(0, 4);
                }
                lines = lines.map(line => line.substring(0, 10));
                let newText = lines.join('\n');
                if (this.text !== newText) {
                    this.text = newText;
                }
                this.resizeText();
            },

            resizeText() {
                this.$nextTick(() => {
                    const container = this.$refs.textContainer;
                    const text = this.$refs.textElement;

                    if (!container || !text) return;

                    let fontSize = parseInt(window.getComputedStyle(container).height) * 0.8;
                    if (isNaN(fontSize) || fontSize < 10) fontSize = 150;

                    text.style.fontSize = fontSize + 'px';

                    while ((text.scrollWidth > container.clientWidth || text.scrollHeight > container.clientHeight) && fontSize > 10) {
                        fontSize--;
                        text.style.fontSize = fontSize + 'px';
                    }
                });
            },

            init() {
                this.$nextTick(() => {
                    const captureArea = document.getElementById('capture-area');
                    if (captureArea) {
                        this.containerWidth = captureArea.clientWidth;

                        this.resizeObserver = new ResizeObserver(entries => {
                            for (let entry of entries) {
                                this.containerWidth = entry.contentRect.width;
                            }
                            this.resizeText();
                        });
                        this.resizeObserver.observe(captureArea);
                    }

                    this.resizeText();
                });

                this.$watch('text', () => this.resizeText());
                this.$watch('fontStyle', () => {
                    setTimeout(() => this.resizeText(), 50);
                });
            },

            get currentFlagImage() {
                if (this.flagColor && this.borderColor) {
                    return `/images/pennant_parts/5sided/5sided-${this.flagColor}-${this.borderColor}.png`;
                }
                return '';
            },

            async submitToCart() {
                if (!this.confirmed || this.isSubmitting) return;

                this.isSubmitting = true;

                try {
                    await document.fonts.ready;
                    await new Promise(resolve => setTimeout(resolve, 50));

                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    const img = new Image();
                    img.crossOrigin = 'anonymous';
                    img.src = this.currentFlagImage;

                    await new Promise((resolve, reject) => {
                        img.onload = resolve;
                        img.onerror = reject;
                    });

                    canvas.width = img.naturalWidth;
                    canvas.height = img.naturalHeight;

                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                    const textStr = this.text;
                    if (textStr.trim().length > 0) {
                        const captureArea = document.getElementById('capture-area');
                        const textElement = this.$refs.textElement;

                        const captureRect = captureArea.getBoundingClientRect();
                        const scaleFactor = canvas.width / captureRect.width;

                        const computedStyle = window.getComputedStyle(textElement);
                        const domFontSize = parseFloat(computedStyle.fontSize);
                        const canvasFontSize = domFontSize * scaleFactor;

                        const textRect = textElement.getBoundingClientRect();
                        const centerXDom = (textRect.left - captureRect.left) + (textRect.width / 2);
                        let centerYDom = (textRect.top - captureRect.top) + (textRect.height / 2);

                        const canvasX = centerXDom * scaleFactor;
                        const canvasY = centerYDom * scaleFactor;

                        ctx.fillStyle = computedStyle.color || '#FFFFFF';

                        const fontFamily = computedStyle.fontFamily;
                        const fontWeight = computedStyle.fontWeight || 'normal';
                        const fontStyle = computedStyle.fontStyle || 'normal';

                        ctx.font = `${fontStyle} ${fontWeight} ${canvasFontSize}px ${fontFamily}`;
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        const lines = textStr.split('\n');
                        const computedLineHeight = computedStyle.lineHeight;
                        const domLineHeight = computedLineHeight === 'normal' ? domFontSize * 1.2 : parseFloat(computedLineHeight);
                        const canvasLineHeight = domLineHeight * scaleFactor;

                        const totalHeight = (lines.length - 1) * canvasLineHeight;
                        let startY = canvasY - (totalHeight / 2);

                        lines.forEach(line => {
                            ctx.fillText(line, canvasX, startY);
                            startY += canvasLineHeight;
                        });
                    }

                    const base64Image = canvas.toDataURL('image/webp', 0.8);

                    const payload = {
                        flag_color: this.flagColors[this.flagColor].name,
                        border_color: this.borderColors[this.borderColor].name,
                        text_color: this.textColors[this.textColor].name,
                        text: this.text,
                        font: this.fonts[this.fontStyle],
                        qty: this.qty,
                        custom_image: base64Image
                    };

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
                        || '{{ csrf_token() }}';

                    const response = await fetch('/cart/add-custom-camp-flag', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    if (data.success) {
                        window.location.href = window.location.pathname + '?cart_added=1';
                    } else {
                        alert(data.message || 'Failed to add to cart.');
                        this.isSubmitting = false;
                    }

                } catch (error) {
                    console.error("Error generating image", error);
                    alert("There was an error generating your custom design image.");
                    this.isSubmitting = false;
                }
            }
        }))
    })

</script>
@endpush
@endsection