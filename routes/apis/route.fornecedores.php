<?php

use App\Http\Controllers\Api\V1\FornecedoresController;
use Illuminate\Support\Facades\Route;

Route::controller(FornecedoresController::class)->prefix("fornecedores")
    ->group(function() {
        Route::get("/", "index");
        Route::post("/", "store");
        Route::get("/{id}", "show");
        Route::delete("/{id}", "delete");
        Route::put("/", "update");
});