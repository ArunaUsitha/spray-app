<?php

use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineOperationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    // Machine
    Route::apiResource('machine', MachineController::class);

    // Machine Operations
    Route::post('machine/operation', [MachineOperationController::class, 'store']);
    Route::get('machine/operations/{machineId}', [MachineOperationController::class, 'index']);
    Route::post('machine/operations/reset', [MachineOperationController::class, 'reset']);
});
