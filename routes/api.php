<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\ProductCategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\TableController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('verify-otp', [AuthController::class, 'verifyOTP']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('user-profile', [AuthController::class, 'user']);
            Route::post('change-password', [AuthController::class, 'changePassword']);
        });
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);

        Route::post('send-password-reset-token', [AuthController::class, 'sendPasswordResetToken'])->name('sendPasswordResetToken');
        Route::post('verify-password-reset-token', [AuthController::class, 'verifyPasswordResetToken'])->name('verifyPasswordResetToken');

    });

    Route::get('products', ProductController::class)->middleware('auth:sanctum');
    Route::get('product-categories', ProductCategoryController::class)->middleware('auth:sanctum');
    Route::get('tables', TableController::class)->middleware('auth:sanctum');
    Route::post('product/{id}/order', OrderController::class)->middleware('auth:sanctum');
    Route::post('order/{id}/payment', PaymentController::class)->middleware('auth:sanctum');
});
