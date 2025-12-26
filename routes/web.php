<?php

// use App\Http\Controllers\admin\AdminController;
// use App\Http\Controllers\admin\DashboardController;
// use App\Http\Controllers\admin\EventsController;
// use App\Http\Controllers\admin\MerchantController;
// use App\Http\Controllers\admin\SalesController;
// use App\Http\Controllers\admin\SettingsController;
// use App\Http\Controllers\admin\StaffsController;
// use App\Http\Controllers\admin\UsersController;
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

    require base_path('routes/admin/admin.php');
});