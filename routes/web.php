<?php

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

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('auth.login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');
    Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});

Route::get('category/{id?}', [CategoryController::class, 'catalog'])->name('catalog.show');
Route::get('/product/{slug}_{id}', [ProductController::class, 'detail'])->name('product.detail');
