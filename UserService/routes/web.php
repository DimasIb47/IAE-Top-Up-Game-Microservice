<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}/transactions', [UserController::class, 'getUserTransactions'])->name('users.transactions');