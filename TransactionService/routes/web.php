<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [TransactionController::class, 'create'])->name('home');

// Create transaction
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');

// Store transaction
Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');

// Success page
Route::get('/transactions/success', [TransactionController::class, 'success'])->name('transactions.success');

// History Transaction
Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');
