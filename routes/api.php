<?php

use Illuminate\Support\Facades\Route;


Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [App\Http\Controllers\AuthController::class, 'user']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    Route::apiResource('reservations', App\Http\Controllers\ReservationController::class)->only([
        'index',
        'show',
    ]);

    Route::apiResources([
        'rooms' => App\Http\Controllers\RoomController::class,
        'customers' => App\Http\Controllers\CustomerController::class,
        'customer-types' => App\Http\Controllers\CustomerTypeController::class,
    ]);
});
