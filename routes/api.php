<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;

Route::prefix('v1')
    ->controller(SuppliersController::class)
    ->group(function () {
    Route::get('/suppliers', 'index')->name('suppliers.index');
});
