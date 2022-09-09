<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('login',[AuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {

    Route::get('test', function() {
        return 'test';
    });
});

