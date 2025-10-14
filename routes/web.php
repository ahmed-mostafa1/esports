<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Keep ONE home route
Route::view('/', 'site.home')->name('home');

// Locale toggle
Route::get('/lang/{locale}', function (string $locale) {
    $allowed = ['en','ar'];
    session(['locale' => in_array($locale, $allowed, true) ? $locale : 'en']);
    return back();
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
    Route::view('/team', 'site.team')->name('team');
});

require __DIR__.'/auth.php';
