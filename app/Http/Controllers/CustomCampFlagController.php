<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomCampFlagController extends Controller
{
    public function index()
    {
        $flagColors = [
            'mustard' => ['name' => 'Mustard', 'hex' => '#E4AE3A'],
            'navy' => ['name' => 'Navy', 'hex' => '#1F2937'],
            'forest' => ['name' => 'Forest', 'hex' => '#2D5A27'],
            'maroon' => ['name' => 'Maroon', 'hex' => '#800000'],
            'pink' => ['name' => 'Pink', 'hex' => '#EC4899'],
            'skyblue' => ['name' => 'Sky Blue', 'hex' => '#87CEEB'],
            'black' => ['name' => 'Black', 'hex' => '#1a1a1a'],
            'cream' => ['name' => 'Cream', 'hex' => '#F2E8D2'],
            'white' => ['name' => 'White', 'hex' => '#FFFFFF'],
        ];

        // Border options that determine the image filename
        $borderColors = [
            'black' => ['name' => 'Black', 'hex' => '#000000'],
            'cream' => ['name' => 'Cream', 'hex' => '#F2E8D2'],
        ];

        // Text Colors
        $textColors = [
            'cream' => ['name' => 'Cream', 'hex' => '#F2E8D2'],
            'black' => ['name' => 'Black', 'hex' => '#000000'],
            'khaki' => ['name' => 'Khaki', 'hex' => '#C19A6B'],
            'navy' => ['name' => 'Navy', 'hex' => '#1F2937'],
            'mustard' => ['name' => 'Mustard', 'hex' => '#E4AE3A'],
        ];

        $fonts = [
            'ombudsman-stencil' => 'Stencil96',
            'stardos-stencil' => 'Stencil07',
            // 'jersey-m54-v2' => 'Jersey M54 V2',
            'jersey666' => 'Collage',
            // 'helvetica' => 'Helvetica',
            // 'fjalla-one' => 'Fjalla One',
            'lobster' => 'Lobster',
            'unifrakturmaguntia' => 'Unifraktur',
        ];

        $latestCampFlags = [];
        $directory = storage_path('app/public/custom-camp-flags');
        if (is_dir($directory)) {
            $files = collect(\Illuminate\Support\Facades\File::files($directory))
                ->sortByDesc(function ($file) {
                return $file->getMTime();
            })
                ->take(12)
                ->map(function ($file) {
                return 'storage/custom-camp-flags/' . $file->getFilename();
            })
                ->values()
                ->toArray();
            $latestCampFlags = $files;
        }

        return view('custom.camp-flag', compact('flagColors', 'borderColors', 'textColors', 'fonts', 'latestCampFlags'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'flag_color' => 'required|string',
            'border_color' => 'required|string',
            'text_color' => 'required|string',
            'text' => 'required|string|max:50',
            'font' => 'required|string',
            'qty' => 'required|integer|min:1',
            'custom_image' => 'required|string',
        ]);

        // Decode base64 image and save to storage
        $imageData = $request->input('custom_image');
        $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
        $imageData = base64_decode($imageData);

        if (!$imageData) {
            return response()->json(['success' => false, 'message' => 'Invalid image data.'], 422);
        }

        // Ensure directory exists
        $directory = storage_path('app/public/custom-camp-flags');
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = 'custom-camp-flags/ccf-' . time() . '-' . uniqid() . '.webp';
        file_put_contents(storage_path('app/public/' . $filename), $imageData);

        // Build cart entry
        $cart = session()->get('cart', []);
        $cartKey = 'custom-camp-flag-' . time() . '-' . uniqid();

        $customOptions = [
            'flag_color' => $request->input('flag_color'),
            'border_color' => $request->input('border_color'),
            'text_color' => $request->input('text_color'),
            'text' => $request->input('text'),
            'font' => $request->input('font'),
        ];

        $variationSummary = $request->input('flag_color') . ' / ' . $request->input('border_color') . ' / "' . $request->input('text') . '"';

        $cart[$cartKey] = [
            'id' => null,
            'title' => 'Custom Camp Flag',
            'price' => 159000,
            'image' => $filename,
            'qty' => (int)$request->input('qty'),
            'variation_name' => $variationSummary,
            'is_custom' => true,
            'custom_options' => $customOptions,
        ];

        session()->put('cart', $cart);
        session()->flash('cart_open', true);

        return response()->json(['success' => true, 'message' => 'Custom camp flag added to cart!']);
    }
}