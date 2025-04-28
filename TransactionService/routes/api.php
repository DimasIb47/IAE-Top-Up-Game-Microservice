<?php
use App\Http\Controllers\TransactionController;

Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{id}', [TransactionController::class, 'show']);
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');

// Untuk UserService (history transaksi user)
Route::get('/transactions/user/{user_id}', [TransactionController::class, 'getUserTransactions']);
// Untuk GameService (statistik game)
Route::get('/transactions/game/{game_id}', [TransactionController::class, 'getGameTransactions']);


