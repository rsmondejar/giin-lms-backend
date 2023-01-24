<?php

use App\Http\Controllers\API\Auth\AuthenticatedSessionController;
use App\Http\Controllers\API\BusinessAPIController;
use App\Http\Controllers\API\GetHolidaysAPIController;
use App\Http\Controllers\API\GetProjectManagersAPIController;
use App\Http\Controllers\API\GetPublicHolidaysAPIController;
use App\Http\Controllers\API\GetReasonsAPIController;
use App\Http\Controllers\API\GetRequestHolidaysAPIController;
use App\Http\Controllers\API\GetUnplannedReasonsAPIController;
use App\Http\Controllers\API\HolidaySummaryAPIController;
use App\Http\Controllers\API\RequestHolidaysStoreAPIController;
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

    Route::get('holiday-summary', [HolidaySummaryAPIController::class, 'index']);
    Route::get('holidays', GetHolidaysAPIController::class);
    Route::get('unplanned-reasons', GetUnplannedReasonsAPIController::class);
    Route::get('reasons', GetReasonsAPIController::class);
    Route::get('public-holidays', GetPublicHolidaysAPIController::class);

    Route::group([
        'prefix' => 'managers',
        'as' => 'managers.',
    ], function () {
        Route::get('/', GetProjectManagersAPIController::class);
    });

    Route::group([
        'prefix' => 'request-holidays',
        'as' => 'request-holidays.',
    ], function () {
        Route::get('', GetRequestHolidaysAPIController::class)->name('index');
        Route::post('', RequestHolidaysStoreAPIController::class)->name('store');
    });
});
