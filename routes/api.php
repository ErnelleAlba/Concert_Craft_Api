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
    //users
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [UserController::class, 'index'])->middleware(['auth:sanctum', 'ability:getUsers']);
        Route::get('/{id}', [UserController::class, 'show'])->middleware(['auth:sanctum', 'ability:getUsersById']);
        Route::post('/', [UserController::class, 'store']);
        Route::patch('/{id}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'ability:editUser']);
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware(['auth:sanctum', 'ability:deleteUser']);
    });
    //Concerts
    Route::group(['prefix' => 'concerts'], function() {
        Route::get('/', [ConcertController::class, 'index']);
        Route::get('/{id}', [ConcertController::class, 'show']);
        Route::post('/', [ConcertController::class, 'store'])->middleware(['auth:sanctum', 'ability:createConcert']);
        Route::patch('/{id}', [ConcertController::class, 'update'])->middleware(['auth:sanctum', 'ability:editConcert']);
        Route::delete('/{id}', [ConcertController::class, 'destroy'])->middleware(['auth:sanctum', 'ability:deleteConcert']);
    });
    // Route::apiResource('concerts', ConcertController::class);
    // Route::apiResource('customers', CustomerController::class);// if all http verb will be use
    //Bookings
    Route::group(['prefix' => 'bookings'], function() {
        Route::get('/', [BookingController::class, 'index'])->middleware(['auth:sanctum', 'ability:getBooking']);
        Route::get('/{id}', [BookingController::class, 'show'])->middleware(['auth:sanctum', 'ability:getBookingById']);
        Route::post('/', [BookingController::class, 'store'])->middleware(['auth:sanctum', 'ability:createBooking']);
        Route::patch('/{id}', [BookingController::class, 'update'])->middleware(['auth:sanctum', 'ability:editBooking']);
        Route::delete('/{id}', [BookingController::class, 'destroy'])->middleware(['auth:sanctum', 'ability:deleteBooking']);
    });
    // Route::apiResource('bookings', BookingController::class);
});
