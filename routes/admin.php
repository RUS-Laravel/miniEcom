<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserInformationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\ProductSizeController;
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


        Route::group(['prefix' => 'informations'], function () {
            Route::post('/create', [UserInformationController::class, 'store'])->name('users.informations.store');
            Route::get('/detail/{id}', [UserInformationController::class, 'detail'])->name('users.informations.detail');
        });
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
        Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');
        Route::post('/select_sizes', [ProductController::class, 'sizes'])->name('select.sizes');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/data', [ProductController::class, 'data'])->name('data');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update', [ProductController::class, 'update'])->name('update');
        //Route::get('/productId', [ProductController::class, 'productId'])->name('productId.image');
        Route::post('/create-image', [ProductController::class, 'store_image'])->name('store.image');
       
        Route::get('/delete-image/{id}', [ProductController::class, 'delete_image'])->name('delete.image');
        Route::post('/delete/{id}', [ProductController::class, 'delete'])->name('delete');


        Route::group(['prefix' => 'color', 'as' => 'colors.'], function () {
            Route::get('/', [ProductColorController::class, 'index'])->name('index');
            Route::get('/data', [ProductColorController::class, 'data'])->name('data');
            Route::get('/create', [ProductColorController::class, 'create'])->name('create');
            Route::post('/create', [ProductColorController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductColorController::class, 'edit'])->name('edit');
            Route::post('/update', [ProductColorController::class, 'update'])->name('update');
            Route::post('/delete/{id}', [ProductColorController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'size', 'as' => 'sizes.'], function () {
            Route::get('/', [ProductSizeController::class, 'index'])->name('index');
            Route::get('/data', [ProductSizeController::class, 'data'])->name('data');
            Route::get('/create', [ProductSizeController::class, 'create'])->name('create');
            Route::post('/create', [ProductSizeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductSizeController::class, 'edit'])->name('edit');
            Route::post('/update', [ProductSizeController::class, 'update'])->name('update');
            Route::post('/delete/{id}', [ProductSizeController::class, 'delete'])->name('delete');
        });
    });

    Route::group(['prefix' => 'color', 'as' => 'colors.'], function () {
        Route::get('/', [ColorController::class, 'index'])->name('index');
        Route::get('/data', [ColorController::class, 'data'])->name('data');
        Route::get('/create', [ColorController::class, 'create'])->name('create');
        Route::post('/create', [ColorController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ColorController::class, 'edit'])->name('edit');
        Route::post('/update', [ColorController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [ColorController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'order', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/data', [OrderController::class, 'data'])->name('data');
        Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
    });

    

    Route::group(['prefix' => 'size', 'as' => 'sizes.'], function () {
        Route::get('/', [SizeController::class, 'index'])->name('index');
        Route::get('/data', [SizeController::class, 'data'])->name('data');
        Route::get('/create', [SizeController::class, 'create'])->name('create');
        Route::post('/create', [SizeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SizeController::class, 'edit'])->name('edit');
        Route::post('/update', [SizeController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [SizeController::class, 'delete'])->name('delete');
    });

    
});
