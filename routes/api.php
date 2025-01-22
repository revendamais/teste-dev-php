<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Suppliers\Http\Controllers\SupplierController;
use App\BrasilApi\Http\Controllers\BrasilApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function (Request $request) {
    return response()->json(['pong' => true]);
});

Route::prefix('suppliers')->group(function () {
    Route::get('/', [SupplierController::class, 'index']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::get('/{id}', [SupplierController::class, 'show']);
    Route::put('/{id}', [SupplierController::class, 'update']);
    Route::delete('/{id}', [SupplierController::class, 'destroy']);
});

Route::get('/searchcnpj/{cnpj}', [BrasilApiController::class, 'searchCnpj']);


