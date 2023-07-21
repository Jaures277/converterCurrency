<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("register", [\App\Http\Controllers\UserController::class,"register"]);
Route::post("login", [\App\Http\Controllers\UserController::class,"login"]);

Route::apiResource('currencies', \App\Http\Controllers\CurrencyController::class);
Route::apiResource('pairs', \App\Http\Controllers\PairController::class);

Route::get('test/{value}/{currency_from}/{currency_to}', [\App\Http\Controllers\PairController::class,"convert"]);

Route::middleware('auth:sanctum')->group(function (){
    Route::post("logout", [\App\Http\Controllers\UserController::class,'logout']);
});
Route::middleware('auth:sanctum')->group(function() {
    Route::post("logout", [\App\Http\Controllers\UserController::class, 'logout']);
});
