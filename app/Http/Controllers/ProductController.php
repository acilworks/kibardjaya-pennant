<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['subCategory', 'colorVariants']);

        if ($request->filled('category')) {
            $query->whereHas('categoryRelation', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('subcategory')) {
            $query->whereHas('subCategory', function ($q) use ($request) {
                $q->where('slug', $request->subcategory);
            });
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(16)->withQueryString();
        $categories = \App\Models\Category::all();
        $subCategories = \App\Models\SubCategory::all();

        $currentSort = $request->sort ?? 'latest';
        $currentCategory = $request->category;
        $currentSubCategory = $request->subcategory;

        return view('shop.index', compact('products', 'categories', 'subCategories', 'currentSort', 'currentCategory', 'currentSubCategory'));
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