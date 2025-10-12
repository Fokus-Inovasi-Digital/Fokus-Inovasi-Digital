<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AboutController,
    ArticleController,
    SolutionController,
    PartnerController,
    CareerController,
    ContactController,
    DashboardController,
    ProfileController
};

/*
|--------------------------------------------------------------------------
| Storage Symlink Route (Run once after deployment)
|--------------------------------------------------------------------------
*/
Route::get('/storage-link', function () {
    $targetFolder = base_path() . '/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';

    if (!file_exists($linkFolder)) {
        try {
            symlink($targetFolder, $linkFolder);
            return "Symlink created successfully!";
        } catch (\Exception $e) {
            return "Failed to create symlink: " . $e->getMessage();
        }
    }
    return "Symlink already exists.";
});

Route::get('/linkstorage-manual', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    try {
        // Cek apakah link sudah ada untuk menghindari error
        if (file_exists($link)) {
            return 'Link "public/storage" sudah ada.';
        }

        // Coba buat symlink
        symlink($target, $link);
        return 'Symbolic link berhasil dibuat.';

    } catch (\Exception $e) {
        // Tangkap error jika gagal
        return 'Gagal membuat symbolic link: ' . $e->getMessage();
    }
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/solutions', [SolutionController::class, 'index'])->name('solutions.index');
Route::get('/solutions/{category}', [SolutionController::class, 'category'])->name('solutions.category');
Route::get('/solutions/{category}/{solution}', [SolutionController::class, 'show'])->name('solutions.show');

Route::get('/careers', fn() => view('pages.careers.index'))->name('careers');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';