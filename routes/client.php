<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:client')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');

    Route::group(['prefix' => 'order', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/data', [OrderController::class, 'data'])->name('data');
    });  
    
    Route::group(['prefix' => 'profile', 'as' => 'profiles.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/data', [ProfileController::class, 'data'])->name('data');
        Route::post('/create', [ProfileController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
    }); 
});
