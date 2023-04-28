<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/data', [UserController::class, 'data'])->name('users.data');
        Route::get('/edit/{id?}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/delete/{id?}', [UserController::class, 'delete'])->name('users.delete');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::post('/update', [UserController::class, 'update'])->name('users.update');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/data', [CategoryController::class, 'data'])->name('categories.data');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::post('/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/category-multi', [CategoryController::class, 'category_multi'])->name('categories.multi');
        Route::get('/category-multi-data', [CategoryController::class, 'category_multi_data'])->name('categories.multi.data');
    });

    Route::group(['prefix' => 'product', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/data', [ProductController::class, 'data'])->name('data');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update', [ProductController::class, 'update'])->name('update');
        Route::post('/create-image', [ProductController::class, 'store_image'])->name('store_image');
        Route::post('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'order', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/data', [OrderController::class, 'data'])->name('data');
    });

    
});
