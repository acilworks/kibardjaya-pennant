<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\HeroSlide;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get();
        $categories = Category::all();
        $heroSlides = HeroSlide::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        return view('home', compact('products', 'categories', 'heroSlides'));
    }
}
