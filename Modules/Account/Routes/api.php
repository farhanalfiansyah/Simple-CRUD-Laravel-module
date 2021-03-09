<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\Http\Controllers;

Route::prefix('users')->group(function () {
    Route::get('/', [Controllers\AccountController::class, 'index']);
    Route::post('/', [Controllers\AccountController::class, 'store']);
    Route::get('/{id}', [Controllers\AccountController::class, 'show']);
    Route::put('/{id}', [Controllers\AccountController::class, 'update']);
    Route::delete('/{id}', [Controllers\AccountController::class, 'delete']);
});
