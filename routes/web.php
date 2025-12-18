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
        Route::get('events', [EventsController::class, 'index'])->name('events');
        Route::get('sales', [SalesController::class, 'index'])->name('sales');
        Route::get('staffs', [StaffsController::class, 'index'])->name('staffs');
        Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    });
});