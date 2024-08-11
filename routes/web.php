<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\GameplayController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserGamesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UsersController::class, 'dashboard'])->name('/');

Route::get('/free-games', [UsersController::class, 'freeGames'])->name('freeGames');
Route::get('/premium-games', [UsersController::class, 'premiumGames'])->name('premiumGames');
Route::get('/gamplays', [UsersController::class, 'gameplays'])->name('gameplays');
Route::post('/gamplays/upload', [GameplayController::class, 'store'])->name('gameplays.upload');
Route::delete('/gamplays/delete', [GameplayController::class, 'destroy'])->name('gameplays.delete');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');


    Route::get('user/profile', [UsersController::class, 'profile'])->name('user.profile');
    Route::get('user/favourites', [FavouriteController::class, 'index'])->name('user.favourite');
    Route::get('user/favourites/{game_id}', [FavouriteController::class, 'store'])->name('user.favourite.add');
    Route::get('user/favourites/{game_id}/delete', [FavouriteController::class, 'destroy'])->name('user.favourite.remove');
    Route::get('user/library', [UserGamesController::class, 'index'])->name('user.library');
    Route::get('user/library/{game_id}/delete', [UserGamesController::class, 'destroy'])->name('user.library.remove');

    Route::get('games/{id}', [GamesController::class, 'show'])->name('games.show');

    Route::post('sending-report', [ContactController::class, 'store'])->name('send.contact');

});
    

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth', 'admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Profile
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::patch('admin/profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
    // Games
    Route::get('admin/games', [GamesController::class, 'index'])->name('admin.games');
    Route::get('admin/games/create', [GamesController::class, 'create'])->name('admin.games.create');
    Route::post('admin/games/add', [GamesController::class, 'store'])->name('admin.games.store');
    Route::get('admin/games/{id}', [GamesController::class, 'edit'])->name('admin.games.edit');
    Route::put('admin/games/update', [GamesController::class, 'update'])->name('admin.games.update');
    Route::delete('admin/games/{id}', [GamesController::class, 'destroy'])->name('admin.games.delete');

    // Users
    Route::get('admin/users', [UsersController::class, 'index'])->name('admin.users');
    // Categories
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('admin/categories/add', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::patch('/categories/toggle-status/{id}', [CategoryController::class, 'toggleStatus'])->name('admin.categories.toggleStatus');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    // Gameplays
    Route::get('admin/gameplay', [GameplayController::class, 'index'])->name('admin.gameplay');
    Route::delete('admin/gameplay/{gameplay}', [CategoryController::class, 'destroy'])->name('admin.gameplay.delete');
});

// Response page
Route::get('message', function () {
    return view('response');
})->name('response');


// Google Auth
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Stripe
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe','stripe')->name('stripe.index');
    Route::get('stripe/checkout','stripeCheckout')->name('stripe.checkout');
    Route::get('stripe/checkout/success','stripeCheckoutSuccess')->name('stripe.checkout.success');
});

// Paypal
Route::controller(PayPalController::class)->group(function(){
    Route::get('paypal/checkout','checkout')->name('paypal.checkout');
    Route::get('paypal/success','success')->name('paypal.success');
    Route::get('paypal/cancel','cancel')->name('paypal.cancel');
});

require __DIR__ . '/auth.php';
