<?php

namespace App\Repositories\Interfaces;

use App\Models\Machine;
use App\Models\MachineOperation;
use App\Models\User;

interface MachineOperationRepositoryInterface
{
    /**
     * @param $machineId
     * @return mixed
     */
    public function getOperationsByMachineId($machineId): mixed;

    /**
     * @param MachineOperation $machineOperation
     * @return mixed
     */
    public function addOperation(MachineOperation $machineOperation): mixed;

    /**
     * @param Machine $machine
     * @param User $user
     * @return mixed
     */
    public function resetMachineOperations(Machine $machine, User $user): mixed;

}
