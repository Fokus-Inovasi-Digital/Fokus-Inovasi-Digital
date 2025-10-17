<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ArticleController,
    SolutionController,
    PartnerController,
    CareerController,
    ContactController,
    DashboardController,
    JobApplicationController,
    ProfileController
};

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/solutions', [SolutionController::class, 'index'])->name('solutions.index');
Route::get('/solutions/{category}', [SolutionController::class, 'category'])->name('solutions.category');
Route::get('/solutions/{category}/{solution}', [SolutionController::class, 'show'])->name('solutions.show');

Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{career}', [CareerController::class, 'show'])->name('careers.show');

Route::get('/partners', [PartnerController::class, 'index'])->name('partners');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/careers/{career}/apply', [JobApplicationController::class, 'create'])->name('careers.apply.create');
    Route::post('/careers/{career}/apply', [JobApplicationController::class, 'store'])->name('careers.apply.store');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';