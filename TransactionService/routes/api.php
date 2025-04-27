<?php
use App\Http\Controllers\TransactionController;

Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{id}', [TransactionController::class, 'show']);
Route::put('/transactions/{id}/status', [TransactionController::class, 'updateStatus']);
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');


