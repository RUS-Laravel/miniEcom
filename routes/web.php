<?php

use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [IndexController::class, 'index'])->name('web.index');

Route::get('/account', [LoginController::class, 'account'])->name('login.account');
Route::post('/account', [LoginController::class, 'client'])->name('login.client');
Route::get('/logout', [LoginController::class, 'signuout'])->middleware('auth:client')->name('client.logout');

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('auth.login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');
    Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('auth.logout');
});

Route::get('category/{id?}', [CategoryController::class, 'catalog'])->name('catalog.show');
Route::get('/product/{slug}_{id}', [ProductController::class, 'detail'])->name('product.detail');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('product/{rowId}', [CartController::class, 'show_product'])->name('cart.show.product');
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('cart-update/{rowId}', [CartController::class, 'update_cart'])->name('cart.update');
    Route::post('buy', [CartController::class, 'buy'])->name('cart.buy');
    Route::get('remove-item/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
});
