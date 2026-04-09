<?php

namespace App\Console\Commands;

use App\Services\WebpImageService;
use App\Models\Product;
use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\ProductColorVariant;
use App\Models\Collaboration;
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

        // ── Collaborations ──
        $this->info('Converting collaborations images...');
        Collaboration::chunk(50, function ($collabs) use ($service, &$converted, &$failed) {
            foreach ($collabs as $collab) {
                if ($collab->image) {
                    try {
                        $collab->update(['image' => $service->convertToWebp($collab->image)]);
                        $converted++;
                    } catch (\Throwable $e) {
                        $this->warn("  Failed: {$collab->image} — {$e->getMessage()}");
                        $failed++;
                    }
                }
                if ($collab->banner_image) {
                    try {
                        $collab->update(['banner_image' => $service->convertToWebp($collab->banner_image)]);
                        $converted++;
                    } catch (\Throwable $e) {
                        $this->warn("  Failed: {$collab->banner_image} — {$e->getMessage()}");
                        $failed++;
                    }
                }
            }
        });

        // ── Static Public Images ──
        $this->info('Converting static images in public folders...');
        $staticPaths = [public_path('image'), public_path('images/pennant_parts')];
        $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

        foreach ($staticPaths as $staticPath) {
            if (\Illuminate\Support\Facades\File::exists($staticPath)) {
                $files = \Illuminate\Support\Facades\File::allFiles($staticPath);
                foreach ($files as $file) {
                    if (in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'bmp'])) {
                        $absolutePath = $file->getRealPath();
                        $webpPath = preg_replace('/\.(jpe?g|png|gif|bmp)$/i', '.webp', $absolutePath);

                        if (!file_exists($webpPath)) {
                            try {
                                $image = $manager->read($absolutePath);
                                $image->toWebp(80)->save($webpPath);
                                $converted++;
                                unlink($absolutePath);
                            } catch (\Throwable $e) {
                                $this->warn("  Failed: {$file->getFilename()} — {$e->getMessage()}");
                                $failed++;
                            }
                        } else {
                            if (file_exists($absolutePath)) {
                                unlink($absolutePath);
                            }
                        }
                    }
                }
            }
        }

        $this->newLine();
        $this->info("✅ Done! Converted: {$converted}, Failed: {$failed}");

        return self::SUCCESS;
    }
}
