<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::post('/login', [AuthController::class, 'getToken']);

Route::middleware('auth:sanctum')->group(function () {

    // CATEGORY
    Route::get('/category', [CategoryApiController::class, 'index']);
    Route::post('/category', [CategoryApiController::class, 'store']);
    Route::get('/category/{id}', [CategoryApiController::class, 'show']);
    Route::put('/category/{id}', [CategoryApiController::class, 'update']);
    Route::delete('/category/{id}', [CategoryApiController::class, 'destroy']);

    // PRODUCT
    Route::post('/product', [ProductApiController::class, 'store']);
    Route::put('/product/{id}', [ProductApiController::class, 'update']);
    Route::delete('/product/{id}', [ProductApiController::class, 'destroy']);

});

// PRODUCT PUBLIC
Route::get('/product', [ProductApiController::class, 'index']);
Route::get('/product/{id}', [ProductApiController::class, 'show']);