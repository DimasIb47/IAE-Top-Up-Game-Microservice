<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/', [GameController::class, 'index'])->name('games.index');
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{id}/transactions', [GameController::class, 'getGameTransactions'])->name('games.transactions');
