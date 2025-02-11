<?php

namespace App\Services\Interfaces;

use App\Http\Requests\MachineOperationRequest;
use App\Http\Requests\MachineOperationsResetRequest;

interface MachineOperationServiceInterface
{
    public function getMachineOperations($machineId);

    public function addMachineOperation(MachineOperationRequest $machineOperationRequest);

    public function resetMachineOperations(MachineOperationsResetRequest $machineOperationsResetRequest);

}
