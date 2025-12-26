<?php
use App\Http\Controllers\merchant\DashboardController;
use App\Http\Controllers\merchant\EventsController;
use App\Http\Controllers\merchant\MerchantController;
use App\Http\Controllers\merchant\SalesController;
use App\Http\Controllers\merchant\SettingsController;
use App\Http\Controllers\merchant\StaffsController;
use App\Http\Controllers\merchant\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('merchant')->name('merchant.')->middleware('role.check:2')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Events CRUD
    Route::get('events', [EventsController::class, 'index'])->name('events');
    Route::prefix('events')->name('events.')->group(function () {
        Route::post('store', [EventsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [EventsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [EventsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [EventsController::class, 'delete'])->name('delete');
    });
    //End Events CRUD

    //Sales CRUD
    Route::get('sales', [SalesController::class, 'index'])->name('sales');
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('store', [SalesController::class, 'store'])->name('store');
        Route::get('edit/{id}', [SalesController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [SalesController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [SalesController::class, 'delete'])->name('delete');
    });
    //End Sales CRUD

    //Staffs CRUD
    Route::get('staffs', [StaffsController::class, 'index'])->name('staffs');
    Route::prefix('staffs')->name('staffs.')->group(function () {
        Route::post('store', [StaffsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [StaffsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [StaffsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [StaffsController::class, 'delete'])->name('delete');
    });
    //End Staffs CRUD

    Route::get('profile', [MerchantController::class, 'profile'])->name('profile');
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('store', [MerchantController::class, 'store'])->name('store');
    });

    //Settings CRUD
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::prefix('settings')->name('settings.')->group(function () {

    });
});