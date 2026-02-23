<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ProductController::class, 'index']);
Route::get('/shop/{slug}', [ProductController::class, 'show']);

require __DIR__ . '/auth.php';

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::post('/cart/update/{id}', [CartController::class, 'update']);
Route::post('/cart/remove/{id}', [CartController::class, 'remove']);

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'process']);

Route::post('/checkout/payment-complete', function (\Illuminate\Http\Request $request) {
    $order = \App\Models\Order::where('order_number', $request->order_number)->first();
    if ($order) {
        session()->put('checkout_success_order_id', $order->id);
    }
    return response()->json(['success' => true]);
});
Route::get('/checkout/success', function () {
    // Prevent direct access — only allow if redirected from payment callback
    $orderId = session('checkout_success_order_id');
    if (!$orderId) {
        return redirect('/');
    }

    session()->forget('cart');
    $order = \App\Models\Order::with('items.product')->find($orderId);

    if (!$order) {
        return redirect('/');
    }

    return view('checkout.success', compact('order'));
})->name('checkout.success');

Route::get('/admin/orders/{order}/invoice', function (\App\Models\Order $order) {
    $order->load('items.product');
    return view('admin.invoice', compact('order'));
})->middleware(['auth'])->name('admin.order.invoice');