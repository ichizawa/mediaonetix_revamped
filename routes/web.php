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
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('events', [EventsController::class, 'index'])->name('events');
    Route::get('sales', [SalesController::class, 'index'])->name('sales');
    Route::get('staffs', [StaffsController::class, 'index'])->name('staffs');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
});