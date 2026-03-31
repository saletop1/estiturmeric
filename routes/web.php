<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\SettingController;

// ─── Sitemap ─────────────────────────────────────────────────
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// ─── Frontend ────────────────────────────────────────────────
Route::middleware('track.visit')->group(function () {
    Route::get('/',           [FrontendController::class, 'index'])->name('home');
    Route::get('/tentang',    [FrontendController::class, 'about'])->name('about');
    Route::get('/produk',     [FrontendController::class, 'products'])->name('products');
    Route::get('/produk/{slug}', [FrontendController::class, 'productDetail'])->name('products.show');
    Route::get('/keunggulan', [FrontendController::class, 'advantages'])->name('advantages');
    Route::get('/kontak',     [FrontendController::class, 'contact'])->name('contact');

    // Testimonials
    Route::get('/testimoni',        [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimoni',       [TestimonialController::class, 'store'])->name('testimonials.store');
});

// ─── Admin Auth ───────────────────────────────────────────────
Route::get('/admin', fn() => redirect('/admin/login')); // tombol footer & float button

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
});

// ─── Admin Protected ─────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/toggle', [ProductController::class, 'toggle'])->name('products.toggle');

    // Testimonials
    Route::get('testimonials',                    [TestimonialAdminController::class, 'index'])->name('testimonials.index');
    Route::post('testimonials/{testimonial}/approve', [TestimonialAdminController::class, 'approve'])->name('testimonials.approve');
    Route::post('testimonials/{testimonial}/reject',  [TestimonialAdminController::class, 'reject'])->name('testimonials.reject');
    Route::delete('testimonials/{testimonial}',   [TestimonialAdminController::class, 'destroy'])->name('testimonials.destroy');

    // Stats
    Route::get('stats', [StatsController::class, 'index'])->name('stats');

    // Settings / SEO
    Route::get('settings',       [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings',      [SettingController::class, 'update'])->name('settings.update');
    Route::post('settings/seo',  [SettingController::class, 'updateSeo'])->name('settings.seo');
});