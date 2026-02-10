<!doctype html>
<html>

<body>
    <h2>Thank you for your order 🎉</h2>

    <p>
        Order Number: <strong>{{ $order->order_number }}</strong><br>
        Status: <strong>{{ strtoupper($order->payment_status) }}</strong>
    </p>

    <table width="100%" border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th align="left">Product</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->title ?? 'Product' }}</td>
                    <td align="center">{{ $item->quantity }}</td>
                    <td align="right">Rp {{ number_format($item->price * $item->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>
        <strong>Total: Rp {{ number_format($order->total_amount) }}</strong>
    </p>

    <p>
        — Kibardjaya
    </p>
</body>

</html>