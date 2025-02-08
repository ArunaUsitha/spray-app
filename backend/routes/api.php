<?php

use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineOperationController;
use App\Http\Controllers\MachineResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // User route (existing)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Machine CRUD routes
    Route::apiResource('machines', MachineController::class);

    // Machine Reset routes
    Route::apiResource('machines.resets', MachineResetController::class)->except(['update']);

    // Machine Operation routes
    Route::apiResource('machines.operations', MachineOperationController::class)->except(['update']);
});
