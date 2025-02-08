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

    public function listMachines()
    {
       return $this->machineRepository->getAllMachines();
    }

    public function showMachine($id)
    {
        return $this->machineRepository->getMachineById($id);
    }

    public function storeMachine(MachineRequest $machineRequest)
    {
        $machine = new Machine(
            $machineRequest->toArray()
        );

        return $this->machineRepository->createMachine($machine);
    }

    public function editMachine($id, MachineRequest $machineRequest)
    {
        return $this->machineRepository->updateMachine($id, $machineRequest->toArray());
    }

    public function removeMachine($id)
    {
       return $this->machineRepository->deleteMachine($id);
    }
}
