<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;

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

Route::get('/fornecedores', [FornecedorController::class, 'index']);
Route::get('/cnpj/{cnpj}', [FornecedorController::class, 'buscarCnpj']);
Route::post('/fornecedor', [FornecedorController::class, 'store']);
Route::put('/fornecedor/{id}', [FornecedorController::class, 'update']);
Route::delete('/fornecedor/{id}', [FornecedorController::class, 'destroy']);

