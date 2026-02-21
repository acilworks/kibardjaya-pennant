<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart))
            return redirect('/shop');

        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request, MidtransService $midtrans)
    {
        $cart = session('cart');
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Cart is empty');
        }

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

        $shippingProvince = \App\Models\ShippingProvince::find($request->province_id);
        $shippingCost = $shippingProvince ? $shippingProvince->cost : 0;
        $grandTotal = $total + $shippingCost;

        $order = Order::create([
            'order_number' => 'KIBAR-' . strtoupper(Str::random(8)),
            'total_amount' => $grandTotal,
            'shipping_cost' => $shippingCost,
            'customer_name' => trim($request->first_name . ' ' . $request->last_name),
            'customer_email' => $request->email,
            'phone' => $request->phone,
            'note' => $request->note,
            'address' => $request->address,
            'city' => $shippingProvince ? $shippingProvince->province : null,
            'postal_code' => $request->postal_code,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
            ]);
        }

        $snapToken = $midtrans->createSnapToken([
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $grandTotal,
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $order->customer_email,
                'phone' => $request->phone,
                'shipping_address' => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $shippingProvince ? $shippingProvince->province : '',
                    'postal_code' => $request->postal_code,
                    'country_code' => 'IDN'
                ]
            ],
        ]);

        return view('checkout.pay', compact('snapToken', 'order'));
    }
}