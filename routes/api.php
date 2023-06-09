<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'post']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [UserController::class, 'data']);
    Route::post('/add', [UserController::class, 'insert']);
    Route::get('/edit/{id}', [UserController::class, 'edit']);
    Route::put('/update', [UserController::class, 'update']);
    Route::get('/delete', [UserController::class, 'delete']);
});
