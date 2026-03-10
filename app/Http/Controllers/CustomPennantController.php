<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomPennantController extends Controller
{
    public function index()
    {
        $flagColors = [
            'mustard' => ['name' => 'Mustard', 'hex' => '#E4AE3A'],
            'navy' => ['name' => 'Navy', 'hex' => '#1F2937'],
            'blue' => ['name' => 'Blue', 'hex' => '#3B82F6'],
            'red' => ['name' => 'Red', 'hex' => '#9f2222ff'],
            'pink' => ['name' => 'Pink', 'hex' => '#EC4899'],
        ];

        // Border options that determine the image filename
        $borderColors = [
            'cream' => ['name' => 'Cream', 'hex' => '#F2E8D2'],
            'black' => ['name' => 'Black', 'hex' => '#000000'],
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
            'stardos-stencil' => 'Stardos Stencil',
            'helvetica' => 'Helvetica',
            'fjalla-one' => 'Fjalla One',
            'lobster' => 'Lobster',
            'unifrakturmaguntia' => 'Unifraktur',
        ];

        return view('custom.pennant', compact('flagColors', 'borderColors', 'textColors', 'fonts'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'flag_color' => 'required|string',
            'border_color' => 'required|string',
            'text_color' => 'required|string',
            'text' => 'required|string|max:15',
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
        $directory = storage_path('app/public/custom-pennants');
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = 'custom-pennants/cp-' . time() . '-' . uniqid() . '.webp';
        file_put_contents(storage_path('app/public/' . $filename), $imageData);

        // Build cart entry
        $cart = session()->get('cart', []);
        $cartKey = 'custom-pennant-' . time() . '-' . uniqid();

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
            'title' => 'Custom Pennant',
            'price' => 99000,
            'image' => $filename,
            'qty' => (int) $request->input('qty'),
            'variation_name' => $variationSummary,
            'is_custom' => true,
            'custom_options' => $customOptions,
        ];

        session()->put('cart', $cart);
        session()->flash('cart_open', true);

        return response()->json(['success' => true, 'message' => 'Custom pennant added to cart!']);
    }
}
