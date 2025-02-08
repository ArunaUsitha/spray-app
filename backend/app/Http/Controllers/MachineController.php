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
    ) {}

    /**
     * Display all the machine records
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->machineService->listMachines()
        );
    }

    /**
     * Create new Machine
     */
    public function store(MachineRequest $machineRequest): JsonResponse
    {
        return response()->json($this->machineService->storeMachine($machineRequest), 201);
    }

    /**
     * Display specific machine
     */
    public function show(string $id): JsonResponse
    {
        return response()->json($this->machineService->showMachine($id));
    }

    /**
     * Update specific machine
     */
    public function update(MachineRequest $machineRequest, string $id): JsonResponse
    {
        return response()->json($this->machineService->editMachine($id,$machineRequest));
    }

    /**
     * Remove specific machine
     */
    public function destroy(string $id): JsonResponse
    {
        return response()->json(['deleted' => $this->machineService->removeMachine($id)]);
    }
}
