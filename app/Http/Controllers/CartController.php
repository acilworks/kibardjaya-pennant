<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $provinces = \App\Models\ShippingProvince::all();
        return view('cart.index', compact('cart', 'provinces'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Reject if product is sold out
        if ($product->is_sold_out) {
            return back()->with('error', 'Produk ini sudah habis (Sold Out).');
        }

        $cart = session()->get('cart', []);

        $currentQty = $cart[$id]['qty'] ?? 0;

        // Reject if adding would exceed available stock
        if (($currentQty + 1) > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi. Tersisa ' . $product->stock . ' item.');
        }

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'image' => $product->images[0] ?? null,
                'qty' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Product added to cart');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            // Validate against stock
            if ($product && $request->qty > $product->stock) {
                return back()->with('error', 'Stok tidak mencukupi. Tersisa ' . $product->stock . ' item.');
            }

            $cart[$id]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }

        return back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back();
    }
}