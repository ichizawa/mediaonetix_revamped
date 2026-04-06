<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\EventsController;
use App\Http\Controllers\admin\TicketsController;
use App\Http\Controllers\PurchaseHistoryController;

Route::prefix('user')->name('user.')->middleware('role.check:4')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('sales', [SalesController::class, 'index'])->name('sales');
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::post('store', [SalesController::class, 'store'])->name('store');
        Route::get('edit/{slug}', [SalesController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [SalesController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [SalesController::class, 'delete'])->name('delete');
    });


    Route::get('purchase-history', [PurchaseHistoryController::class, 'index'])->name('purchase-history');
});
