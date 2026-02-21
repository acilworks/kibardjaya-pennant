<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(9);
        return view('shop.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with(['categoryRelation', 'subCategory', 'colorVariants'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::where('sub_category_id', $product->sub_category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}