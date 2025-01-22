<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Teste de conexão
Route::get('/ping', function (Request $request) {
    return response()->json(['pong' => true]);
});