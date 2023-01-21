<?php

use App\Http\Controllers\API\Auth\AuthenticatedSessionController;
use App\Http\Controllers\API\BusinessAPIController;
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

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthenticatedSessionController::class, 'user']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('businesses', BusinessAPIController::class)
        ->except(['create', 'edit', 'destroy']);
});
