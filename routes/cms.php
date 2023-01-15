<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PublicHolidaysController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamHolidayController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController;

/*
|--------------------------------------------------------------------------
| CMS Backend Routes
|--------------------------------------------------------------------------
|
*/

# region Generator Builder
Route::group([
    'prefix' => 'generator_builder',
    'middleware' => 'role:super-admin', // NOSONAR
], function () {
    Route::get('', [GeneratorBuilderController::class, 'builder'])
        ->name('io_generator_builder');

    Route::post('generate', [GeneratorBuilderController::class, 'generate'])
        ->name('io_generator_builder_generate');

    Route::post('rollback', [GeneratorBuilderController::class, 'rollback'])
        ->name('io_generator_builder_rollback');

    Route::post(
        'generate-from-file',
        [GeneratorBuilderController::class, 'generateFromFile']
    )->name('io_generator_builder_generate_from_file');
});

Route::get('field_template', [GeneratorBuilderController::class, 'fieldTemplate'])
    ->name('io_field_template');

Route::get('relation_field_template', [GeneratorBuilderController::class, 'relationFieldTemplate'])
    ->name('io_relation_field_template');
#endregion

Route::resource('audit', AuditController::class)->only(['index','show', 'destroy'])->middleware('role:super-admin'); // NOSONAR

Route::resource('roles', RoleController::class)->middleware('role:super-admin');
Route::resource('permissions', PermissionController::class)->middleware('role:super-admin');

Route::resource('businesses', App\Http\Controllers\BusinessController::class)->middleware('role:super-admin|hr'); // NOSONAR
Route::resource('departments', DepartmentController::class)->middleware('role:super-admin|hr'); // NOSONAR
Route::resource('users', UserController::class)->middleware('role:super-admin|hr|managers'); // NOSONAR
Route::resource('public-holidays', PublicHolidaysController::class)->middleware('role:super-admin|hr|managers|users'); // NOSONAR
Route::resource('leaves', LeaveController::class)->only(['store','destroy']);

Route::group([
    'prefix' => 'team-holidays',
    'as' => 'team-holidays.',
    'middleware' => ['permission:list users']
], function () {
    Route::get('', [TeamHolidayController::class, 'index'])->name('index');
    Route::put('{id}/approve', [TeamHolidayController::class, 'approve'])->name('approve');
    Route::put('{id}/reject', [TeamHolidayController::class, 'reject'])->name('reject');
});
