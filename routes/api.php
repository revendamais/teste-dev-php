<?php

use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/suppliers', function () {
        $suppliers = Supplier::all();
        return response()->json(['data' => $suppliers]);
    })->name('suppliers.index');
});
