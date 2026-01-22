<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// 1. Public Landing Page
Route::get('/', [VideoController::class, 'index'])->name('home');

// 2. Authenticated Routes (Requires Login)
Route::middleware(['auth', 'verified'])->group(function () {

    // Default Dashboard landing
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Define CREATE first so it doesn't get confused with /{video}
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
});

Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');


// 3. Essential: Load the Auth Routes (Login, Logout, Register)
// This is likely why Ziggy couldn't find 'login' earlier
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

require __DIR__ . '/settings.php';
