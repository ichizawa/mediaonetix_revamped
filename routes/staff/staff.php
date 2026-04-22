<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\EventsController;
use App\Http\Controllers\admin\TicketsController;

Route::prefix('staff')->name('staff.')->middleware('role.check:3')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('sales', [SalesController::class, 'index'])->name('sales');
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::post('store', [SalesController::class, 'store'])->name('store');
        Route::get('edit/{slug}', [SalesController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [SalesController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [SalesController::class, 'delete'])->name('delete');
    });


    Route::get('events', [EventsController::class, 'index'])->name('events');
    Route::prefix('events')->name('events.')->group(function () {
        Route::post('store', [EventsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [EventsController::class, 'edit'])->name('edit');
        Route::put('update', [EventsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [EventsController::class, 'delete'])->name('delete');
        Route::post('set-active', [EventsController::class, 'setActive'])->name('set-active');

        Route::prefix('{slug}/tickets')->name('tickets.')->group(function () {
            Route::get('/', [TicketsController::class, 'index'])->name('tickets');
            Route::post('/', [TicketsController::class, 'store'])->name('store');
            Route::delete('{ticket}', [TicketsController::class, 'destroy'])->name('destroy');
        });
    });

    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('store', [AdminController::class, 'store'])->name('store');
        Route::post('update', [AdminController::class, 'update'])->name('update');
    });
});
