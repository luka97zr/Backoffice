<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::post('login',[AuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::apiResource('user', UserController::class);
});

