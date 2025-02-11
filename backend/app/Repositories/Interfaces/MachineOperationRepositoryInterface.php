<?php

namespace App\Repositories\Interfaces;

use App\Models\Machine;
use App\Models\MachineOperation;
use App\Models\User;

interface MachineOperationRepositoryInterface
{
    public function getOperationsByMachineId($machineId);
    public function addOperation(MachineOperation $machineOperation);

    public function resetMachineOperations(Machine $machine, User $user);

}
