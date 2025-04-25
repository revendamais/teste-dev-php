<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\UserAuthController;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('fornecedor', FornecedorController::class)->names('fornecedor');
    Route::get('fornecedores/cnpj/{cnpj}', [FornecedorController::class, 'buscarPorCnpj']);
    Route::post('/logout', [UserAuthController::class,'logout']);
});



