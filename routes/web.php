<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Models\Game;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// });
Route::get('/', function () {
    $bestGames = Game::where('rating', '>', 4)->get();
    return view('dashboard', compact('bestGames'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);

Route::middleware('auth', 'admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::patch('admin/profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::get('admin/games', [GamesController::class, 'index'])->name('admin.games');
    Route::get('admin/games/create', [GamesController::class, 'create'])->name('admin.games.create');
    Route::get('admin/users', [UsersController::class, 'index'])->name('admin.users');
});

// Google Auth
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

require __DIR__.'/auth.php';