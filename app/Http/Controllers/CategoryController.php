<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->withCount(['publishedArticles as article_count'])
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description,
                    'article_count' => $category->article_count,
                    'color' => $category->color,
                    'icon' => $category->icon
                ];
            });

        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }

    public function show($slug)
    {
        // Find category by slug
        $category = Category::where('slug', $slug)->firstOrFail();
        
        if (!$category->is_active) {
            abort(404);
        }

        $articles = $category->publishedArticles()
            ->with(['tags'])
            ->paginate(10)
            ->through(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'excerpt' => $article->excerpt,
                    'date' => $article->date,
                    'slug' => $article->slug,
                    'author' => $article->author,
                    'tags' => $article->tags->pluck('name')->toArray()
                ];
            });

        return Inertia::render('Categories/Show', [
            'category' => [
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'articles' => $articles
            ]
        ]);
    }
}
