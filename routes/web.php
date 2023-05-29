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

Route::get('category', [CategoryController::class, 'category'])->name('category.show');
Route::get('catalog/{id}', [CategoryController::class, 'catalog'])->name('catalog.show');
Route::get('/product/{slug}_{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::post('product/sizes', [ProductController::class, 'sizes'])->name('product.sizes');
Route::post('product/rating', [ProductController::class, 'review_rating'])->name('product.rating');
Route::get('product/add-wishlist/{id}', [ProductController::class, 'wishlist_add'])->name('product.add_wishlist');
Route::get('product/wishlist', [ProductController::class, 'wishList'])->name('wishList.show');
Route::get('product/{tag}', [ProductController::class, 'tag'])->name('product.tag');
//Route::get('product/newsletter', [ProductController::class, 'newsletter'])->name('product.newsletter');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('product/{rowId}', [CartController::class, 'show_product'])->name('cart.show.product');
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('cart-update', [CartController::class, 'update_cart'])->name('cart.update');
    Route::post('buy', [CartController::class, 'buy'])->name('cart.buy');
    Route::get('remove-item/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
});
