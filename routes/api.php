<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\TicketListsController;
use App\Http\Controllers\PublicController;
use \App\Http\Controllers\api\EventsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => ['json.response']], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::middleware('auth:api')->group(function () {

        // Route::prefix('staff')->group(function () {
        //     // Define staff-related routes here
        // });

        

        Route::prefix('admin')->group(function () {
            
            Route::get('events', [\App\Http\Controllers\PublicController::class, 'events']);
            Route::get('tickets', [TicketListsController::class, 'getTickets']);
        });

        Route::prefix('merchant')->group(function () {
            
            Route::get('events', [EventsController::class, 'events']);
            Route::get('tickets', [TicketListsController::class, 'getTickets']);
        });

        
        Route::prefix('staff')->group(function () {
            
            Route::get('events', [\App\Http\Controllers\PublicController::class, 'index']);
            Route::get('tickets', [TicketListsController::class, 'getTickets']);
        });


    });
});
