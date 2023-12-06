<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);


Route::apiResource('/CarBrands', \App\Http\Controllers\CarBrandController::class)->only(
    'index', 'show'
);

Route::apiResource('/CarModels', \App\Http\Controllers\CarModelController::class)->only(
    'index', 'show'
);
