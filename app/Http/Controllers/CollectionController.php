<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CollectionController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $studioPicks = Product::where('is_studio_pick', true)
            ->with(['subCategory', 'colorVariants'])
            ->latest()
            ->get();

        $topPick = Product::withSum('orderItems', 'quantity')
            ->with(['subCategory', 'colorVariants'])
            ->orderByRaw('COALESCE(order_items_sum_quantity, 0) DESC')
            ->orderBy('id', 'desc')
            ->first();

        return view('collections.index', compact('categories', 'studioPicks', 'topPick'));
    }
}
