<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function midtrans(Request $request)
    {
        Log::info('Midtrans webhook received', [
            'order_id' => $request->order_id,
            'transaction_status' => $request->transaction_status,
            'payment_type' => $request->payment_type,
            'all' => $request->all(),
        ]);

        $order = Order::where('order_number', $request->order_id)->first();

        if (!$order) {
            Log::warning('Midtrans webhook: Order not found', ['order_id' => $request->order_id]);
            return response()->json(['status' => 'order not found']);
        }

        if ($request->transaction_status === 'settlement' || $request->transaction_status === 'capture') {
            $order->update(['payment_status' => 'paid']);
            Log::info('Order payment status updated to paid', ['order_id' => $request->order_id]);
        }

        return response()->json(['status' => 'ok']);
    }
}
