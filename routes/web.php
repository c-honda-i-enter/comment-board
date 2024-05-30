<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\BoardsController;

Route::get('/', [BoardsController::class, 'index']);

Route::get('/dashboard', [BoardsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);

    Route::resource('boards', BoardsController::class, ['only' => ['store', 'destroy']]);
});

require __DIR__.'/auth.php';
