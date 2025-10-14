<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Keep ONE home route
Route::view('/', 'site.home')->name('home');

// Locale toggle
Route::get('/lang/{locale}', function (string $locale) {
    $allowed = ['en','ar'];
    $selected = in_array($locale, $allowed, true) ? $locale : config('app.fallback_locale', 'en');

    session(['locale' => $selected]);
    app()->setLocale($selected);

    return redirect()->back(fallback: route('home'));
})->name('setLocale');

// The rest of pages
Route::view('/about', 'site.about')->name('about');
Route::view('/gallery', 'site.gallery')->name('gallery');
Route::view('/news', 'site.news')->name('news');
Route::view('/partners', 'site.partners')->name('partners');
Route::view('/privacy', 'site.privacy')->name('privacy');
Route::view('/services', 'site.services')->name('services');
Route::view('/terms', 'site.terms')->name('terms');
Route::view('/tournaments', 'site.tournaments')->name('tournaments');
Route::view('/tours-reg', 'site.tours-reg')->name('tours-reg');
Route::view('/team', 'site.team')->name('team');

// Dashboard & auth (unchanged)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::view('/reg-single', 'site.reg-single')->name('reg-single');
    Route::view('/reg-team', 'site.reg-team')->name('reg-team');
});

require __DIR__.'/auth.php';

// --- Admin CMS routes (added) ---
use App\Http\Controllers\Admin\ContentController;

Route::middleware(['web','auth']) // Phase 8 can add 'can:manage-content'
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [ContentController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [ContentController::class, 'dashboard'])->name('dashboard');
        Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');
        Route::get('/contents/page/{group}', [ContentController::class, 'page'])->name('contents.page');
        Route::get('/contents/skeleton/{group}', [ContentController::class, 'skeleton'])->name('contents.skeleton');
        Route::get('/contents/{key}', [ContentController::class, 'edit'])->name('contents.edit');
        Route::post('/contents/{key}', [ContentController::class, 'update'])->name('contents.update');
        Route::post('/contents/{key}/ajax', [ContentController::class, 'updateAjax'])->name('contents.update.ajax');
        
        // Skeleton editors for specific pages
        Route::get('/skeleton/home', fn() => view('admin.skeleton-home'))->name('skeleton.home');
        Route::get('/skeleton/services', fn() => view('admin.skeleton-services'))->name('skeleton.services');
        Route::get('/skeleton/news', fn() => view('admin.skeleton-news'))->name('skeleton.news');
        Route::get('/skeleton/reg-team', fn() => view('admin.skeleton-reg-team'))->name('skeleton.reg-team');
        Route::get('/skeleton/reg-single', fn() => view('admin.skeleton-reg-single'))->name('skeleton.reg-single');
        
        // AJAX endpoints for content management
        Route::post('/content/update-ajax', [ContentController::class, 'updateContentAjax'])->name('content.update-ajax');
        Route::post('/content/batch-update', [ContentController::class, 'batchUpdate'])->name('content.batch-update');
    });
