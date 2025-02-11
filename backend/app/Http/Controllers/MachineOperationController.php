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


    /**
     * Returns machine and their operation records
     * @param $machineId
     * @return JsonResponse
     */
    public function index($machineId)
    {
        return response()->json($this->machineOperationService->getMachineOperations($machineId));
    }

    /**
     * Create new machine operations
     * @param MachineOperationRequest $machineOperationRequest
     * @return JsonResponse
     */
    public function store(MachineOperationRequest $machineOperationRequest): JsonResponse
    {
        return $this->machineOperationService->addMachineOperation($machineOperationRequest)
            ? $this->successResponse([], 'Machine hours recorded success.', 201)
            : $this->serverErrorResponse();
    }

    /**
     * Reset machine operation hours
     * @param MachineOperationsResetRequest $machineOperationsResetRequest
     * @return JsonResponse
     */
    public function reset(MachineOperationsResetRequest $machineOperationsResetRequest)
    {
        return $this->machineOperationService->resetMachineOperations($machineOperationsResetRequest)
            ? $this->successResponse([], 'Machine hours reset success.')
            : $this->serverErrorResponse();
    }

}
