<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->order_number }} — Kibardjaya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #fafafa;
            font-family: 'JetBrains Mono', 'Courier New', Courier, monospace;
            color: #1a1a1a;
            padding: 40px 20px;
        }

        .invoice-wrapper {
            max-width: 620px;
            margin: 0 auto;
        }

        /* Print Button */
        .invoice-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }

        .invoice-actions__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background-color: #1a1a1a;
            color: #ffffff;
            font-family: 'JetBrains Mono', 'Courier New', Courier, monospace;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid #1a1a1a;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .invoice-actions__btn:hover {
            background-color: #ffffff;
            color: #1a1a1a;
        }

        .invoice-actions__btn--back {
            background-color: #ffffff;
            color: #1a1a1a;
        }

        .invoice-actions__btn--back:hover {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        /* Receipt */
        .pay-receipt {
            border: 1px solid #1a1a1a;
            padding: 32px 28px;
            background-color: #ffffff;
        }

        .pay-receipt__header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .pay-receipt__order-number {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .pay-receipt__label-bold {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #1a1a1a;
        }

        .pay-receipt__value-bold {
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #1a1a1a;
        }

        .pay-receipt__logo {
            width: 50px;
            height: auto;
            object-fit: contain;
        }

        .pay-receipt__divider-dashed {
            border: none;
            border-top: 1px dashed #999;
            margin: 20px 0;
        }

        .pay-receipt__section-title {
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1a1a1a;
            margin-bottom: 16px;
        }

        .pay-receipt__info-table {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .pay-receipt__info-row {
            display: grid;
            grid-template-columns: 140px 12px 1fr;
            gap: 4px;
            font-size: 11px;
            line-height: 1.6;
            color: #1a1a1a;
        }

        .pay-receipt__info-label {
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pay-receipt__info-sep {
            font-weight: 500;
            text-align: center;
        }

        .pay-receipt__info-value {
            font-weight: 400;
            word-break: break-word;
        }

        .pay-receipt__items-header {
            display: grid;
            grid-template-columns: 1fr 50px 90px 100px;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1a1a1a;
            padding-bottom: 6px;
        }

        .pay-receipt__items-divider {
            border-top: 1px solid #d5d5d5;
            margin-bottom: 12px;
        }

        .pay-receipt__items-row {
            display: grid;
            grid-template-columns: 1fr 50px 90px 100px;
            gap: 8px;
            font-size: 11px;
            line-height: 1.6;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .pay-receipt__col-qty {
            text-align: center;
        }

        .pay-receipt__col-price,
        .pay-receipt__col-subtotal {
            text-align: right;
        }

        .pay-receipt__totals-wrap {
            position: relative;
        }

        .pay-receipt__totals {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-top: 8px;
        }

        .pay-receipt__totals-row {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #1a1a1a;
        }

        .pay-receipt__totals-row--grand {
            font-weight: 800;
            font-size: 12px;
            margin-top: 6px;
        }

        .pay-receipt__paid-label {
            text-align: right;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1a1a1a;
            margin-top: 2px;
        }

        .pay-receipt__stamp {
            position: absolute;
            bottom: 0;
            left: 80%;
            transform: translateX(-50%) rotate(-10deg);
            opacity: 0.8;
            pointer-events: none;
            z-index: 1;
        }

        .pay-receipt__stamp img {
            width: 300px;
            height: auto;
        }

        .pay-receipt__note {
            text-align: center;
            margin-top: 40px;
            margin-bottom: -20px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #1a1a1a;
        }

        .pay-receipt__date {
            font-size: 10px;
            color: #666;
            margin-top: 6px;
        }

        /* Print styles */
        @media print {
            body {
                background-color: #fff;
                padding: 0;
            }

            .invoice-actions {
                display: none !important;
            }

            .pay-receipt {
                border: none;
                padding: 0;
            }

            .pay-receipt__stamp img {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .pay-receipt {
                padding: 24px 18px;
            }

            .pay-receipt__info-row {
                grid-template-columns: 110px 12px 1fr;
                font-size: 10px;
            }

            .pay-receipt__items-header,
            .pay-receipt__items-row {
                grid-template-columns: 1fr 35px 75px 80px;
                font-size: 10px;
                gap: 4px;
            }

            .pay-receipt__totals-row {
                font-size: 10px;
            }

            .pay-receipt__totals-row--grand {
                font-size: 11px;
            }

            .pay-receipt__stamp img {
                width: 150px;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-wrapper">
        {{-- Action Buttons --}}
        <div class="invoice-actions">
            <button class="invoice-actions__btn" onclick="window.print()">
                &#x1F5A8; Print Invoice
            </button>
            <a href="{{ url()->previous() }}" class="invoice-actions__btn invoice-actions__btn--back">
                &larr; Back
            </a>
        </div>

        {{-- Invoice Receipt --}}
        <div class="pay-receipt">
            <div class="pay-receipt__header">
                <div class="pay-receipt__order-number">
                    <span class="pay-receipt__label-bold">ORDER NUMBER:</span>
                    <span class="pay-receipt__value-bold">{{ $order->order_number }}</span>
                    <span class="pay-receipt__date">{{ $order->created_at->format('d M Y, H:i') }}</span>
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
            @foreach ($order->items as $item)
                <div class="pay-receipt__items-row">
                    <span class="pay-receipt__col-item">
                        {{ $item->product->title ?? 'Product' }}
                        @if ($item->variation_name)
                            <br><span style="font-size: 0.85em; color: #757575;">({{ $item->variation_name }})</span>
                        @endif
                    </span>
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
                    @if ($order->payment_status === 'paid')
                        <div class="pay-receipt__paid-label">
                            (PAID)
                        </div>
                    @endif
                </div>
                @if ($order->payment_status === 'paid')
                    <div class="pay-receipt__stamp">
                        <img src="{{ asset('image/kibar-stamp.png') }}" alt="KibarDjaya Stamp">
                    </div>
                @endif
            </div>

            <div class="pay-receipt__note">
                Thank you for your order.
            </div>
        </div>
    </div>
</body>

</html>