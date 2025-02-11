<?php

namespace App\Services;

use App\Http\Requests\MachineOperationRequest;
use App\Http\Requests\MachineOperationsResetRequest;
use App\Models\Machine;
use App\Models\MachineOperation;
use App\Models\User;
use App\Repositories\Interfaces\MachineOperationRepositoryInterface;
use App\Services\Interfaces\MachineOperationServiceInterface;

class MachineOperationService implements MachineOperationServiceInterface
{
    public function __construct(
        protected MachineOperationRepositoryInterface $machineOperationRepository
    ) {}

    public function getMachineOperations($machineId): mixed
    {
        return $this->machineOperationRepository->getOperationsByMachineId($machineId);
    }

    public function addMachineOperation(MachineOperationRequest $machineOperationRequest): mixed
    {
       $machineOperation =  new MachineOperation(
          $machineOperationRequest->toArray()
        );
        return $this->machineOperationRepository->addOperation($machineOperation);
    }

    public function resetMachineOperations(MachineOperationsResetRequest $machineOperationsResetRequest): mixed
    {
      return $this->machineOperationRepository->resetMachineOperations(
           Machine::find($machineOperationsResetRequest->get('machine_id')),
          User::find($machineOperationsResetRequest->get('user_id'))
       );

    }
}
