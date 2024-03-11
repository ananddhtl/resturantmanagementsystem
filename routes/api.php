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
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('send-password-reset-token', [AuthController::class, 'sendPasswordResetToken'])->name('sendPasswordResetToken');
        Route::post('verify-password-reset-token', [AuthController::class, 'verifyPasswordResetToken'])->name('verifyPasswordResetToken');
        Route::post('change-password', [AuthController::class, 'changePassword'])->name('changePassword');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
        Route::get('user', [AuthController::class, 'user'])->name('user')->middleware('auth:sanctum');
    });

    Route::get('products', ProductController::class)->middleware('auth:sanctum');
    Route::get('product-categories', ProductCategoryController::class)->middleware('auth:sanctum');
    Route::get('tables', TableController::class)->middleware('auth:sanctum');
    Route::post('product/{id}/order', OrderController::class)->middleware('auth:sanctum');
    Route::post('order/{id}/payment', PaymentController::class)->middleware('auth:sanctum');
});
