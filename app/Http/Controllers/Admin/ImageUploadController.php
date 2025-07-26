<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ImageUploadController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    /**
     * Upload image for articles
     */
    public function uploadArticleImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        try {
            $file = $request->file('image');
            
            if (!$this->imageUploadService->validateImage($file)) {
                return response()->json([
                    'error' => 'Invalid image file'
                ], 400);
            }

            $result = $this->imageUploadService->uploadImage(
                $file, 
                'articles', 
                ImageUploadService::getArticleThumbnailSizes()
            );

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'data' => $result
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload image for categories
     */
    public function uploadCategoryImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048' // 2MB for categories
        ]);

        try {
            $file = $request->file('image');
            
            $result = $this->imageUploadService->uploadImage(
                $file, 
                'categories',
                [
                    'thumbnail' => ['width' => 150, 'height' => 150],
                    'medium' => ['width' => 300, 'height' => 300],
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Category image uploaded successfully',
                'data' => $result
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to upload category image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete uploaded image
     */
    public function deleteImage(Request $request): JsonResponse
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        try {
            $deleted = $this->imageUploadService->deleteImage($request->path);

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            }

            return response()->json([
                'error' => 'Failed to delete image'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload image via editor (for content images)
     */
    public function uploadEditorImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:3072' // 3MB for editor
        ]);

        try {
            $file = $request->file('image');
            
            $result = $this->imageUploadService->uploadImage($file, 'editor');

            return response()->json([
                'success' => true,
                'message' => 'Editor image uploaded successfully',
                'url' => $result['original'] // Return URL for editor insertion
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to upload editor image: ' . $e->getMessage()
            ], 500);
        }
    }
}
