<?php

namespace App\Http\Controllers;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'model' => 'required|string',
            'brand' => 'required|string',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric',

        ]);
        return response()->json($this->machineService->storeMachine($validated), 201);
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
