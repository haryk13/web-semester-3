<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadService
{
    public function __construct()
    {
        // Ensure public disk is available
        if (!Storage::disk('public')->exists('images')) {
            Storage::disk('public')->makeDirectory('images');
        }
    }

    /**
     * Upload and process an image
     */
    public function uploadImage(UploadedFile $file, string $folder = 'articles', array $sizes = []): array
    {
        // Generate unique filename
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = $folder . '/' . $filename;

        // Store original image
        $fullPath = $file->storeAs('images/' . $folder, $filename, 'public');

        $result = [
            'original' => Storage::disk('public')->url($fullPath),
            'path' => $fullPath,
            'filename' => $filename,
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ];

        // Generate thumbnails if sizes specified
        if (!empty($sizes)) {
            $result['thumbnails'] = $this->generateThumbnails($fullPath, $sizes);
        }

        return $result;
    }

    /**
     * Generate thumbnails for different sizes
     */
    public function generateThumbnails(string $imagePath, array $sizes): array
    {
        $thumbnails = [];
        $manager = new ImageManager(new Driver());

        $fullPath = Storage::disk('public')->path($imagePath);
        
        foreach ($sizes as $name => $dimensions) {
            $thumbnailPath = str_replace('.', "_{$name}.", $imagePath);
            $thumbnailFullPath = Storage::disk('public')->path($thumbnailPath);

            $image = $manager->read($fullPath);
            
            if (isset($dimensions['width']) && isset($dimensions['height'])) {
                // Resize with crop
                $image->cover($dimensions['width'], $dimensions['height']);
            } elseif (isset($dimensions['width'])) {
                // Resize by width, maintain aspect ratio
                $image->scale(width: $dimensions['width']);
            } elseif (isset($dimensions['height'])) {
                // Resize by height, maintain aspect ratio
                $image->scale(height: $dimensions['height']);
            }

            $image->save($thumbnailFullPath);

            $thumbnails[$name] = [
                'url' => Storage::disk('public')->url($thumbnailPath),
                'path' => $thumbnailPath,
                'width' => $dimensions['width'] ?? null,
                'height' => $dimensions['height'] ?? null,
            ];
        }

        return $thumbnails;
    }

    /**
     * Delete image and its thumbnails
     */
    public function deleteImage(string $imagePath): bool
    {
        $deleted = Storage::disk('public')->delete($imagePath);

        // Delete thumbnails
        $pathInfo = pathinfo($imagePath);
        $thumbnailPattern = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_*.' . $pathInfo['extension'];
        
        $thumbnails = Storage::disk('public')->files($pathInfo['dirname']);
        foreach ($thumbnails as $file) {
            if (fnmatch($thumbnailPattern, $file)) {
                Storage::disk('public')->delete($file);
            }
        }

        return $deleted;
    }

    /**
     * Get default thumbnail sizes for articles
     */
    public static function getArticleThumbnailSizes(): array
    {
        return [
            'thumbnail' => ['width' => 300, 'height' => 200],
            'medium' => ['width' => 600, 'height' => 400],
            'large' => ['width' => 1200, 'height' => 800],
        ];
    }

    /**
     * Validate image file
     */
    public function validateImage(UploadedFile $file): bool
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        return in_array($file->getMimeType(), $allowedTypes) && $file->getSize() <= $maxSize;
    }
}
