<?php

use App\Http\Controllers\MachineController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('machine', MachineController::class);
});
