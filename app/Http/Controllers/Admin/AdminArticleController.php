<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminArticleController extends Controller
{
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'reading_time' => 'nullable|integer|min:1',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

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

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'reading_time' => 'nullable|integer|min:1',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

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
        $article->tags()->detach();
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
