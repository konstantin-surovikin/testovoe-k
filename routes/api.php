<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\MockPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// TODO Mocks
Route::get('/mock-payment', [MockPaymentController::class, 'mockPay'])->name('mock-payment');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);

Route::middleware('auth:sanctum')->group(static function () {
    Route::post('/payment/check', [PaymentController::class, 'check'])
        ->name('payment.check');

    Route::get('/products/{id}', [ProductController::class, 'getOne']);
    Route::get('/products', [ProductController::class, 'getAll']);

    Route::get('/bucket', [BucketController::class, 'getBucket']);
    Route::put('/bucket/add', [BucketController::class, 'addProduct']);
    Route::delete('/bucket/remove/{product_id}', [BucketController::class, 'removeProduct']);
    Route::post('/bucket/pay', [BucketController::class, 'pay']);

    Route::get('/orders/{id}', [OrderController::class, 'getOne']);
    Route::get('/orders', [OrderController::class, 'getAll']);
});
