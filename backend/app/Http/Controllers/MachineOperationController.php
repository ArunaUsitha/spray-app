<?php

namespace App\Http\Controllers;

use App\Http\Requests\MachineOperationRequest;
use App\Http\Requests\MachineOperationsResetRequest;
use App\Services\MachineOperationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MachineOperationController extends Controller
{
    public function __construct(
        private readonly MachineOperationService $machineOperationService
    ) {}

    public function index($machineId) {
        return response()->json($this->machineOperationService->getMachineOperations($machineId));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MachineOperationRequest $machineOperationRequest): JsonResponse
    {
        return response()->json($this->machineOperationService->addMachineOperation($machineOperationRequest), 201);
    }

    /**
     * Reset machine operation hours
     * @param MachineOperationsResetRequest $machineOperationsResetRequest
     * @return void
     */
    public function reset(MachineOperationsResetRequest $machineOperationsResetRequest): void
    {
        $this->machineOperationService->resetMachineOperations($machineOperationsResetRequest);
    }

}
