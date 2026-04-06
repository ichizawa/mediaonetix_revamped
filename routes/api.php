<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\TicketListsController;
use App\Http\Controllers\PublicController;
use \App\Http\Controllers\api\EventsController;
use App\Http\Controllers\api\ScannerController;
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
            Route::get('sales', [\App\Http\Controllers\api\SalesController::class, 'getSales']);
        });


        Route::prefix('staff')->group(function () {

            Route::get('events', [\App\Http\Controllers\PublicController::class, 'events']);
            Route::get('tickets', [TicketListsController::class, 'getTickets']);

            Route::prefix('scan')->group(function () {
                Route::get('/check-ticket/{refNumber}', [ScannerController::class, 'checkTicket']);
                Route::get('/ticket/{refNumber}', [ScannerController::class, 'scanTicket']);
            });
        });

        Route::prefix('users')->group(function () {
            Route::get('events', [EventsController::class, 'events']);
        });
    });
});
