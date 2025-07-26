<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArticleRequest;
use App\Http\Requests\Admin\UpdateArticleRequest;
use App\Services\ImageUploadService;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
    public function index(Request $request)
    {
        $query = Article::with(['category', 'user', 'tags']);

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $articles = $query->latest()
            ->paginate(15)
            ->withQueryString()
            ->through(fn ($article) => [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'excerpt' => Str::limit($article->excerpt, 100),
                'category' => $article->category->name,
                'author' => $article->user->name,
                'is_published' => $article->is_published,
                'published_at' => $article->published_at?->format('d M Y'),
                'views_count' => $article->views_count,
                'reading_time' => $article->reading_time,
                'tags' => $article->tags->pluck('name')->join(', '),
            ]);

        $categories = Category::orderBy('name')->get(['id', 'name']);

        return Inertia::render('Admin/Articles/Index', [
            'articles' => $articles,
            'categories' => $categories,
            'filters' => $request->only(['category', 'status', 'search']),
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get(['id', 'name']);
        $tags = Tag::orderBy('name')->get(['id', 'name', 'slug']);

        return Inertia::render('Admin/Articles/Create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $imageResult = $this->imageUploadService->uploadImage(
                    $request->file('image'),
                    'articles',
                    ImageUploadService::getArticleThumbnailSizes()
                );
                $validated['image'] = $imageResult['original'];
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();
        $validated['author_name'] = auth()->user()->name;
        
        if ($validated['is_published'] ?? false) {
            $validated['published_at'] = now();
        }

        $article = Article::create($validated);

        if (!empty($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        $article->load(['category', 'user', 'tags']);

        return Inertia::render('Admin/Articles/Show', [
            'article' => [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'excerpt' => $article->excerpt,
                'content' => $article->content,
                'image' => $article->image,
                'category' => $article->category,
                'author' => $article->user->name,
                'is_published' => $article->is_published,
                'published_at' => $article->published_at?->format('d M Y H:i'),
                'views_count' => $article->views_count,
                'reading_time' => $article->reading_time,
                'tags' => $article->tags,
                'created_at' => $article->created_at->format('d M Y H:i'),
                'updated_at' => $article->updated_at->format('d M Y H:i'),
            ],
        ]);
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get(['id', 'name']);
        $tags = Tag::orderBy('name')->get(['id', 'name', 'slug']);

        return Inertia::render('Admin/Articles/Edit', [
            'article' => [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'excerpt' => $article->excerpt,
                'content' => $article->content,
                'image' => $article->image,
                'category_id' => $article->category_id,
                'is_published' => $article->is_published,
                'reading_time' => $article->reading_time,
                'tags' => $article->tags->pluck('id'),
            ],
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validated = $request->validated();
        
        // Handle image operations
        if ($request->boolean('remove_image') && $article->image) {
            // Delete current image
            $imagePath = str_replace('/storage/', '', parse_url($article->image, PHP_URL_PATH));
            $this->imageUploadService->deleteImage($imagePath);
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            // Upload new image
            try {
                // Delete old image if exists
                if ($article->image) {
                    $oldImagePath = str_replace('/storage/', '', parse_url($article->image, PHP_URL_PATH));
                    $this->imageUploadService->deleteImage($oldImagePath);
                }

                $imageResult = $this->imageUploadService->uploadImage(
                    $request->file('image'),
                    'articles',
                    ImageUploadService::getArticleThumbnailSizes()
                );
                $validated['image'] = $imageResult['original'];
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        } elseif ($request->filled('current_image')) {
            // Keep existing image
            $validated['image'] = $request->current_image;
        }

        $validated['slug'] = Str::slug($validated['title']);

        // Handle publishing
        if (($validated['is_published'] ?? false) && !$article->is_published) {
            $validated['published_at'] = now();
        } elseif (!($validated['is_published'] ?? false)) {
            $validated['published_at'] = null;
        }

        $article->update($validated);

        if (isset($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Delete associated image
        if ($article->image) {
            $imagePath = str_replace('/storage/', '', parse_url($article->image, PHP_URL_PATH));
            $this->imageUploadService->deleteImage($imagePath);
        }

        $article->tags()->detach();
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
