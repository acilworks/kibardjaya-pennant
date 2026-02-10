<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderInvoiceMail;
use Illuminate\Support\Facades\Mail;

class WebhookController extends Controller
{
    public function midtrans(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');

        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        // ❌ Signature tidak valid → TOLAK
        if ($signature !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_number', $request->order_id)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status berdasarkan status Midtrans
        match ($request->transaction_status) {
            'settlement' => $order->update(['payment_status' => 'paid']),
            'pending' => $order->update(['payment_status' => 'pending']),
            'expire' => $order->update(['payment_status' => 'expired']),
            'cancel',
            'deny' => $order->update(['payment_status' => 'failed']),
            default => null,
        };

        if (
            $request->transaction_status === 'settlement'
            && $order->payment_status !== 'paid'
        ) {

            $order->update(['payment_status' => 'paid']);

            Mail::to($order->customer_email)
                ->send(new OrderInvoiceMail($order));
        }

        return response()->json(['message' => 'OK']);
    }
}
