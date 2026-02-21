@extends('layouts.app')

@section('content')
    <div class="paypage-full">
        <div class="pay-page">
            {{-- Order Summary Section --}}
            <div class="pay-receipt pay-receipt--success">
                <div class="pay-receipt__header">
                    <div class="pay-receipt__order-number">
                        <span class="pay-receipt__label-bold">ORDER NUMBER:</span>
                        <span class="pay-receipt__value-bold">{{ $order->order_number }}</span>
                    </div>
                    <img src="{{ asset('image/logo-kibar.png') }}" alt="Kibardjaya" class="pay-receipt__logo">
                </div>

                <div class="pay-receipt__divider-dashed"></div>

                <h3 class="pay-receipt__section-title">Delivery Information</h3>

                <div class="pay-receipt__info-table">
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">EMAIL</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span class="pay-receipt__info-value">{{ $order->customer_email }}</span>
                    </div>
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">COUNTRY / REGION</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span class="pay-receipt__info-value">INDONESIA</span>
                    </div>
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">FIRST NAME</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span class="pay-receipt__info-value">{{ explode(' ', $order->customer_name)[0] ?? '-' }}</span>
                    </div>
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">LAST NAME</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span
                            class="pay-receipt__info-value">{{ count(explode(' ', $order->customer_name)) > 1 ? implode(' ', array_slice(explode(' ', $order->customer_name), 1)) : '-' }}</span>
                    </div>
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">PROVINCE</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span class="pay-receipt__info-value">{{ strtoupper($order->city ?? '-') }}</span>
                    </div>
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">ADDRESS</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span class="pay-receipt__info-value">{{ strtoupper($order->address ?? '-') }}</span>
                    </div>
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">POSTAL CODE</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span class="pay-receipt__info-value">{{ $order->postal_code ?? '-' }}</span>
                    </div>
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">PHONE</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span class="pay-receipt__info-value">{{ $order->phone ?? '-' }}</span>
                    </div>
                    <div class="pay-receipt__info-row">
                        <span class="pay-receipt__info-label">NOTE</span>
                        <span class="pay-receipt__info-sep">:</span>
                        <span class="pay-receipt__info-value">{{ $order->note ?? '-' }}</span>
                    </div>
                </div>

                <div class="pay-receipt__divider-dashed"></div>

                <h3 class="pay-receipt__section-title">Collection List</h3>

                {{-- Items Table Header --}}
                <div class="pay-receipt__items-header">
                    <span class="pay-receipt__col-item">ITEM</span>
                    <span class="pay-receipt__col-qty">QTY</span>
                    <span class="pay-receipt__col-price">PRICE</span>
                    <span class="pay-receipt__col-subtotal">SUBTOTAL</span>
                </div>

                <div class="pay-receipt__items-divider"></div>

                {{-- Items --}}
                @foreach($order->items as $item)
                    <div class="pay-receipt__items-row">
                        <span class="pay-receipt__col-item">{{ $item->product->title ?? 'Product' }}</span>
                        <span class="pay-receipt__col-qty">{{ $item->quantity }}</span>
                        <span class="pay-receipt__col-price">Rp.{{ number_format($item->price, 0, ',', '.') }}</span>
                        <span
                            class="pay-receipt__col-subtotal">Rp.{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <div class="pay-receipt__divider-dashed"></div>

                {{-- Totals with Stamp --}}
                <div class="pay-receipt__totals-wrap">
                    <div class="pay-receipt__totals">
                        <div class="pay-receipt__totals-row">
                            <span>Sub Total</span>
                            <span>Rp.{{ number_format($order->total_amount - $order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="pay-receipt__totals-row">
                            <span>Shipping</span>
                            <span>Rp.{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="pay-receipt__totals-row pay-receipt__totals-row--grand">
                            <span>TOTAL</span>
                            <span>Rp.{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="pay-receipt__paid-label">
                            (PAID)
                        </div>
                    </div>
                    <div class="pay-receipt__stamp">
                        <img src="{{ asset('image/kibar-stamp.png') }}" alt="KibarDjaya Stamp">
                    </div>
                </div>

                <div class="pay-receipt__note">
                    Thank you for your order.
                </div>
            </div>
        </div>
    </div>

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