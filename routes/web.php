<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('pages.home'))->name('home');
Route::get('/solutions', fn() => view('pages.solutions.index'))->name('solutions');
// Route::get('/projects', fn() => view('pages.projects.index'))->name('projects');
Route::get('/news', fn() => view('pages.articles.index'))->name('articles');
Route::get('/careers', fn() => view('pages.careers.index'))->name('careers');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');

Route::get('/about', fn() => view('pages.about'))->name('about');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
