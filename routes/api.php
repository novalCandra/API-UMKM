<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderBarangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, "login"]);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, "logout"]);
    });
});

Route::prefix('manage')->group(function () {
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::get('/', [UserController::class, "index"]);
        Route::get('/{id}', [UserController::class, "show"]);
        Route::post('/', [UserController::class, "store"]);
        Route::put('/{id}', [UserController::class, "update"]);
        Route::delete('/{id}', [UserController::class, "destory"]);
    });
});

Route::prefix('categories')->group(function () {
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::get('/', [CategoryController::class, "index"]);
        Route::get('/{id}', [CategoryController::class, "show"]);
        Route::post('/', [CategoryController::class, "store"]);
        Route::put('/{id}', [CategoryController::class, "update"]);
        Route::delete('/{id}', [CategoryController::class, "destroy"]);
    });
});


Route::prefix('barang')->group(function () {
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::get('/', [BarangController::class, "index"]);
        Route::post('/', [BarangController::class, "store"]);
        Route::get('/{id}', [BarangController::class, "show"]);
        Route::put('/{id}', [BarangController::class, "update"]);
        Route::delete('/{id}', [BarangController::class, "destroy"]);
    });
});

Route::prefix('order')->group(function () {
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::get('/', [OrderController::class, "index"]);
        Route::get('/{id}', [OrderController::class, "show"]);
        Route::delete('/{id}', [OrderController::class, "destory"]);
    });

    Route::middleware(['auth:sanctum', 'role:pembeli'])->group(function () {
        Route::post('/', [OrderBarangController::class, "store"]);
    });
});

Route::prefix('inventory')->group(function () {
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::get('/', [InventoryController::class, "index"]);
        Route::get('/{id}', [InventoryController::class, "show"]);
        Route::post('/', [InventoryController::class, "store"]);
        Route::put('/{id}', [InventoryController::class, "update"]);
        Route::delete('/{id}', [InventoryController::class, "destroy"]);
    });
});
