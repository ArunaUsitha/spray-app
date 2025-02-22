<?php

namespace App\Http\Controllers;

use App\Http\Requests\MachineRequest;
use App\Services\MachineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function __construct(
        private readonly MachineService $machineService
    )
    {
    }

    /**
     * Display all the machine records
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->machineService->listMachines());
    }

    /**
     * Create new Machine
     * @param MachineRequest $machineRequest
     * @return JsonResponse
     */
    public function store(MachineRequest $machineRequest): JsonResponse
    {
        return $this->machineService->storeMachine($machineRequest)
            ? $this->successResponse([], 'Machine created successfully.', 201)
            : $this->serverErrorResponse('Error Occurred');
    }

    /**
     * Display specific machine
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        return response()->json($this->machineService->showMachine($id));
    }

    /**
     * Update specific machine
     * @param MachineRequest $machineRequest
     * @param string $id
     * @return JsonResponse
     */
    public function update(MachineRequest $machineRequest, string $id): JsonResponse
    {
        return response()->json($this->machineService->editMachine($id,$machineRequest));
    }

    /**
     * Remove specific machine
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $machineId = $this->machineService->removeMachine($id);

        return $machineId
            ? $this->successResponse(['machine_id' => $machineId], 'Deleted')
            : $this->serverErrorResponse('Error Occurred');
    }
}
