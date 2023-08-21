<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ConcertController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\UserController;
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
    
    Route::post('/login', [AuthController::class, 'login']);
    // Route::apiResource('users', UserController::class);
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [UserController::class, 'index'])->middleware(['auth:sanctum', 'ability:getUsers']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::patch('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
    Route::apiResource('concerts', ConcertController::class);// if all http verb will be use
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('bookings', BookingController::class);
});
