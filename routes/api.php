<?php

use App\Http\Controllers\CnpjController;
use App\Http\Controllers\FornecedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('fornecedor', FornecedorController::class);
Route::get('buscar-cnpj', [CnpjController::class, 'buscarCnpj']);
