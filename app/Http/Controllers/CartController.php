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

        $variationId = $request->input('color_variant_id');
        $variationName = '';
        $variationImage = '';

        if ($variationId) {
            $variation = \App\Models\ProductColorVariant::find($variationId);
            if ($variation) {
                $variationName = $variation->color_name;
                $variationImage = $variation->image;
            }
        }

        $cartKey = $variationId ? $id . '_' . $variationId : $id;

        $currentQty = $cart[$cartKey]['qty'] ?? 0;

        $requestedQty = (int) $request->input('quantity', 1);

        // Reject if adding would exceed available stock
        if (($currentQty + $requestedQty) > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi. Tersisa ' . $product->stock . ' item.');
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['qty'] += $requestedQty;
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'image' => $variationImage ? $variationImage : ($product->images[0] ?? null),
                'qty' => $requestedQty,
                'variation_name' => $variationName,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart')->with('cart_open', true);
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $productId = $cart[$id]['id'];
            $product = Product::find($productId);
            // Validate against stock
            if ($product && $request->qty > $product->stock) {
                return back()->with('error', 'Stok tidak mencukupi. Tersisa ' . $product->stock . ' item.')->with('cart_open', true);
            }

            $cart[$id]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }

        return back()->with('cart_open', true);
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('cart_open', true);
    }
}