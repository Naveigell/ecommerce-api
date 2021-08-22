<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("/v1")->group(function () {
    Route::post("/auth/login", [\App\Http\Controllers\Api\Authentication\LoginController::class, 'login']);

    Route::get("/products/{take}/recommendation", [\App\Http\Controllers\Api\Products\ProductController::class, 'index']);
    Route::get("/products/{take}/detail", [\App\Http\Controllers\Api\Products\ProductController::class, 'detail']);

    Route::get("/shops/{slug}/detail", [\App\Http\Controllers\Api\Shops\ShopController::class, 'detail']);

    Route::middleware('auth:api')->group(function () {
        Route::put("/products/update", [\App\Http\Controllers\Api\Products\ProductController::class, 'update']);
        Route::post("/products/insert", [\App\Http\Controllers\Api\Products\ProductController::class, 'insert']);

        Route::prefix("/biodata")->group(function () {
            Route::get("/", [\App\Http\Controllers\Api\Biodata\BiodataController::class, 'index']);
            Route::put("/update", [\App\Http\Controllers\Api\Biodata\BiodataController::class, 'update']);
            Route::patch("/image", [\App\Http\Controllers\Api\Biodata\BiodataController::class, 'image']);
        });

        Route::prefix("/shops")->group(function () {
            Route::put("/update", [\App\Http\Controllers\Api\Shops\ShopController::class, 'update']);
            Route::patch("/image", [\App\Http\Controllers\Api\Shops\ShopController::class, 'image']);
        });
    });
});

