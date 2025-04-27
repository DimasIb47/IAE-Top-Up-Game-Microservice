<?php
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
Route::get('/', [TransactionController::class, 'create'])->name('home');

Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');