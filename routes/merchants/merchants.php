<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ControlPanelController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EventsController;
use App\Http\Controllers\admin\MerchantController;
use App\Http\Controllers\admin\PromoCodesController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\StaffsController;
use App\Http\Controllers\admin\TicketsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Route;

Route::prefix('merchant')->name('merchant.')->middleware('role.check:2')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('payment/success', [SalesController::class, 'paymentSuccess'])->name('paymongo.return');

    //Events CRUD
    Route::get('events', [EventsController::class, 'index'])->name('events');
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('approval/{id}', [EventsController::class, 'approvalPage'])->name('approval');
        Route::post('approval/{id}/documents', [EventsController::class, 'uploadApprovalDocuments'])->name('approval.documents.store');
        Route::post('approval/{id}/documents/update', [EventsController::class, 'updateApprovalDocuments'])->name('approval.documents.update');
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

    // Route::get('merchants', [MerchantController::class, 'index'])->name('merchants');
    Route::prefix('merchants')->name('merchants.')->group(function () {
        Route::get('/', [MerchantController::class, 'index'])->name('merchant');
        Route::post('store', [MerchantController::class, 'store'])->name('store');
        Route::get('files/{id}', [MerchantController::class, 'files'])->name('files');
    });

    // Route::prefix('staffs')->name('staffs.')->group(function () {
    //     Route::get('/', [StaffsController::class, 'index'])->name('staffs');
    //     Route::post('store', [StaffsController::class, 'store'])->name('store');
    // });

    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::prefix('users')->name('users.')->group(function () {
        Route::post('store', [UsersController::class, 'store'])->name('store');
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
        Route::post('update', [AdminController::class, 'update'])->name('update');
    });

    //Settings CRUD
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::post('store', [SettingsController::class, 'store'])->name('store');
    });

    Route::get('organizers', [OrganizerController::class, 'index'])->name('organizers');
    Route::prefix('organizers')->name('organizers.')->group(function () {

        Route::post('store', [OrganizerController::class, 'store'])->name('store');
        Route::delete('delete/{id}', [OrganizerController::class, 'destroy'])->name('delete');
        Route::put('update/{id}', [OrganizerController::class, 'update'])->name('update');
    });
});
