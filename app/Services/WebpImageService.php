<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebpImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Convert an image file on the 'public' disk to WebP format.
     *
     * @param string $path  Path relative to the public disk (e.g. "products/abc123.jpg")
     * @param int    $quality  WebP quality (1-100)
     * @return string  New path relative to the public disk (e.g. "products/abc123.webp")
     */
    public function convertToWebp(string $path, int $quality = 80): string
    {
        $disk = Storage::disk('public');

        if (!$disk->exists($path)) {
            return $path;
        }

        // Already WebP — skip conversion
        if (Str::endsWith(strtolower($path), '.webp')) {
            return $path;
        }

        $absolutePath = $disk->path($path);
        $image = $this->manager->read($absolutePath);

        // Build new filename with .webp extension
        $webpPath = preg_replace('/\.(jpe?g|png|gif|bmp)$/i', '.webp', $path);

        // Encode to WebP
        $encoded = $image->toWebp($quality);

        // Store the WebP file
        $disk->put($webpPath, (string) $encoded);

        // Delete the original file if the new path is different
        if ($webpPath !== $path) {
            $disk->delete($path);
        }

        return $webpPath;
    }
}
