<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// PASTIKAN NAMA IMPORT SESUAI DENGAN NAMA FILE CONTROLLER-NYA
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;

// 1. Route Login untuk dapat Token
Route::post('/login', [AuthController::class, 'getToken']);

// 2. Route PUBLIC (Bisa diakses tanpa Bearer Token)
Route::get('/product', [ProductApiController::class, 'index']); 
Route::get('/product/{id}', [ProductApiController::class, 'show']); 

Route::get('/category', [CategoryApiController::class, 'index']);
Route::get('/category/{id}', [CategoryApiController::class, 'show']);

// 3. Route PROTECTED (WAJIB pakai Bearer Token di Header)
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // --- API PRODUCT (TUGAS) ---
    Route::post('/product', [ProductApiController::class, 'store']); 
    Route::put('/product/{id}', [ProductApiController::class, 'update']); 
    Route::delete('/product/{id}', [ProductApiController::class, 'destroy']); 

    // --- API CATEGORY (TUGAS) ---
    Route::post('/category', [CategoryApiController::class, 'store']);
    Route::put('/category/{id}', [CategoryApiController::class, 'update']);
    Route::delete('/category/{id}', [CategoryApiController::class, 'destroy']);

});