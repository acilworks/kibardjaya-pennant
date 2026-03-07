<?php

namespace App\Console\Commands;

use App\Services\WebpImageService;
use App\Models\Product;
use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\ProductColorVariant;
use Illuminate\Console\Command;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:convert-webp';
    protected $description = 'Convert all existing product, category, and hero slide images to WebP format';

    public function handle(WebpImageService $service): int
    {
        $converted = 0;
        $failed = 0;

        // ── Products ──
        $this->info('Converting product images...');
        Product::whereNotNull('images')->chunk(50, function ($products) use ($service, &$converted, &$failed) {
            foreach ($products as $product) {
                $images = $product->images;
                if (!is_array($images) || empty($images))
                    continue;

                $newImages = [];
                foreach ($images as $img) {
                    try {
                        $newImages[] = $service->convertToWebp($img);
                        $converted++;
                    } catch (\Throwable $e) {
                        $this->warn("  Failed: {$img} — {$e->getMessage()}");
                        $newImages[] = $img;
                        $failed++;
                    }
                }

                $product->update(['images' => $newImages]);
            }
        });

        // ── Product Color Variants ──
        $this->info('Converting color variant images...');
        ProductColorVariant::whereNotNull('image')->chunk(50, function ($variants) use ($service, &$converted, &$failed) {
            foreach ($variants as $variant) {
                try {
                    $variant->update(['image' => $service->convertToWebp($variant->image)]);
                    $converted++;
                } catch (\Throwable $e) {
                    $this->warn("  Failed: {$variant->image} — {$e->getMessage()}");
                    $failed++;
                }
            }
        });

        // ── Categories ──
        $this->info('Converting category thumbnails...');
        Category::whereNotNull('thumbnail')->chunk(50, function ($categories) use ($service, &$converted, &$failed) {
            foreach ($categories as $category) {
                try {
                    $category->update(['thumbnail' => $service->convertToWebp($category->thumbnail)]);
                    $converted++;
                } catch (\Throwable $e) {
                    $this->warn("  Failed: {$category->thumbnail} — {$e->getMessage()}");
                    $failed++;
                }
            }
        });

        // ── Hero Slides ──
        $this->info('Converting hero slide backgrounds...');
        HeroSlide::whereNotNull('background_image')->chunk(50, function ($slides) use ($service, &$converted, &$failed) {
            foreach ($slides as $slide) {
                try {
                    $slide->update(['background_image' => $service->convertToWebp($slide->background_image)]);
                    $converted++;
                } catch (\Throwable $e) {
                    $this->warn("  Failed: {$slide->background_image} — {$e->getMessage()}");
                    $failed++;
                }
            }
        });

        $this->newLine();
        $this->info("✅ Done! Converted: {$converted}, Failed: {$failed}");

        return self::SUCCESS;
    }
}
