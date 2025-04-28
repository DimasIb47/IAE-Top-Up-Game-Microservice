<?php
use App\Http\Controllers\GameController;

Route::get('/games', [GameController::class, 'apiindex']);
Route::get('/games/{id}', [GameController::class, 'show']);
Route::post('/games', [GameController::class, 'store']);

Route::get('/games/{id}/transactions', [GameController::class, 'getGameTransactionsAPI']);