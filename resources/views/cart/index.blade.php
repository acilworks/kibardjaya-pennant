@extends('layouts.app')

@section('title', 'Your Cart - Kibardjaya Pennant')

@push('styles')
    <style>
        /* Styling for the cart layout to match Figma */
        .cart-container {
            width: 100%;
            border-top: 1px solid #d5d5d5;
        }

        .cart-grid {
            display: flex;
            flex-direction: column;
        }

        .cart-left,
        .cart-right {
            padding: 40px 20px;
            border-bottom: 1px solid #d5d5d5;
        }

        .cart-left {
            background-color: #FAFAFA;
        }

        .cart-left-inner {
            /* background-color: #FAFAFA; */
        }

        .cart-left-inner,
        .cart-right-inner {
            max-width: 520px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        @media(min-width: 1024px) {
            .cart-grid {
                flex-direction: row;
            }

            .cart-left {
                flex: 1;
                border-right: 1px solid #d5d5d5;
                padding: 60px 40px;
            }

            .cart-right {
                flex: 1;
                padding: 60px 40px;
            }
        }

        /* Form Styles */
        .cart-box {
            border: 1px solid #d5d5d5;
            /* border: 1px solid #1c1c1c; */
            padding: 32px;
        }

        .cart-box-title {
            font-family: 'JetBrains Mono', monospace;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .cart-input {
            width: 100%;
            border: 1px solid #d5d5d5;
            /* border: 1px solid #1c1c1c; */
            padding: 14px 16px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            letter-spacing: 0.1em;
            /* text-transform: uppercase; */
            background: transparent;
            outline: none;
            margin-bottom: 16px;
        }

        .cart-input::placeholder {
            color: #757575;
        }

        .cart-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .cart-select-wrapper {
            position: relative;
            margin-bottom: 16px;
        }

        .cart-select-wrapper .cart-input {
            margin-bottom: 0;
            appearance: none;
            cursor: pointer;
        }

        .cart-select-icon {
            position: absolute;
            top: 50%;
            right: 16px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .cart-checkbox-wrapper {
            display: flex;
            align-items: center;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 700;
            cursor: pointer;
            margin-bottom: 40px;
            color: #757575;
        }

        .cart-checkbox {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .cart-checkmark-box {
            width: 18px;
            height: 18px;
            border: 1px solid #d5d5d5;
            /* border: 1px solid #1c1c1c; */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 12px;
        }

        .cart-checkbox:checked~.cart-checkmark-box .cart-checkmark {
            display: block;
        }

        .cart-checkbox:not(:checked)~.cart-checkmark-box .cart-checkmark {
            display: none;
        }

        /* Right Side Styles */
        .cart-collection-list {
            border: 1px solid #d5d5d5;
            /* border: 1px solid #1c1c1c; */
            display: flex;
            flex-direction: column;
        }

        .cart-collection-header {
            background-color: #e0e0e0;
            border-bottom: 1px solid #d5d5d5;
            /* border-bottom: 1px solid #1c1c1c; */
            text-align: center;
            padding: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .cart-item {
            display: flex;
            padding: 24px;
            border-bottom: 1px solid #d5d5d5;
            /* border-bottom: 1px solid #1c1c1c; */
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-img {
            width: 80px;
            height: auto;
            object-fit: cover;
            margin-right: 20px;
        }

        .cart-item-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-item-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-family: 'JetBrains Mono', monospace;
        }

        .cart-item-title {
            font-size: 14px;
            font-weight: 700;
            padding-right: 16px;
        }

        .cart-item-price {
            font-size: 14px;
            font-weight: 700;
            white-space: nowrap;
        }

        .cart-item-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .cart-qty-ctrl {
            display: flex;
            align-items: center;
            gap: 16px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 16px;
            font-weight: 700;
        }

        .cart-qty-btn {
            cursor: pointer;
            color: #1c1c1c;
        }

        .cart-qty-btn:hover {
            color: #757575;
        }

        .cart-remove-btn {
            color: #1c1c1c;
            cursor: pointer;
        }

        .cart-summary {
            border: 1px solid #d5d5d5;
            /* border: 1px solid #1c1c1c; */
            font-family: 'JetBrains Mono', monospace;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .cart-summary-content {
            padding: 32px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .cart-summary-footer {
            border-top: 1px solid #d5d5d5;
            padding: 24px;
        }

        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 300;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .cart-summary-total {
            margin-bottom: 0px;
            margin-top: 40px;
            font-size: 14px;
            font-weight: 700;
        }

        .cart-pay-btn {
            width: 100%;
            background-color: #1c1c1c;
            color: #ffffff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .cart-pay-btn:hover {
            background-color: #000000;
        }
    </style>
@endpush

@section('content')
    <div class="cart-container" x-data="cartPage()">
        @if(empty($cart))
            <h1 class="text-3xl font-bold mb-8 text-center uppercase tracking-widest font-mono">Your Cart is Empty</h1>
            <div class="text-center">
                <a href="/shop"
                    class="inline-block px-8 py-3 bg-[#1c1c1c] text-white hover:bg-black transition uppercase tracking-widest font-bold text-sm font-mono">Return
                    to Shop</a>
            </div>
        @else
            <div class="cart-grid">
                {{-- Left Column: Forms --}}
                <div class="cart-left">
                    <div class="cart-left-inner">
                        <form action="/checkout" method="POST" id="checkout-form">
                            @csrf
                            <div class="cart-box">
                                <h2 class="cart-box-title">Contact</h2>

                                <input type="email" name="email" placeholder="EMAIL" required class="cart-input">

                                <label class="cart-checkbox-wrapper group">
                                    <input type="checkbox" name="news_offers" class="cart-checkbox">
                                    <div class="cart-checkmark-box">
                                        <span class="cart-checkmark">X</span>
                                    </div>
                                    Email me with news & offers
                                </label>

                                <h2 class="cart-box-title">Delivery</h2>

                                <div class="cart-select-wrapper">
                                    <select name="country" class="cart-input" style="color:#757575; cursor:not-allowed;">
                                        <option value="Indonesia" selected>INDONESIA</option>
                                    </select>
                                    <svg class="cart-select-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7">
                                        </path>
                                    </svg>
                                </div>

                                <div class="cart-row">
                                    <input type="text" name="first_name" placeholder="FIRST NAME" required class="cart-input">
                                    <input type="text" name="last_name" placeholder="LAST NAME" required class="cart-input">
                                </div>

                                <textarea name="address" placeholder="ADDRESS" rows="4" required class="cart-input"
                                    style="resize: none;"></textarea>

                                <div class="cart-row" style="margin-bottom:0;">
                                    <div class="cart-select-wrapper" style="margin-bottom:16px;">
                                        <select name="province_id" required x-model="selectedProvinceId"
                                            @change="updateShipping" class="cart-input"
                                            :style="selectedProvinceId === '' ? 'color:#757575;' : 'color:#1c1c1c;'">
                                            <option value="" disabled selected>PROVINCE</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->id }}" data-cost="{{ $province->cost }}">
                                                    {{ strtoupper($province->province) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <svg class="cart-select-icon w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>

                                    <input type="text" name="postal_code" placeholder="POSTAL CODE" required class="cart-input">
                                </div>

                                <input type="tel" name="phone" placeholder="PHONE" required class="cart-input">

                                <textarea name="note" placeholder="NOTE" rows="3" class="cart-input"
                                    style="resize: none; margin-bottom: 0;"></textarea>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Right Column: Cart items & Summary --}}
                <div class="cart-right">
                    <div class="cart-right-inner">
                        {{-- Collection List --}}
                        <div class="cart-collection-list">
                            <div class="cart-collection-header">
                                Collection List
                            </div>

                            @php $orderValue = 0; @endphp
                            @foreach($cart as $item)
                                @php $orderValue += $item['price'] * $item['qty']; @endphp
                                <div class="cart-item">
                                    @if(isset($item['image']) && $item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}"
                                            class="cart-item-img">
                                    @else
                                        <div class="cart-item-img" style="background-color: #f5f5f5;"></div>
                                    @endif

                                    <div class="cart-item-info">
                                        <div class="cart-item-top">
                                            <h3 class="cart-item-title">{{ $item['title'] }}</h3>
                                            <span class="cart-item-price">Rp.
                                                {{ number_format($item['price'], 0, ',', '.') }}</span>
                                        </div>
                                        <div class="cart-item-bottom">
                                            <div class="cart-qty-ctrl">
                                                <form action="/cart/update/{{ $item['id'] }}" method="POST"
                                                    class="inline m-0 p-0 line-height-1" style="line-height:1;">
                                                    @csrf
                                                    <input type="hidden" name="qty" value="{{ max(1, $item['qty'] - 1) }}">
                                                    <button type="submit"
                                                        class="cart-qty-btn bg-transparent border-0 p-0">-</button>
                                                </form>

                                                <span>{{ $item['qty'] }}</span>

                                                <form action="/cart/update/{{ $item['id'] }}" method="POST"
                                                    class="inline m-0 p-0 line-height-1" style="line-height:1;">
                                                    @csrf
                                                    <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">
                                                    <button type="submit"
                                                        class="cart-qty-btn bg-transparent border-0 p-0">+</button>
                                                </form>
                                            </div>
                                            <form action="/cart/remove/{{ $item['id'] }}" method="POST" style="line-height:1;">
                                                @csrf
                                                <button type="submit" class="cart-remove-btn bg-transparent border-0 p-0">
                                                    <svg width="18" height="20" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Summary Block --}}
                        <div class="cart-summary">
                            <div class="cart-summary-content">
                                <div class="cart-summary-row">
                                    <span>Order Value</span>
                                    <span>Rp. {{ number_format($orderValue, 0, ',', '.') }}</span>
                                </div>
                                <div class="cart-summary-row">
                                    <span>Shipping</span>
                                    <span x-text="shippingFormatted">Enter province first</span>
                                </div>

                                <div class="cart-summary-row cart-summary-total">
                                    <span>Total</span>
                                    <span x-text="totalFormatted">Rp. {{ number_format($orderValue, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="cart-summary-footer">
                                <button type="submit" form="checkout-form" class="cart-pay-btn">
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
        </div>

        {{-- Running Text Marquee --}}
        <div class="marquee">
            <!-- <div class="marquee" style="margin-top: 40px;"> -->
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

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('cartPage', () => ({
                    orderValue: {{ $orderValue ?? 0 }},
                    shippingCost: 0,
                    selectedProvinceId: '',

                    get shippingFormatted() {
                        if (!this.selectedProvinceId) return 'Enter province first';
                        return 'Rp. ' + new Intl.NumberFormat('id-ID').format(this.shippingCost);
                    },

                    get totalFormatted() {
                        const total = this.orderValue + this.shippingCost;
                        return 'Rp. ' + new Intl.NumberFormat('id-ID').format(total);
                    },

                    updateShipping(e) {
                        const selectedOption = e.target.options[e.target.selectedIndex];
                        const cost = parseInt(selectedOption.getAttribute('data-cost')) || 0;
                        this.shippingCost = cost;
                    }
                }))
            });
        </script>
    @endpush