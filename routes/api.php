<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentTypeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::apiResource('user', UserController::class);
    Route::post('profile', [ProfileController::class, 'update']);
    Route::apiResource('role', RoleController::class);
    Route::get('authUser', [AuthController::class, 'getUser']);
    Route::get('logout',[AuthController::class, 'logout']);
    Route::apiResource('contentType', ContentTypeController::class);

});

