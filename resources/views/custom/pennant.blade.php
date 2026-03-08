@extends('layouts.app')

@section('title', 'Custom Pennant - Kibardjaya')

@section('content')
    <section class="pdp" x-data="pennantCustomizer()">
        <!-- LEFT: Product Preview -->
        <div class="pdp__gallery cp-gallery">
            <div class="cp-preview" id="pennant-preview-container">
                <!-- Capture Area for html2canvas -->
                <div id="capture-area" class="cp-capture">

                    <img x-show="currentFlagImage" :src="currentFlagImage" class="cp-capture__img" crossorigin="anonymous"
                        loading="eager" />

                    <!-- Text Overlay -->
                    <div class="cp-capture__text-overlay">
                        <span x-text="text" :class="'font-' + fontStyle" class="cp-capture__text"
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
                        <h1 class="pdp__title">Custom Pennant -</h1>
                        <span class="pdp__price">Rp.99.000</span>
                    </div>

                    {{-- Description --}}
                    <p class="pdp__desc">Design your own custom flag!</p>
                    <p class="pdp__desc">Create a timeless artifact for your favorite beach, mountain, lake, hiking trail,
                        etc.</p>
                    <p class="pdp__desc cp-desc--spaced">Choose your flag color, border color, and text... we will build
                        your custom flag for you.</p>

                    {{-- Details --}}
                    <div class="pdp__details">
                        <span class="pdp__details-label">INFO:</span>
                        <ul class="pdp__details-list">
                            <li>Size: 68 cm x 23 cm</li>
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
                                <span class="cp-text-counter" x-text="(15 - text.length) + ' Characters left.'"></span>
                            </div>
                            <input type="text" x-model="text" maxlength="15" class="cp-input" placeholder="EXAMPLE">
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

                        <input type="hidden" name="id" value="custom-pennant-001">
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

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('pennantCustomizer', () => ({
                    flagColors: @json($flagColors),
                    borderColors: @json($borderColors),
                    textColors: @json($textColors),
                    fonts: @json($fonts),

                    flagColor: 'mustard',
                    borderColor: 'black',
                    textColor: 'cream',
                    text: 'Kibardjaya',
                    qty: 1,
                    fontStyle: 'stardos-stencil',
                    confirmed: false,
                    isSubmitting: false,

                    supportsWebp: false,

                    init() {
                        // Detect WebP support via canvas
                        const canvas = document.createElement('canvas');
                        canvas.width = 1;
                        canvas.height = 1;
                        this.supportsWebp = canvas.toDataURL('image/webp').indexOf('data:image/webp') === 0;
                    },

                    get currentFlagImage() {
                        if (this.flagColor && this.borderColor) {
                            const base = `/images/pennant_parts/flag-${this.flagColor}-border-${this.borderColor}`;
                            return this.supportsWebp ? `${base}.webp` : `${base}.png`;
                        }
                        return '';
                    },

                    async submitToCart() {
                        if (!this.confirmed || this.isSubmitting) return;

                        this.isSubmitting = true;

                        try {
                            const captureArea = document.getElementById('capture-area');

                            // html2canvas to save image
                            const canvas = await html2canvas(captureArea, {
                                backgroundColor: '#ffffff', // Ensures white background for cart thumbnail
                                scale: 2,
                                useCORS: true,
                                logging: false
                            });

                            const base64Image = canvas.toDataURL('image/webp', 0.8);

                            const payload = {
                                id: 'custom-pennant',
                                name: 'Custom Pennant',
                                price: 99000,
                                qty: this.qty,
                                options: {
                                    flag_color: this.flagColors[this.flagColor].name,
                                    border_color: this.borderColors[this.borderColor].name,
                                    text_color: this.textColors[this.textColor].name,
                                    text: this.text,
                                    font: this.fonts[this.fontStyle],
                                    custom_image: base64Image
                                }
                            };

                            // Since the CartController implementation isn't fully detailed in the prompt,
                            // we'll simulate the axios call to add to cart.
                            // If Kibardjaya uses standard form submission, we might need to populate hidden fields
                            // But typically custom attributes via base64 are better sent via AJAX.

                            console.log('Final Payload ready for Cart:', payload);

                            // Simulate Cart API Call 
                            // await axios.post('/cart/add/custom-pennant', payload);

                            // Simulating success
                            setTimeout(() => {
                                this.isSubmitting = false;
                                alert('Your custom pennant has been generated. Check console for payload.\nReady to be integrated with actual Cart Add Logic.');
                            }, 1000);

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