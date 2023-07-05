<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {

            // Category
            Route::resource('category', CategoryController::class)->except('show')->withTrashed(['edit', 'update', 'destroy']);
            Route::match(['put', 'patch'], 'category/{category}/restore', [CategoryController::class, 'restore'])->withTrashed()->name('category.restore');
            Route::match(['put', 'patch'], 'category/{category}/soft-delete', [CategoryController::class, 'softDelete'])->name('category.soft-delete');
        });
    });
});
