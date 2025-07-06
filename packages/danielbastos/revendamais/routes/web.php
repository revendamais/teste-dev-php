<?php

use Illuminate\Support\Facades\Route;

use danielbastos\revendamais\Http\Controllers\Api\SupplierController;
use danielbastos\revendamais\Http\Controllers\Api\CnpjController;

Route::group(['prefix' => 'revendamais'], function () {
    Route::apiResource('suppliers', SupplierController::class);
    Route::get('/cnpj/{cnpj}', [CnpjController::class, 'lookup']);
});