<?php

use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\TransactionController;

Route::apiResource('clients', ClientController::class);

Route::prefix('clients/{client}')->group(function () {
    Route::apiResource('transactions', TransactionController::class)->only(['index', 'store']);
    Route::get('transactions/total', [TransactionController::class, 'total']);
});