<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EventsController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\StaffsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PublicController::class, 'index'])->name('public');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'post'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->middleware('role.check:1')->group(function () {
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

        //Settings CRUD
        Route::get('settings', [SettingsController::class, 'index'])->name('settings');
        Route::prefix('settings')->name('settings.')->group(function () {

        });
    });
});