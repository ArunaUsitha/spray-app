<?php

namespace App\Services;

use App\Http\Requests\MachineRequest;
use App\Models\Machine;
use App\Repositories\Interfaces\MachineRepositoryInterface;
use App\Services\Interfaces\MachineServiceInterface;

class MachineService implements MachineServiceInterface
{
    public function __construct(
        protected MachineRepositoryInterface $machineRepository,
    ){}

    public function listMachines(): mixed
    {
       return $this->machineRepository->getAllMachines();
    }

    public function showMachine($id): mixed
    {
        return $this->machineRepository->getMachineById($id);
    }

    public function storeMachine(MachineRequest $machineRequest): mixed
    {
        $machine = new Machine(
            $machineRequest->toArray()
        );

        return $this->machineRepository->createMachine($machine);
    }

    public function editMachine($id, MachineRequest $machineRequest): mixed
    {
        return $this->machineRepository->updateMachine($id, $machineRequest->toArray());
    }

    public function removeMachine($id): mixed
    {
       return $this->machineRepository->deleteMachine($id);
    }
}
