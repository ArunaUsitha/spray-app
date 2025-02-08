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
    public function store(MachineRequest $request): JsonResponse
    {
        return response()->json($this->machineService->storeMachine($request), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->machineService->showMachine($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'string',
            'model' => 'string',
            'brand' => 'string',
            'purchase_date' => 'date',
            'purchasing_price' => 'numeric',
        ]);
        return response()->json($this->machineService->editMachine($id, $validated));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(['deleted' => $this->machineService->removeMachine($id)]);
    }
}
