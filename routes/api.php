<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ConcertController;
use App\Http\Controllers\Api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {

    Route::apiResource('concerts', ConcertController::class);// if all http verb will be use
    Route::apiResource('customers', CustomerController::class);// if all http verb will be use
    Route::apiResource('bookings', BookingController::class);
});
