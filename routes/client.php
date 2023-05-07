<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:client')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');

    Route::group(['prefix' => 'order', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/data', [OrderController::class, 'data'])->name('data');
    });    
});
