<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ControlPanelController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EventsController;
use App\Http\Controllers\admin\MerchantController;
use App\Http\Controllers\admin\PromoCodesController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\TicketsController;
use App\Http\Controllers\admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('role.check:1')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Events CRUD
    Route::get('events', [EventsController::class, 'index'])->name('events');
    Route::prefix('events')->name('events.')->group(function () {
        Route::post('store', [EventsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [EventsController::class, 'edit'])->name('edit');
        Route::put('update', [EventsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [EventsController::class, 'delete'])->name('delete');
        Route::post('set-active', [EventsController::class, 'setActive'])->name('set-active');
        Route::post('approve/{id}', [EventsController::class, 'approve'])->name('approve');
        Route::post('reject/{id}', [EventsController::class, 'reject'])->name('reject');

        Route::prefix('{slug}/tickets')->name('tickets.')->group(function () {
            Route::get('/', [TicketsController::class, 'index'])->name('tickets');
            Route::post('/', [TicketsController::class, 'store'])->name('store');
            Route::delete('{ticket}', [TicketsController::class, 'destroy'])->name('destroy');
        });
    });
    //End Events CRUD

    //Sales CRUD
    Route::get('sales', [SalesController::class, 'index'])->name('sales');
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::post('store', [SalesController::class, 'store'])->name('store');
        Route::get('edit/{slug}', [SalesController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [SalesController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [SalesController::class, 'delete'])->name('delete');
        Route::get('export/pdf', [SalesController::class, 'exportPdf'])->name('export.pdf');
        Route::get('export/excel', [SalesController::class, 'exportExcel'])->name('export.excel');
    });
    //End Sales CRUD

    Route::prefix('promo_codes')->name('promo_codes.')->group(function () {
        Route::get('/', [PromoCodesController::class, 'index'])->name('index');
        Route::post('store', [PromoCodesController::class, 'store'])->name('store');
    });

    Route::get('merchants', [MerchantController::class, 'index'])->name('merchants');
    Route::prefix('merchants')->name('merchants.')->group(function () {
        Route::post('store', [MerchantController::class, 'store'])->name('store');
        Route::get('files/{id}', [MerchantController::class, 'files'])->name('files');
        Route::put('update/{id}', [MerchantController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [MerchantController::class, 'destroy'])->name('delete');
    });

    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::prefix('users')->name('users.')->group(function () {
        Route::post('store', [UsersController::class, 'store'])->name('store');
        Route::delete('delete/{id}', [UsersController::class, 'destroy'])->name('delete');
        Route::put('update/{id}', [UsersController::class, 'update'])->name('update');
    });

    Route::get('control-panel', [ControlPanelController::class, 'index'])->name('control-panel');
    Route::prefix('control-panel')->name('control-panel.')->group(function () {
        Route::post('control', [ControlPanelController::class, 'control'])->name('control');
        Route::post('quick-action', [ControlPanelController::class, 'quickAction'])->name('quick-action');
        Route::post('save-comming-soon', [ControlPanelController::class, 'update_coming_soon'])->name('update.coming.soon');
    });

    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('store', [AdminController::class, 'store'])->name('store');
    });

    //Settings CRUD
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::post('store', [SettingsController::class, 'store'])->name('store');
    });
});
