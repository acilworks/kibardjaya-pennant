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
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

        $order = Order::create([
            'order_number' => 'KBJ-' . strtoupper(Str::random(8)),
            'total_amount' => $total,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
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
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
            ],
        ]);

        return view('checkout.pay', compact('snapToken', 'order'));
    }
}