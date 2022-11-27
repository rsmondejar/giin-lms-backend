<?php

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

Route::resource('businesses', App\Http\Controllers\BusinessController::class);

Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('permissions', App\Http\Controllers\PermissionController::class);
