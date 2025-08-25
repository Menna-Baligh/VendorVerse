<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;



Route::middleware('auth')->prefix('dashboard')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::resource('categories',CategoryController::class);
    });

