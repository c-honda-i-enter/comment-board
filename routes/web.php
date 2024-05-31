<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\FavoritesController;

Route::get('/', [BoardsController::class, 'index']);

Route::get('/dashboard', [BoardsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('boards/{id}')->group(function() {
        Route::post('favorite', [FavoritesController::class, 'store'])->name('user.favorite');
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('user.unfavorite');
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');
    });
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);

    Route::resource('boards', BoardsController::class, ['only' => ['store', 'destroy']]);
    
    
});

require __DIR__.'/auth.php';
