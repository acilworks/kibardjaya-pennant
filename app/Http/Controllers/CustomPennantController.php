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
}
