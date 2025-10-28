<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CATEGORY ROUTES
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// ASSET ROUTES
Route::prefix('assets')->group(function () {
    Route::get('/', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('/store', [AssetController::class, 'store'])->name('assets.store');
    Route::get('/{id}', [AssetController::class, 'show'])->name('assets.show');
    Route::get('/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
    Route::put('/{id}', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/{id}', [AssetController::class, 'destroy'])->name('assets.destroy');
});

// TRANSACTION ROUTES
Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/store', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});
