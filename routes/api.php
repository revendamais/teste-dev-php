<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Redis;

Route::prefix('v1')
    ->controller(SuppliersController::class)
    ->group(function () {
    Route::get('/suppliers', 'index')->name('suppliers.index');
    Route::post('/suppliers', 'store')->name('suppliers.store');
    Route::put('/suppliers/{id}', 'update')->name('suppliers.update');
    Route::get('/suppliers/{id}', 'show')->name('suppliers.show');
    Route::delete('/suppliers/{id}', 'destroy')->name('suppliers.destroy');
});
