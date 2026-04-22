<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RobotsController;

// ─── SEO ──────────────────────────────────────────────────────────────────────

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');

// ─── Public Routes ────────────────────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/impressum', [LegalController::class, 'impressum'])->name('impressum');
Route::get('/datenschutz', [LegalController::class, 'privacy'])->name('privacy');

// Auth
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::middleware('throttle:5,1')->post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
//Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//Route::post('register', [RegisterController::class, 'register']);

// Comments (public submission — stored as unapproved)
Route::middleware('throttle:10,1')->post('/comments', [CommentController::class, 'store']);

// ─── Admin Routes ─────────────────────────────────────────────────────────────

Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Admin sections
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    // Route::get('/admin/comments', [AdminController::class, 'comments'])->name('admin.comments');
    Route::get('/admin/taxonomy', [AdminController::class, 'taxonomy'])->name('admin.taxonomy');

    // Posts CRUD
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Categories CRUD
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Tags CRUD
    Route::post('/admin/tags', [TagController::class, 'store'])->name('admin.tags.store');
    Route::put('/admin/tags/{tag}', [TagController::class, 'update'])->name('admin.tags.update');
    Route::delete('/admin/tags/{tag}', [TagController::class, 'destroy'])->name('admin.tags.destroy');

});
