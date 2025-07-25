<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminTagController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('article');
Route::get('/tutorial', [TutorialController::class, 'index'])->name('tutorials');
Route::get('/kategori', [CategoryController::class, 'index'])->name('categories');
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('category');

// Protected routes
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Articles management
    Route::resource('articles', AdminArticleController::class);
    
    // Categories management
    Route::resource('categories', AdminCategoryController::class);
    
    // Tags management
    Route::resource('tags', AdminTagController::class)->except(['show']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
