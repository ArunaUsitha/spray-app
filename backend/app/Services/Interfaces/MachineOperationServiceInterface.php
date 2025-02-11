<?php

namespace App\Services\Interfaces;

use App\Http\Requests\MachineOperationRequest;
use App\Http\Requests\MachineOperationsResetRequest;

interface MachineOperationServiceInterface
{
    /**
     * @param $machineId
     * @return mixed
     */
    public function getMachineOperations($machineId): mixed;

    /**
     * @param MachineOperationRequest $machineOperationRequest
     * @return mixed
     */
    public function addMachineOperation(MachineOperationRequest $machineOperationRequest): mixed;

    /**
     * @param MachineOperationsResetRequest $machineOperationsResetRequest
     * @return mixed
     */
    public function resetMachineOperations(MachineOperationsResetRequest $machineOperationsResetRequest): mixed;

}
